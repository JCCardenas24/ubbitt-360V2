<?php

namespace app\business;

use app\exception\UploadBusinessException;
use app\models\db\FreemiumSummaryGraph;
use Exception;
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
        $maxColumn = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($sheet->getHighestColumn());
        $transaction = FreemiumSummaryGraph::getDb()->beginTransaction();
        for ($currentColumnIndex = 2; $currentColumnIndex <= $maxColumn; $currentColumnIndex++) {
            $summary = new FreemiumSummaryGraph();
            $date = $sheet->getCellByColumnAndRow($currentColumnIndex, 2)->getFormattedValue();
            $date = Date::excelToDateTimeObject($date);
            $summary->date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $summary->findByDate();
            if ($previousData != null) {
                $summary = $previousData;
            }
            $uploadDate = $sheet->getCellByColumnAndRow($currentColumnIndex, 1)->getFormattedValue();
            $uploadDate = Date::excelToDateTimeObject($uploadDate);
            $summary->uploadDate = $uploadDate->format('Y-m-d');
            $summary->leads = intval($sheet->getCellByColumnAndRow($currentColumnIndex, 3)->getValue());
            $summary->calls = intval($sheet->getCellByColumnAndRow($currentColumnIndex, 4)->getValue());
            $summary->sales = intval($sheet->getCellByColumnAndRow($currentColumnIndex, 5)->getValue());
            $summary->collected = intval($sheet->getCellByColumnAndRow($currentColumnIndex, 6)->getValue());
            if (!$summary->save()) {
                $currentColumnString = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($currentColumnIndex);
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
}