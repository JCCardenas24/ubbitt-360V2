<?php

namespace app\business;

use app\exception\UploadBusinessException;
use app\models\db\FreemiumCallCenterKpi;
use app\models\db\FreemiumSummaryDetail;
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
        $this->loadFreemiumSummaryDetail($spreadsheet);
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

    private function loadFreemiumSummaryDetail(Spreadsheet $spreadsheet)
    {
        try {
            $spreadsheet->setActiveSheetIndexByName('Detalle de resumen Freemium');
        } catch (Exception $exception) {
            throw new UploadBusinessException('La hoja "Detalle de resumen Freemium" no se encontró en el archivo.');
        }
        $sheet = $spreadsheet->getActiveSheet();
        $maxRow = $sheet->getHighestRow();
        $transaction = FreemiumCallCenterKpi::getDb()->beginTransaction();
        for ($currentRowIndex = 2; $currentRowIndex <= $maxRow; $currentRowIndex++) {
            $summaryDetail = new FreemiumSummaryDetail();
            $date = $sheet->getCell("A$currentRowIndex")->getValue();
            $date = Date::excelToDateTimeObject($date);
            $summaryDetail->upload_date = $date->format('Y-m-d');
            // Checks if data for date date already exists, and if it does we update it
            $previousData = $summaryDetail->findByDate();
            if ($previousData != null) {
                $summaryDetail = $previousData;
            }
            $summaryDetail->nco_total_calls = $sheet->getCell("B$currentRowIndex")->getValue();
            $summaryDetail->sale_reason = $sheet->getCell("C$currentRowIndex")->getValue();
            $summaryDetail->sale_reason_percentage = $sheet->getCell("D$currentRowIndex")->getValue() * 100;
            $summaryDetail->sale_accepted = $sheet->getCell("E$currentRowIndex")->getValue();
            $summaryDetail->sale_accepted_percentage = $sheet->getCell("F$currentRowIndex")->getValue() * 100;
            $summaryDetail->sale_accepted_sales = $sheet->getCell("G$currentRowIndex")->getValue();
            $summaryDetail->sale_accepted_sales_percentage = $sheet->getCell("H$currentRowIndex")->getValue() * 100;
            $summaryDetail->sale_accepted_on_track = $sheet->getCell("I$currentRowIndex")->getValue();
            $summaryDetail->sale_accepted_on_track_percentage = $sheet->getCell("J$currentRowIndex")->getValue() * 100;
            $summaryDetail->sale_accepted_charged = $sheet->getCell("K$currentRowIndex")->getValue();
            $summaryDetail->sale_accepted_charged_percentage = $sheet->getCell("L$currentRowIndex")->getValue() * 100;
            $summaryDetail->sale_accepted_not_charged = $sheet->getCell("M$currentRowIndex")->getValue();
            $summaryDetail->sale_accepted_not_charged_percentage = $sheet->getCell("N$currentRowIndex")->getValue() * 100;
            $summaryDetail->call_scheduled = $sheet->getCell("O$currentRowIndex")->getValue();
            $summaryDetail->call_scheduled_percentage = $sheet->getCell("P$currentRowIndex")->getValue() * 100;
            $summaryDetail->call_scheduled_sales = $sheet->getCell("Q$currentRowIndex")->getValue();
            $summaryDetail->call_scheduled_sales_percentage = $sheet->getCell("R$currentRowIndex")->getValue() * 100;
            $summaryDetail->call_scheduled_on_track = $sheet->getCell("S$currentRowIndex")->getValue();
            $summaryDetail->call_scheduled_on_track_percentage = $sheet->getCell("T$currentRowIndex")->getValue() * 100;
            $summaryDetail->call_scheduled_charged = $sheet->getCell("U$currentRowIndex")->getValue();
            $summaryDetail->call_scheduled_charged_percentage = $sheet->getCell("V$currentRowIndex")->getValue() * 100;
            $summaryDetail->call_scheduled_not_charged = $sheet->getCell("W$currentRowIndex")->getValue();
            $summaryDetail->call_scheduled_not_charged_percentage = $sheet->getCell("X$currentRowIndex")->getValue() * 100;
            $summaryDetail->payment_promise_scheduled = $sheet->getCell("Y$currentRowIndex")->getValue();
            $summaryDetail->payment_promise_scheduled_percentage = $sheet->getCell("Z$currentRowIndex")->getValue() * 100;
            $summaryDetail->payment_promise_scheduled_sales = $sheet->getCell("AA$currentRowIndex")->getValue();
            $summaryDetail->payment_promise_scheduled_sales_percentage = $sheet->getCell("AB$currentRowIndex")->getValue() * 100;
            $summaryDetail->payment_promise_scheduled_on_track = $sheet->getCell("AC$currentRowIndex")->getValue();
            $summaryDetail->payment_promise_scheduled_on_track_percentage = $sheet->getCell("AD$currentRowIndex")->getValue() * 100;
            $summaryDetail->payment_promise_scheduled_charged = $sheet->getCell("AE$currentRowIndex")->getValue();
            $summaryDetail->payment_promise_scheduled_charged_percentage = $sheet->getCell("AF$currentRowIndex")->getValue() * 100;
            $summaryDetail->payment_promise_scheduled_not_charged = $sheet->getCell("AG$currentRowIndex")->getValue();
            $summaryDetail->payment_promise_scheduled_not_charged_percentage = $sheet->getCell("AH$currentRowIndex")->getValue() * 100;
            $summaryDetail->deposit_slip_sent = $sheet->getCell("AI$currentRowIndex")->getValue();
            $summaryDetail->deposit_slip_sent_percentage = $sheet->getCell("AJ$currentRowIndex")->getValue() * 100;
            $summaryDetail->deposit_slip_sent_sales = $sheet->getCell("AK$currentRowIndex")->getValue();
            $summaryDetail->deposit_slip_sent_sales_percentage = $sheet->getCell("AL$currentRowIndex")->getValue() * 100;
            $summaryDetail->deposit_slip_sent_on_track = $sheet->getCell("AM$currentRowIndex")->getValue();
            $summaryDetail->deposit_slip_sent_on_track_percentage = $sheet->getCell("AN$currentRowIndex")->getValue() * 100;
            $summaryDetail->deposit_slip_sent_charged = $sheet->getCell("AO$currentRowIndex")->getValue();
            $summaryDetail->deposit_slip_sent_charged_percentage = $sheet->getCell("AP$currentRowIndex")->getValue() * 100;
            $summaryDetail->deposit_slip_sent_not_charged = $sheet->getCell("AQ$currentRowIndex")->getValue();
            $summaryDetail->deposit_slip_sent_not_charged_percentage = $sheet->getCell("AR$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls = $sheet->getCell("AS$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_percentage = $sheet->getCell("AT$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls_ubbitt_assistance = $sheet->getCell("AU$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_ubbitt_assistance_percentage = $sheet->getCell("AV$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls_product_questions = $sheet->getCell("AW$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_product_questions_percentage = $sheet->getCell("AX$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls_product_advisory = $sheet->getCell("AY$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_product_advisory_percentage = $sheet->getCell("AZ$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls_product_linkage = $sheet->getCell("BA$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_product_linkage_percentage = $sheet->getCell("BB$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls_coverage_linkage = $sheet->getCell("BC$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_coverage_linkage_percentage = $sheet->getCell("BD$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls_other_products = $sheet->getCell("BE$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_other_products_percentage = $sheet->getCell("BF$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls_other_products_medical_expenses = $sheet->getCell("BG$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_other_products_medical_expenses_percentage = $sheet->getCell("BH$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls_other_products_life = $sheet->getCell("BI$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_other_products_life_percentage = $sheet->getCell("BJ$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls_other_products_legalized = $sheet->getCell("BK$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_other_products_legalized_percentage = $sheet->getCell("BL$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls_other_products_platforms = $sheet->getCell("BM$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_other_products_platforms_percentage = $sheet->getCell("BN$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_calls_other_products_residential = $sheet->getCell("BO$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_calls_other_products_residential_percentage = $sheet->getCell("BP$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_cust_serv = $sheet->getCell("BQ$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_cust_serv_percentage = $sheet->getCell("BR$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_cust_serv_report_advisor_care = $sheet->getCell("BS$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_cust_serv_report_advisor_care_percentage = $sheet->getCell("BT$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_cust_serv_policy_renewal_review = $sheet->getCell("BU$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_cust_serv_policy_renewal_review_percentage = $sheet->getCell("BV$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_cust_serv_product_cancellation = $sheet->getCell("BW$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_cust_serv_product_cancellation_percentage = $sheet->getCell("BX$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_cust_serv_check_expiration_dates = $sheet->getCell("BY$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_cust_serv_check_expiration_dates_percentage = $sheet->getCell("BZ$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_collection_questions = $sheet->getCell("CA$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_collection_questions_percentage = $sheet->getCell("CB$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_collection_questions_payment_track = $sheet->getCell("CC$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_collection_questions_payment_track_percentage = $sheet->getCell("CD$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_collection_questions_refund = $sheet->getCell("CE$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_collection_questions_refund_percentage = $sheet->getCell("CF$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_collection_questions_payment_clarification = $sheet->getCell("CG$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_collection_questions_payment_clarification_percentage = $sheet->getCell("CH$currentRowIndex")->getValue() * 100;
            $summaryDetail->cust_serv_collection_questions_make_payment = $sheet->getCell("CI$currentRowIndex")->getValue();
            $summaryDetail->cust_serv_collection_questions_make_payment_percentage = $sheet->getCell("CJ$currentRowIndex")->getValue() * 100;
            $summaryDetail->total_sales = $sheet->getCell("CK$currentRowIndex")->getValue();
            $summaryDetail->sales_total_amount = $sheet->getCell("CL$currentRowIndex")->getValue();
            $summaryDetail->conversion_percentage = $sheet->getCell("CM$currentRowIndex")->getValue();
            $summaryDetail->emissions_total = $sheet->getCell("CN$currentRowIndex")->getValue();
            $summaryDetail->collection_percentage = $sheet->getCell("CO$currentRowIndex")->getValue() * 100;
            $summaryDetail->total_collections = $sheet->getCell("CP$currentRowIndex")->getValue();
            $summaryDetail->total_sale_issued = $sheet->getCell("CQ$currentRowIndex")->getValue();
            $summaryDetail->total_sale_paid = $sheet->getCell("CR$currentRowIndex")->getValue();

            if (!$summaryDetail->save()) {
                $transaction->rollback();
                throw new UploadBusinessException('Detalle de resumen Freemium - Los siguientes errores se encontraron en la fila ' . $currentRowIndex . ': ' . $this->getValidationErrorsAsString($summaryDetail->errors));
            }
        }
        $transaction->commit();
    }
}