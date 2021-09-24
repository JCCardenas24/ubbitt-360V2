<?php

namespace app\business;

use app\exception\UploadBusinessException;
use app\models\db\PremiumCampaignForecast;
use app\models\db\PremiumLeadsCallsGraph;
use app\models\db\PremiumSummaryGraph;
use app\models\db\PremiumSummaryInputs;
use Exception;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use \PhpOffice\PhpSpreadsheet\Shared\Date;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use yii\web\UploadedFile;

class UploadPremiumReportBusiness
{
    public function saveReports($campaignId, UploadedFile $file)
    {
        $inputFileType = IOFactory::identify($file->tempName);;
        $reader = IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file->tempName);
        $this->saveCampaignForecast($campaignId, $spreadsheet);
        $this->saveGraphData($campaignId, 'forecast', 'Gráfica Premium Forecast', $spreadsheet);
        $this->saveGraphData($campaignId, 'actual', 'Gráfica Premium Actual', $spreadsheet);
        $this->saveLeadsCallsGraphData($campaignId, $spreadsheet);
        $this->saveSummaryInputs($campaignId, $spreadsheet);
        // Unload worksheet
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
    }

    private function saveCampaignForecast($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Forecast Campaña');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Forecast Campaña" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxRow = $sheet->getHighestRow();
        $transaction = PremiumCampaignForecast::getDb()->beginTransaction();
        for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
            $data = new PremiumCampaignForecast();
            $data->campaignId = $campaignId;
            $date = $sheet->getCell("A$currentRowIndex")->getValue();
            $date = Date::excelToDateTimeObject($date);
            $data->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $data->findExisting();
            if ($previousData != null) {
                $data = $previousData;
            }
            $data->ubbittInvestment = $sheet->getCell("B$currentRowIndex")->getValue();
            $data->salesForecast = $sheet->getCell("C$currentRowIndex")->getValue();
            $data->collectedForecast = $sheet->getCell("D$currentRowIndex")->getValue();
            if (!$data->save()) {
                $transaction->rollback();
                throw new UploadBusinessException('Forecast Campaña - Los siguientes errores se encontraron en la fila ' . $currentRowIndex . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        $transaction->commit();
    }

    private function getValidationErrorsAsString($errors)
    {
        $errorsString = '';
        foreach ($errors as $key => $errorsDescription) {
            $errorsString .= implode($errorsDescription) . ', ';
        }
        $errorsString = substr($errorsString, 0, strlen($errorsString) - 2);
        return $errorsString;
    }

    private function saveGraphData($campaignId, $type, $sheetName, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName($sheetName);
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "' . $sheetName . '" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxColumn = Coordinate::columnIndexFromString($sheet->getHighestColumn());
        $transaction = PremiumSummaryGraph::getDb()->beginTransaction();
        for ($currentColumnIndex = 2; $currentColumnIndex <= $maxColumn; $currentColumnIndex++) {
            $data = new PremiumSummaryGraph();
            $data->campaignId = $campaignId;
            $data->type = $type;
            $date = $sheet->getCellByColumnAndRow($currentColumnIndex, 2)->getValue();
            $date = Date::excelToDateTimeObject($date);
            $data->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $data->findExisting();
            if ($previousData != null) {
                $data = $previousData;
            }
            $uploadDate = $sheet->getCellByColumnAndRow($currentColumnIndex, 1)->getValue();
            $uploadDate = Date::excelToDateTimeObject($uploadDate);
            $data->uploadDate = $uploadDate->format('Y-m-d');
            $data->investment = $sheet->getCellByColumnAndRow($currentColumnIndex, 3)->getValue();
            $data->sales = $sheet->getCellByColumnAndRow($currentColumnIndex, 4)->getValue();
            $data->collected = $sheet->getCellByColumnAndRow($currentColumnIndex, 5)->getValue();
            if (!$data->save()) {
                $currentColumnString = Coordinate::stringFromColumnIndex($currentColumnIndex);
                $transaction->rollback();
                throw new UploadBusinessException($sheetName . ' - Los siguientes errores se encontraron en la columna ' . $currentColumnString . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        $transaction->commit();
    }

    function saveLeadsCallsGraphData($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Gráfica llamadas leads');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Gráfica llamadas leads" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxColumn = Coordinate::columnIndexFromString($sheet->getHighestColumn());
        $transaction = PremiumLeadsCallsGraph::getDb()->beginTransaction();
        for ($currentColumnIndex = 2; $currentColumnIndex <= $maxColumn; $currentColumnIndex++) {
            $data = new PremiumLeadsCallsGraph();
            $data->campaignId = $campaignId;
            $date = $sheet->getCellByColumnAndRow($currentColumnIndex, 2)->getValue();
            $date = Date::excelToDateTimeObject($date);
            $data->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $data->findExisting();
            if ($previousData != null) {
                $data = $previousData;
            }
            $uploadDate = $sheet->getCellByColumnAndRow($currentColumnIndex, 1)->getValue();
            $uploadDate = Date::excelToDateTimeObject($uploadDate);
            $data->uploadDate = $uploadDate->format('Y-m-d');
            $data->leads = $sheet->getCellByColumnAndRow($currentColumnIndex, 3)->getValue();
            $data->calls = $sheet->getCellByColumnAndRow($currentColumnIndex, 4)->getValue();
            if (!$data->save()) {
                $currentColumnString = Coordinate::stringFromColumnIndex($currentColumnIndex);
                $transaction->rollback();
                throw new UploadBusinessException('Gráfica llamadas leads - Los siguientes errores se encontraron en la columna ' . $currentColumnString . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        $transaction->commit();
    }

    private function saveSummaryInputs($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Resumen inputs');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Resumen inputs" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxRow = $sheet->getHighestRow();
        $transaction = PremiumSummaryInputs::getDb()->beginTransaction();
        for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
            $data = new PremiumSummaryInputs();
            $data->campaignId = $campaignId;
            $date = $sheet->getCell("A$currentRowIndex")->getValue();
            $date = Date::excelToDateTimeObject($date);
            $data->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $data->findExisting();
            if ($previousData != null) {
                $data = $previousData;
            }
            $data->spent_budget = $sheet->getCell("B$currentRowIndex")->getValue();
            $data->roi = $sheet->getCell("C$currentRowIndex")->getValue();
            $data->roi_percentage = $sheet->getCell("D$currentRowIndex")->getValue() * 100;
            $data->cpl = $sheet->getCell("E$currentRowIndex")->getValue();
            $data->cpa = $sheet->getCell("F$currentRowIndex")->getValue();
            $data->cpa_percentage = $sheet->getCell("G$currentRowIndex")->getValue() * 100;
            $data->leads = $sheet->getCell("H$currentRowIndex")->getValue();
            $data->calls_total = $sheet->getCell("I$currentRowIndex")->getValue();
            $data->sales_total = $sheet->getCell("J$currentRowIndex")->getValue();
            $data->conversion_percentage = $sheet->getCell("K$currentRowIndex")->getValue() * 100;
            $data->collected_total = $sheet->getCell("L$currentRowIndex")->getValue();
            $data->collected_percentage = $sheet->getCell("M$currentRowIndex")->getValue() * 100;
            $data->spent_investment = $sheet->getCell("N$currentRowIndex")->getValue();
            $data->sales_total_amount = $sheet->getCell("O$currentRowIndex")->getValue();
            $data->sales_percentage = $sheet->getCell("P$currentRowIndex")->getValue() * 100;
            $data->collected_total_amount = $sheet->getCell("Q$currentRowIndex")->getValue();
            $data->collection_percentage = $sheet->getCell("R$currentRowIndex")->getValue() * 100;
            $data->total_emitted_sales = $sheet->getCell("S$currentRowIndex")->getValue();
            $data->total_paid_sales = $sheet->getCell("T$currentRowIndex")->getValue();
            if (!$data->save()) {
                $transaction->rollback();
                throw new UploadBusinessException('Resumen inputs - Los siguientes errores se encontraron en la fila ' . $currentRowIndex . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        $transaction->commit();
    }
}