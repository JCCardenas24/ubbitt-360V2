<?php

namespace app\business;

use app\exception\UploadBusinessException;
use app\models\db\PremiumAgeData;
use app\models\db\PremiumCallCenterKpi;
use app\models\db\PremiumCampaignForecast;
use app\models\db\PremiumDailyPerformance;
use app\models\db\PremiumLeadsCallsGraph;
use app\models\db\PremiumMarketingInputs;
use app\models\db\PremiumMediaData;
use app\models\db\PremiumRegionData;
use app\models\db\PremiumScheduleData;
use app\models\db\PremiumSummaryGraph;
use app\models\db\PremiumSummaryInputs;
use app\models\db\PremiumVehicleModel;
use app\models\db\PremiumVehicleYear;
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
        $this->saveMarketingInputs($campaignId, $spreadsheet);
        $this->saveMarketingMediaData($campaignId, $spreadsheet);
        $this->saveMarketingDailyPerformance($campaignId, $spreadsheet);
        $this->saveMarketingAgeData($campaignId, $spreadsheet);
        $this->saveMarketingRegionData($campaignId, $spreadsheet);
        $this->saveMarketingScheduleData($campaignId, $spreadsheet);
        $this->saveCallCenterKpis($campaignId, $spreadsheet);
        $this->saveVehicleModelsData($campaignId, $spreadsheet);
        $this->saveVehicleYearsData($campaignId, $spreadsheet);
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
        // $transaction = PremiumCampaignForecast::getDb()->beginTransaction();
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
                // $transaction->rollback();
                throw new UploadBusinessException('Forecast Campaña - Los siguientes errores se encontraron en la fila ' . $currentRowIndex . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        // $transaction->commit();
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
        // $transaction = PremiumSummaryGraph::getDb()->beginTransaction();
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
                // $transaction->rollback();
                throw new UploadBusinessException($sheetName . ' - Los siguientes errores se encontraron en la columna ' . $currentColumnString . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        // $transaction->commit();
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
        // $transaction = PremiumLeadsCallsGraph::getDb()->beginTransaction();
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
                // $transaction->rollback();
                throw new UploadBusinessException('Gráfica llamadas leads - Los siguientes errores se encontraron en la columna ' . $currentColumnString . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        // $transaction->commit();
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
        // $transaction = PremiumSummaryInputs::getDb()->beginTransaction();
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
                // $transaction->rollback();
                throw new UploadBusinessException('Resumen inputs - Los siguientes errores se encontraron en la fila ' . $currentRowIndex . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        // $transaction->commit();
    }

    private function saveMarketingInputs($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Marketing inputs');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Marketing inputs" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxRow = $sheet->getHighestRow();
        // $transaction = PremiumMarketingInputs::getDb()->beginTransaction();
        for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
            $data = new PremiumMarketingInputs();
            $data->campaignId = $campaignId;
            $date = $sheet->getCell("A$currentRowIndex")->getValue();
            $date = Date::excelToDateTimeObject($date);
            $data->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $data->findExisting();
            if ($previousData != null) {
                $data = $previousData;
            }
            $data->budget = $sheet->getCell("B$currentRowIndex")->getValue();
            $data->spent_budget = $sheet->getCell("C$currentRowIndex")->getValue();
            $data->spent_budget_percentage = $sheet->getCell("D$currentRowIndex")->getValue() * 100;
            $data->available_budget = $sheet->getCell("E$currentRowIndex")->getValue();
            $data->available_budget_percentage = $sheet->getCell("F$currentRowIndex")->getValue() * 100;
            $data->impressions = $sheet->getCell("G$currentRowIndex")->getValue();
            $data->ctr = $sheet->getCell("H$currentRowIndex")->getValue() * 100;
            $data->clicks = $sheet->getCell("I$currentRowIndex")->getValue();
            $data->rebound = $sheet->getCell("J$currentRowIndex")->getValue() * 100;
            $data->visits = $sheet->getCell("K$currentRowIndex")->getValue();
            $data->visits_conversion = $sheet->getCell("L$currentRowIndex")->getValue() * 100;
            $data->leads = $sheet->getCell("M$currentRowIndex")->getValue();
            $data->leads_conversion = $sheet->getCell("N$currentRowIndex")->getValue() * 100;
            $data->contacting = $sheet->getCell("O$currentRowIndex")->getValue();
            $data->contacting_conversion = $sheet->getCell("P$currentRowIndex")->getValue() * 100;
            $data->sales = $sheet->getCell("Q$currentRowIndex")->getValue();
            $data->cpm = $sheet->getCell("R$currentRowIndex")->getValue();
            $data->cpc = $sheet->getCell("S$currentRowIndex")->getValue();
            $data->cp_visit = $sheet->getCell("T$currentRowIndex")->getValue();
            $data->cpl = $sheet->getCell("U$currentRowIndex")->getValue();
            $data->cpl_contacted = $sheet->getCell("V$currentRowIndex")->getValue();
            $data->sale_cost = $sheet->getCell("W$currentRowIndex")->getValue();
            $data->roa = $sheet->getCell("X$currentRowIndex")->getValue() * 100;
            $data->sales_amount = $sheet->getCell("Y$currentRowIndex")->getValue();
            $data->expenses = $sheet->getCell("Z$currentRowIndex")->getValue();
            $data->investment = $sheet->getCell("AA$currentRowIndex")->getValue();
            if (!$data->save()) {
                // $transaction->rollback();
                throw new UploadBusinessException('Marketing inputs - Los siguientes errores se encontraron en la fila ' . $currentRowIndex . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        // $transaction->commit();
    }

    private function saveMarketingMediaData($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Tabla medios');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Tabla medios" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxRow = $sheet->getHighestRow();
        // $transaction = PremiumMediaData::getDb()->beginTransaction();
        for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
            $data = new PremiumMediaData();
            $data->campaignId = $campaignId;
            $date = $sheet->getCell("A$currentRowIndex")->getValue();
            $date = Date::excelToDateTimeObject($date);
            $data->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $data->media = $sheet->getCell("B$currentRowIndex")->getValue();
            $previousData = $data->findExisting();
            if ($previousData != null) {
                $data = $previousData;
            }
            $data->impressions = $sheet->getCell("C$currentRowIndex")->getValue();
            $data->clicks = $sheet->getCell("D$currentRowIndex")->getValue();
            $data->visits = $sheet->getCell("E$currentRowIndex")->getValue();
            $data->leads = $sheet->getCell("F$currentRowIndex")->getValue();
            $data->contacted = $sheet->getCell("G$currentRowIndex")->getValue();
            $data->sales = $sheet->getCell("H$currentRowIndex")->getValue();
            if (!$data->save()) {
                // $transaction->rollback();
                throw new UploadBusinessException('Tabla medios - Los siguientes errores se encontraron en la fila ' . $currentRowIndex . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        // $transaction->commit();
    }

    private function saveMarketingDailyPerformance($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Gráfica Marketing');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Gráfica Marketing" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxColumn = Coordinate::columnIndexFromString($sheet->getHighestColumn());
        // $transaction = PremiumDailyPerformance::getDb()->beginTransaction();
        for ($currentColumnIndex = 2; $currentColumnIndex <= $maxColumn; $currentColumnIndex++) {
            $data = new PremiumDailyPerformance();
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
            $data->investment = $sheet->getCellByColumnAndRow($currentColumnIndex, 3)->getValue();
            $data->leads = $sheet->getCellByColumnAndRow($currentColumnIndex, 4)->getValue();
            $data->sales = $sheet->getCellByColumnAndRow($currentColumnIndex, 5)->getValue();

            if (!$data->save()) {
                $currentColumnString = Coordinate::stringFromColumnIndex($currentColumnIndex);
                // $transaction->rollback();
                throw new UploadBusinessException('Gráfica Marketing - Los siguientes errores se encontraron en la columna ' . $currentColumnString . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        // $transaction->commit();
    }

    private function saveMarketingAgeData($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Grafica de edad');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Grafica de edad" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxRow = $sheet->getHighestRow();
        // $transaction = PremiumAgeData::getDb()->beginTransaction();
        for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
            $data = new PremiumAgeData();
            $data->campaignId = $campaignId;
            $date = $sheet->getCell("A$currentRowIndex")->getValue();
            $date = Date::excelToDateTimeObject($date);
            $data->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $data->findExisting();
            if ($previousData != null) {
                $data = $previousData;
            }
            $data->men_segment_25_34 = $sheet->getCell("B$currentRowIndex")->getValue();
            $data->men_segment_35_44 = $sheet->getCell("C$currentRowIndex")->getValue();
            $data->men_segment_45_54 = $sheet->getCell("D$currentRowIndex")->getValue();
            $data->men_segment_55_64 = $sheet->getCell("E$currentRowIndex")->getValue();
            $data->men_segment_65_plus = $sheet->getCell("F$currentRowIndex")->getValue();
            $data->women_segment_25_34 = $sheet->getCell("G$currentRowIndex")->getValue();
            $data->women_segment_35_44 = $sheet->getCell("H$currentRowIndex")->getValue();
            $data->women_segment_45_54 = $sheet->getCell("I$currentRowIndex")->getValue();
            $data->women_segment_55_64 = $sheet->getCell("J$currentRowIndex")->getValue();
            $data->women_segment_65_plus = $sheet->getCell("K$currentRowIndex")->getValue();
            if (!$data->save()) {
                // $transaction->rollback();
                throw new UploadBusinessException('Grafica de edad - Los siguientes errores se encontraron en la fila ' . $currentRowIndex . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        // $transaction->commit();
    }

    private function saveMarketingRegionData($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Grafica de Región');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Grafica de Región" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxColumn = Coordinate::columnIndexFromString($sheet->getHighestColumn());
        $maxRow = $sheet->getHighestRow();
        // $transaction = PremiumRegionData::getDb()->beginTransaction();
        for ($currentColumnIndex = 2; $currentColumnIndex <= $maxColumn; $currentColumnIndex++) {
            for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
                $data = new PremiumRegionData();
                $data->campaignId = $campaignId;
                $data->place = strval($sheet->getCellByColumnAndRow($currentColumnIndex, 1)->getValue());
                $date = $sheet->getCell("A$currentRowIndex")->getValue();
                $date = Date::excelToDateTimeObject($date);
                $data->date = $date->format('Y-m-d');
                // Checks if data for date date already exists, and if it does we update it
                $previousData = $data->findExisting();
                if ($previousData != null) {
                    $data = $previousData;
                }
                $data->amount = $sheet->getCellByColumnAndRow($currentColumnIndex, $currentRowIndex)->getValue();
                if (!$data->save()) {
                    $currentColumnString = Coordinate::stringFromColumnIndex($currentColumnIndex);
                    // $transaction->rollback();
                    throw new UploadBusinessException('Grafica de Región - Los siguientes errores se encontraron en la columna ' . $currentColumnString . ': ' . $this->getValidationErrorsAsString($data->errors));
                }
                unset($data);
            }
        }
        // $transaction->commit();
    }

    private function saveMarketingScheduleData($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Gráfica de horarios');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Gráfica de horarios" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxRow = $sheet->getHighestRow();
        // $transaction = PremiumScheduleData::getDb()->beginTransaction();
        for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
            $data = new PremiumScheduleData();
            $data->campaignId = $campaignId;
            $date = $sheet->getCell("A$currentRowIndex")->getValue();
            $date = Date::excelToDateTimeObject($date);
            $data->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $data->findExisting();
            if ($previousData != null) {
                $data = $previousData;
            }
            $data->schedule_06_10_clicks = $sheet->getCell("B$currentRowIndex")->getValue();
            $data->schedule_06_10_impressions = $sheet->getCell("C$currentRowIndex")->getValue();
            $data->schedule_11_13_clicks = $sheet->getCell("D$currentRowIndex")->getValue();
            $data->schedule_11_13_impressions = $sheet->getCell("E$currentRowIndex")->getValue();
            $data->schedule_14_16_clicks = $sheet->getCell("F$currentRowIndex")->getValue();
            $data->schedule_14_16_impressions = $sheet->getCell("G$currentRowIndex")->getValue();
            $data->schedule_17_20_clicks = $sheet->getCell("H$currentRowIndex")->getValue();
            $data->schedule_17_20_impressions = $sheet->getCell("I$currentRowIndex")->getValue();
            $data->schedule_21_23_clicks = $sheet->getCell("J$currentRowIndex")->getValue();
            $data->schedule_21_23_impressions = $sheet->getCell("K$currentRowIndex")->getValue();
            $data->schedule_00_02_clicks = $sheet->getCell("L$currentRowIndex")->getValue();
            $data->schedule_00_02_impressions = $sheet->getCell("M$currentRowIndex")->getValue();
            if (!$data->save()) {
                // $transaction->rollback();
                throw new UploadBusinessException('Gráfica de horarios - Los siguientes errores se encontraron en la fila ' . $currentRowIndex . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
            unset($data);
        }
        // $transaction->commit();
    }

    private function saveCallCenterKpis($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Call center');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Call center" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxRow = $sheet->getHighestRow();
        // $transaction = PremiumCallCenterKpi::getDb()->beginTransaction();
        for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
            $data = new PremiumCallCenterKpi();
            $data->campaignId = $campaignId;
            $date = $sheet->getCell("A$currentRowIndex")->getValue();
            $date = Date::excelToDateTimeObject($date);
            $data->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $data->findByDate();
            if ($previousData != null) {
                $data = $previousData;
            }
            $data->inboundCalls = $sheet->getCell("B$currentRowIndex")->getValue();
            $data->answeredCalls = $sheet->getCell("C$currentRowIndex")->getValue();
            $data->outboundCalls = $sheet->getCell("D$currentRowIndex")->getValue();
            $data->lostCalls = $sheet->getCell("E$currentRowIndex")->getValue();
            $data->callsAnsweredWithin25Seconds = intval($sheet->getCell("F$currentRowIndex")->getValue());
            $data->nslPercentage = $sheet->getCell("G$currentRowIndex")->getValue() * 100;
            $data->abandonedBefore5Seconds = $sheet->getCell("H$currentRowIndex")->getValue();
            $data->abandonment = $sheet->getCell("I$currentRowIndex")->getValue() * 100;
            $data->ath = $sheet->getCell("J$currentRowIndex")->getValue();
            $data->averageTimeInAnsweringCall = $sheet->getCell("K$currentRowIndex")->getValue();
            $data->speakingTime = $sheet->getCell("L$currentRowIndex")->getValue();
            if (!$data->save()) {
                // $transaction->rollback();
                throw new UploadBusinessException('Call center - Los siguientes errores se encontraron en la fila ' . $currentRowIndex . ': ' . $this->getValidationErrorsAsString($data->errors));
            }
        }
        // $transaction->commit();
    }

    private function saveVehicleModelsData($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Gráfica Modelo top');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Gráfica Modelo top" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxColumn = Coordinate::columnIndexFromString($sheet->getHighestColumn());
        $maxRow = $sheet->getHighestRow();
        // $transaction = PremiumVehicleModel::getDb()->beginTransaction();
        for ($currentColumnIndex = 2; $currentColumnIndex <= $maxColumn; $currentColumnIndex++) {
            for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
                $data = new PremiumVehicleModel();
                $data->campaignId = $campaignId;
                $data->model = $sheet->getCellByColumnAndRow($currentColumnIndex, 1)->getValue();
                $date = $sheet->getCell("A$currentRowIndex")->getValue();
                $date = Date::excelToDateTimeObject($date);
                $data->date = $date->format('Y-m-d');
                // Checks if data for date date already exists, and if it does we update it
                $previousData = $data->findExisting();
                if ($previousData != null) {
                    $data = $previousData;
                }
                $data->amount = $sheet->getCellByColumnAndRow($currentColumnIndex, $currentRowIndex)->getValue();
                if (!$data->save()) {
                    $currentColumnString = Coordinate::stringFromColumnIndex($currentColumnIndex);
                    // $transaction->rollback();
                    throw new UploadBusinessException('Gráfica Modelo top - Los siguientes errores se encontraron en la columna ' . $currentColumnString . ': ' . $this->getValidationErrorsAsString($data->errors));
                }
                unset($data);
            }
        }
        // $transaction->commit();
    }

    private function saveVehicleYearsData($campaignId, Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Gráfica de año top');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Gráfica de año top" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxColumn = Coordinate::columnIndexFromString($sheet->getHighestColumn());
        $maxRow = $sheet->getHighestRow();
        // $transaction = PremiumVehicleYear::getDb()->beginTransaction();
        for ($currentColumnIndex = 2; $currentColumnIndex <= $maxColumn; $currentColumnIndex++) {
            for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
                $data = new PremiumVehicleYear();
                $data->campaignId = $campaignId;
                $data->year = strval($sheet->getCellByColumnAndRow($currentColumnIndex, 1)->getValue());
                $date = $sheet->getCell("A$currentRowIndex")->getValue();
                $date = Date::excelToDateTimeObject($date);
                $data->date = $date->format('Y-m-d');
                // Checks if data for date date already exists, and if it does we update it
                $previousData = $data->findExisting();
                if ($previousData != null) {
                    $data = $previousData;
                }
                $data->amount = $sheet->getCellByColumnAndRow($currentColumnIndex, $currentRowIndex)->getValue();
                if (!$data->save()) {
                    $currentColumnString = Coordinate::stringFromColumnIndex($currentColumnIndex);
                    // $transaction->rollback();
                    throw new UploadBusinessException('Gráfica de año top - Los siguientes errores se encontraron en la columna ' . $currentColumnString . ': ' . $this->getValidationErrorsAsString($data->errors));
                }
                unset($data);
            }
        }
        // $transaction->commit();
    }
}