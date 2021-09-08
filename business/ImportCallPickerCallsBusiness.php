<?php

namespace app\business;

use app\models\AudioDownload;
use app\models\db\BatchConfig;
use app\models\db\webhook\WebHookCallPicker;
use app\models\db\webhook\WebHookCallRecord;
use app\models\db\webhook\WebHookCalls;
use app\models\db\webhook\WebHookHubspotContact;
use Exception;
use Yii;

class ImportCallPickerCallsBusiness
{
    public function importCalls()
    {
        $config = new BatchConfig();
        $callPickerDownloadConfig = $config->findById(1);
        $fetchAgain = true;

        while ($fetchAgain) {
            $callpickerCallsModel = new WebHookCallPicker();
            $limit = 100;
            $callpickerCalls = $callpickerCallsModel->findFromId($callPickerDownloadConfig->lastId, $limit);
            $fetchAgain = count($callpickerCalls) == $limit;

            /**
             * @var $call \app\models\db\webhook\WebHookCallpicker
             */
            foreach ($callpickerCalls as $call) {
                try {
                    $transaction = WebHookCalls::getDb()->beginTransaction();
                    $callData = json_decode($call->string);
                    Yii::info('CALL ID: ' . $call->id, __METHOD__);
                    Yii::info('TYPE: ' . $callData->call_type, __METHOD__);
                    if ('525588547978' == $callData->callpicker_number || '525589571959' == $callData->callpicker_number || '525589505362' == $callData->callpicker_number) {
                        if ('Ansuz Oscar Vilchis' != trim($callData->answered_by)) {
                            Yii::info('Getting records for: ' . $call->id, __METHOD__);
                            $recordsNumber = count($callData->record_keys) > 0 ? count($callData->record_keys) > 0 : (isset($callData->records) ? count($callData->records) > 0 : 0);
                            if ($recordsNumber > 0) {
                                Yii::info($recordsNumber . ' records found', __METHOD__);
                                Yii::info('------------------------------------------------------', __METHOD__);
                                $isUrlRecord = count($callData->record_keys) == 0;
                                $records = count($callData->record_keys) > 0 ? $callData->record_keys : $callData->records;
                                $filename = $this->getFilename($callData);
                                $recordNames = $this->downloadRecords($isUrlRecord, $records, $filename);
                                $this->saveRecordNames($call->id, $recordNames);
                            } else {
                                Yii::info('No recordings found. Skipping....', __METHOD__);
                            }
                            $phoneNumber = "outbound" == $callData->call_type ? $callData->dialed_number : $callData->callpicker_number;
                            $this->saveHubspotContact($call->id, $phoneNumber);
                            $this->saveCall($call->id, $callData);
                        }
                    }
                    $callPickerDownloadConfig->lastId = $call->id;
                    $callPickerDownloadConfig->save();
                    $transaction->commit();
                    Yii::info('#############################################################', __METHOD__);
                } catch (Exception $e) {
                    $transaction->rollback();
                }
            }
        }
    }

    /**
     * Genera el nombre base para los audios de una llamada
     *
     * @param object $callData
     *
     * @return string
     */
    private function getFilename($callData)
    {
        $stringDate = str_replace(':', '-', str_replace(' ', '_', $callData->date));
        $filename = $callData->callpicker_number . '-' . $stringDate;
        return $filename;
    }

    /**
     * Descarga los audios del registro
     *
     * @param bool $isUrlRecord
     * @param array $records
     * @param string $filename
     *
     * @return array
     */
    private function downloadRecords($isUrlRecord, $records, $filename)
    {
        $recordsNames = [];
        $recordNumber = 1;
        foreach ($records as $record) {
            Yii::info('Downloading ' . $record . '....', __METHOD__);
            $recordName = $filename . '-' . $recordNumber;
            if (!$isUrlRecord) {
                AudioDownload::callpickerGetRecord($record, $recordName);
            } else {
                AudioDownload::callpickerGetRecordAudioUrl($record, $recordName);
            }
            array_push($recordsNames, $recordName);
            Yii::info($record . ' downloaded', __METHOD__);
            Yii::info('Filename: ' . $filename, __METHOD__);
            $recordNumber++;
        }
        return $recordsNames;
    }

    /**
     * Registra los audios descargado
     *
     * @param int $id
     * @param array $recordsNames
     */
    function saveRecordNames($id, $recordsNames)
    {
        foreach ($recordsNames as $recordName) {
            $callRecordModel = new WebHookCallRecord();
            $callRecordModel->name = $recordName;
            $callRecordModel->pkCallpickerId = $id;
            $callRecordModel->save();
            $callRecordModel->errors;
        }
    }

    private function saveHubspotContact($callpickerId, $phoneNumber)
    {

        $endpoint = "https://api.hubapi.com/contacts/v1/search/query?q={$phoneNumber}&";
        $contact = $this->curlExecute($endpoint);
        $name = '';
        $lastname = '';
        $email = '';
        $assignedAccount = '';
        if (!isset($contact->total) || $contact->total == 0) {
            $name = 'Desconocido';
        } else {
            $name = $contact->contacts[0]->properties->firstname->value;
            $lastname = $contact->contacts[0]->properties->lastname->value;
            $email = $contact->contacts[0]->properties->email->value;
            $assignedAccount = $contact->contacts[0]->properties->cuenta_asignada->value;
        }
        $hubspotContact = new WebHookHubspotContact();
        $hubspotContact->name = $name;
        $hubspotContact->lastname = $lastname;
        $hubspotContact->email = $email;
        $hubspotContact->assigned_acount = $assignedAccount;
        $hubspotContact->pk_callpicker_id = $callpickerId;
        $hubspotContact->save();
        $hubspotContact->errors;
    }

    /**
     * @method CURL Execute
     * @author Ro <jesus.gonzalez@aesir.com.mx>
     * @access public
     * @since v0.2
     * @return
     */
    private function curlExecute($endpoint)
    {
        $hapikey = 'e0b99128-82d0-49e0-8889-0da689d4cc1a';
        $endpoint = $endpoint . 'hapikey=' . $hapikey;
        $ch = @curl_init();
        @curl_setopt($ch, CURLOPT_URL, $endpoint);
        @curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = @curl_exec($ch);
        @curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_error($ch);
        @curl_close($ch);
        return json_decode($response);
    }

    private function saveCall($callpickerId, $callData)
    {
        $callDataModel = new WebHookCalls();
        $callDataModel->status = $callData->call_status;
        $callDataModel->type = $callData->call_type;
        $callDataModel->dialed_by = $callData->dialed_by;
        $callDataModel->answered_by = $callData->answered_by;
        $callDataModel->dialed_number = $callData->dialed_number;
        $callDataModel->callpicker_number = $callData->callpicker_number;
        $callDataModel->date = $callData->date;
        $callDataModel->duration = $callData->duration;
        $callDataModel->pk_callpicker_id = $callpickerId;
        $callDataModel->save();
        $callDataModel->errors;
    }
}