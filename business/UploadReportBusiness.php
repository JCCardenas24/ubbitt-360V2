<?php

namespace app\business;

use app\exception\UploadBusinessException;
use app\models\db\FreemiumCallCenterKpi;
use app\models\db\FreemiumSummaryGraph;
use Exception;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use \PhpOffice\PhpSpreadsheet\Shared\Date;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;
use yii\web\UploadedFile;

class UploadReportBusiness
{
    public function saveReports(UploadedFile $file)
    {
        $inputFileType = IOFactory::identify($file->tempName);;
        $reader = IOFactory::createReader($inputFileType);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file->tempName);
        $this->loadFreemiumInboundSummary($spreadsheet);
        $this->loadFreemiumCallCenterKpis($spreadsheet);
        // Unload worksheet
        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);
    }

    private function loadFreemiumInboundSummary(Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Resumen Gráfica Freemium');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Resumen Gráfica Freemium" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxColumn = Coordinate::columnIndexFromString($sheet->getHighestColumn());
        $transaction = FreemiumSummaryGraph::getDb()->beginTransaction();
        for ($currentColumnIndex = 2; $currentColumnIndex <= $maxColumn; $currentColumnIndex++) {
            $summary = new FreemiumSummaryGraph();
            $date = $sheet->getCellByColumnAndRow($currentColumnIndex, 2)->getValue();
            $date = Date::excelToDateTimeObject($date);
            $summary->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $summary->findByDate();
            if ($previousData != null) {
                $summary = $previousData;
            }
            $uploadDate = $sheet->getCellByColumnAndRow($currentColumnIndex, 1)->getValue();
            $uploadDate = Date::excelToDateTimeObject($uploadDate);
            $summary->uploadDate = $uploadDate->format('Y-m-d');
            $summary->leads = $sheet->getCellByColumnAndRow($currentColumnIndex, 3)->getValue();
            $summary->calls = $sheet->getCellByColumnAndRow($currentColumnIndex, 4)->getValue();
            $summary->sales = $sheet->getCellByColumnAndRow($currentColumnIndex, 5)->getValue();
            $summary->collected = $sheet->getCellByColumnAndRow($currentColumnIndex, 6)->getValue();
            if (!$summary->save()) {
                $currentColumnString = Coordinate::stringFromColumnIndex($currentColumnIndex);
                $transaction->rollback();
                throw new UploadBusinessException('Resumen Gráfica Freemium - Los siguientes errores se encontraron en la columna ' . $currentColumnString . ': ' . $this->getValidationErrorsAsString($summary->errors));
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

    private function loadFreemiumCallCenterKpis(Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Call center KPIS freemium');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Call center KPIS freemium" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxRow = $sheet->getHighestRow();
        $transaction = FreemiumCallCenterKpi::getDb()->beginTransaction();
        for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
            $kpi = new FreemiumCallCenterKpi();
            $date = $sheet->getCell("A$currentRowIndex")->getValue();
            $date = Date::excelToDateTimeObject($date);
            $kpi->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $kpi->findByDate();
            if ($previousData != null) {
                $kpi = $previousData;
            }
            $kpi->inboundCalls = $sheet->getCell("B$currentRowIndex")->getValue();
            $kpi->answeredCalls = $sheet->getCell("C$currentRowIndex")->getValue();
            $kpi->outboundCalls = $sheet->getCell("D$currentRowIndex")->getValue();
            $kpi->lostCalls = $sheet->getCell("E$currentRowIndex")->getValue();
            $kpi->callsAnsweredWithin25Seconds = intval($sheet->getCell("F$currentRowIndex")->getValue());
            $kpi->nslPercentage = $sheet->getCell("G$currentRowIndex")->getValue() * 100;
            $kpi->abandonedBefore5Seconds = $sheet->getCell("H$currentRowIndex")->getValue();
            $kpi->abandonment = $sheet->getCell("I$currentRowIndex")->getValue() * 100;
            $kpi->ath = $sheet->getCell("J$currentRowIndex")->getValue();
            $kpi->averageTimeInAnsweringCall = $sheet->getCell("K$currentRowIndex")->getValue();
            $kpi->speakingTime = $sheet->getCell("L$currentRowIndex")->getValue();
            if (!$kpi->save()) {
                $transaction->rollback();
                throw new UploadBusinessException('Call center KPIS Freemium - Los siguientes errores se encontraron en la fila ' . $currentRowIndex . ': ' . $this->getValidationErrorsAsString($kpi->errors));
            }
        }
        $transaction->commit();
    }
}