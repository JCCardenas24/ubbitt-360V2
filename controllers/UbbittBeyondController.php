<?php

namespace app\controllers;

use app\models\db\BeyondCollectionCallCenterKpi;
use app\models\db\BeyondCollectionSummaryDetail;
use app\models\db\BeyondCollectionSummaryGraph;
use app\models\db\BeyondRenewalCallCenterKpi;
use app\models\db\BeyondRenewalSummaryDetail;
use app\models\db\BeyondRenewalSummaryGraph;
use app\models\db\webhook\WebHookCalls;
use app\models\forms\SearchByDateForm;
use app\models\ReportFile;
use app\models\DatabaseUpload;
use app\models\forms\SearchByDateAndTermsForm;
use app\models\User;
use app\models\utils\FilenameHelper;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use DateTime;
use Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use ZipArchive;

class UbbittBeyondController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => [
                            'collection-dashboard', 'find-collection-summary-graph-data', 'find-collection-call-center-kpis',
                            'find-collection-calls', 'download-collection-calls-audios', 'find-collection-sales', 'download-collection-sales-report',
                            'find-collection-summary-detail-data',
                            'renewal-dashboard', 'find-renewal-summary-graph-data',
                            'find-renewal-call-center-kpis', 'find-renewal-calls', 'download-renewal-calls-audios',
                            'find-renewal-sales', 'download-renewal-sales-report', 'find-renewal-summary-detail-data', 'upload-database'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'collection-dashboard' => ['get'],
                    'find-collection-summary-graph-data' => ['post'],
                    'find-collection-call-center-kpis' => ['post'],
                    'find-collection-calls' => ['post'],
                    'download-collection-calls-audios' => ['get'],
                    'find-collection-sales' => ['post'],
                    'download-collection-sales-report' => ['get'],
                    'find-collection-summary-detail-data' => ['post'],
                    'renewal-dashboard' => ['get'],
                    'find-renewal-summary-graph-data' => ['post'],
                    'find-renewal-call-center-kpis' => ['post'],
                    'find-renewal-calls' => ['post'],
                    'download-renewal-calls-audios' => ['get'],
                    'find-renewal-sales' => ['post'],
                    'download-renewal-sales-report' => ['get'],
                    'find-renewal-summary-detail-data' => ['post'],
                    'upload-database' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionCollectionDashboard()
    {
        $reportFileModel = new ReportFile();
        $databaseUploadModel = new DatabaseUpload();
        return $this->render('collection-dashboard', [
            'reportFileModel' => $reportFileModel,
            'databaseUploadModel' => $databaseUploadModel
        ]);
    }

    public function actionFindCollectionSummaryGraphData()
    {
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $summaryGraphModel = new BeyondCollectionSummaryGraph();
        $data = $summaryGraphModel->findByDates($searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindCollectionCallCenterKpis()
    {
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new BeyondCollectionCallCenterKpi();
        $data = $model->findKpisReport($searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindCollectionCalls()
    {
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $calls = new WebHookCalls();
        $callsArray = $calls->findByDateAndTerm(Yii::$app->params['ubbitt_beyond_collection_did'], Yii::$app->params['ubbitt_beyond_collection_did_2'], $searchParams->startDate, $searchParams->endDate, $searchParams->term, $searchParams->page);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $callsArray;
    }

    public function actionDownloadCollectionCallsAudios()
    {
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->get());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $this->downloadAudios($searchParams, Yii::$app->params['ubbitt_beyond_collection_did'], Yii::$app->params['ubbitt_beyond_collection_did_2'], 'llamadas-audios-beyond-cobranza.zip');
    }

    private function downloadAudios(SearchByDateAndTermsForm $searchParams, $did, $did2, $zipFileName)
    {
        $callsModel = new WebHookCalls();
        $calls = $callsModel->findAllByDateAndTerm($did, $did2, $searchParams->startDate, $searchParams->endDate, $searchParams->term);

        try {
            $outputPath = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;
            if (!file_exists($outputPath)) {
                mkdir($outputPath, 0777, true);
            }
            $fileName = FilenameHelper::createTimeStampedFileName($zipFileName);
            $zipArchive = new ZipArchive();
            $zipArchive->open($outputPath . $fileName, ZipArchive::CREATE);

            foreach ($calls as $call) {
                foreach ($call->callRecords as $callRecord) {
                    $audioFilePath = Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'audio' . DIRECTORY_SEPARATOR . $callRecord->name . '.mp3';
                    if (file_exists($audioFilePath)) {
                        $zipArchive->addFromString($callRecord->name . '.mp3', file_get_contents($audioFilePath));
                    }
                }
            }
            $zipArchive->close();
            // Envía el archivo al navegador
            Yii::$app->response->sendFile($outputPath . $fileName, $fileName)
                ->on(Response::EVENT_AFTER_SEND, function ($event) {
                    // Elimina el archivo una vez enviado
                    unlink($event->data);
                }, $outputPath . $fileName);
        } catch (Exception $exception) {
            Yii::error('Ocurrió un problema al descargar los audios de las llamadas.');
            Yii::error($exception);
            throw new InternalErrorException('Ocurrió un problema al descargar los audios de las llamadas.', 500, $exception);
        }
    }

    public function actionFindCollectionSales()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $url = Yii::$app->params['sales_database_service_url_beyond'] . $searchParams->startDate . '/' . $searchParams->endDate . '/' . $searchParams->page . '/' . Yii::$app->params['sales_database_service_beyond_api_key'];
        if (!empty($searchParams->term)) {
            $url .= '/' . rawurlencode($searchParams->term);
        }
        $response = $this->getUrlContents($url);
        $response = json_decode($response);
        $data = [];
        $data['totalPages'] = $response[1];
        $data['salesRecords'] = $response[2];
        return $data;
    }

    function getUrlContents($url)
    {
        $userAgent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.71 Safari/537.36';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        return curl_exec($ch);
    }

    function actionDownloadCollectionSalesReport()
    {
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->get());
        $url = Yii::$app->params['sales_database_service_url_beyond'] . $searchParams->startDate . '/' . $searchParams->endDate . '/0/' . Yii::$app->params['sales_database_service_beyond_api_key'];
        if (!empty($searchParams->term)) {
            $url .= '/' . $searchParams->term;
        }
        $response = $this->getUrlContents($url);
        $response = json_decode($response);
        $sales = $response[0];
        try {
            $outputPath = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;
            if (!file_exists($outputPath)) {
                mkdir($outputPath, 0777, true);
            }
            $fileName = FilenameHelper::createTimeStampedFileName('ventas-beyond-cobranza.xlsx');
            $this->createSalesReport($sales, $outputPath, $fileName);
            // Envía el archivo al navegador
            Yii::$app->response->sendFile($outputPath . $fileName, basename($fileName))
                ->on(Response::EVENT_AFTER_SEND, function ($event) {
                    // Elimina el archivo una vez enviado
                    unlink($event->data);
                }, $outputPath . $fileName);
        } catch (Exception $exception) {
            Yii::error('Ocurrió un problema al descargar el reporte de ventas.');
            Yii::error($exception);
            throw new InternalErrorException('Ocurrió un problema al descargar el reporte de ventas.', 500, $exception);
        }
    }

    private function createSalesReport($sales, $outputPath, $fileName)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->setCellValue('C1', 'Teléfono');
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->setCellValue('D1', 'Correo electrónico');
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->setCellValue('E1', 'Producto');
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->setCellValue('F1', 'Estatus de cobro');
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->setCellValue('G1', 'No. de Póliza');
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->setCellValue('H1', 'Prima total');
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->setCellValue('I1', 'Montal Pagado');
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->setCellValue('J1', 'Asesor Asignado');
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->setCellValue('K1', 'Fecha de venta');
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->setCellValue('L1', 'Fecha de cobro');
        $sheet->getColumnDimension('L')->setAutoSize(true);
        $sheet->setCellValue('M1', 'Fecha de actividad');
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->setCellValue('N1', 'Ticket');
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $row = 2;
        foreach ($sales as $sale) {
            $sheet->setCellValue('A' . $row, $sale->id);
            $sheet->getStyle('A' . $row)->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_NUMBER);
            $sheet->setCellValue('B' . $row, $sale->nombre_contacto);
            $sheet->setCellValue('C' . $row, $sale->telefono_contacto);
            $sheet->setCellValue('D' . $row, $sale->correo_contacto);
            $sheet->setCellValue('E' . $row, $sale->producto);
            $sheet->setCellValue('F' . $row, $sale->estatus_cobro);
            $sheet->setCellValue('G' . $row, $sale->num_poliza);
            $sheet->getStyle('G' . $row)->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_NUMBER);
            $sheet->setCellValue('H' . $row, $sale->prima_total);
            $sheet->getStyle('H' . $row)->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
            $sheet->setCellValue('I' . $row, $sale->monto_pagado);
            $sheet->getStyle('I' . $row)->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);
            $sheet->setCellValue('J' . $row, $sale->asignado);
            $sheet->setCellValue('K' . $row, date('d/m/Y', strtotime($sale->fecha_venta)));
            $sheet->getStyle('K' . $row)->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
            $sheet->setCellValue('L' . $row, date('d/m/Y', strtotime($sale->fecha_cobro)));
            $sheet->getStyle('L' . $row)->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
            $sheet->setCellValue('M' . $row, date('d/m/Y', strtotime($sale->fecha_actividad)));
            $sheet->getStyle('M' . $row)->getNumberFormat()
                ->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
            $sheet->setCellValue('N' . $row, $sale->recibo);
            $row++;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($outputPath . $fileName);
    }

    public function actionFindCollectionSummaryDetailData()
    {
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new BeyondCollectionSummaryDetail();
        $data = $model->findKpisReport($searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionRenewalDashboard()
    {
        $reportFileModel = new ReportFile();
        $databaseUploadModel = new DatabaseUpload();
        return $this->render('renewal-dashboard', [
            'reportFileModel' => $reportFileModel,
            'databaseUploadModel' => $databaseUploadModel
        ]);
    }

    public function actionFindRenewalSummaryGraphData()
    {
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $summaryGraphModel = new BeyondRenewalSummaryGraph();
        $data = $summaryGraphModel->findByDates($searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindRenewalCallCenterKpis()
    {
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new BeyondRenewalCallCenterKpi();
        $data = $model->findKpisReport($searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindRenewalCalls()
    {
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $calls = new WebHookCalls();
        $callsArray = $calls->findByDateAndTerm(Yii::$app->params['ubbitt_beyond_renewal_did'], Yii::$app->params['ubbitt_beyond_renewal_did_2'], $searchParams->startDate, $searchParams->endDate, $searchParams->term, $searchParams->page);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $callsArray;
    }

    public function actionDownloadRenewalCallsAudios()
    {
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->get());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $this->downloadAudios($searchParams, Yii::$app->params['ubbitt_beyond_renewal_did'], Yii::$app->params['ubbitt_beyond_renewal_did_2'], 'llamadas-audios-beyond-renovacion.zip');
    }

    public function actionFindRenewalSales()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $url = Yii::$app->params['sales_database_service_url_beyond'] . $searchParams->startDate . '/' . $searchParams->endDate . '/' . $searchParams->page . '/' . Yii::$app->params['sales_database_service_beyond_api_key'];
        if (!empty($searchParams->term)) {
            $url .= '/' . rawurlencode($searchParams->term);
        }
        $response = $this->getUrlContents($url);
        $response = json_decode($response);
        $data = [];
        $data['totalPages'] = $response[1];
        $data['salesRecords'] = $response[2];
        return $data;
    }

    function actionDownloadRenewalSalesReport()
    {
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->get());
        $url = Yii::$app->params['sales_database_service_url_beyond'] . $searchParams->startDate . '/' . $searchParams->endDate . '/0/' . Yii::$app->params['sales_database_service_beyond_api_key'];
        if (!empty($searchParams->term)) {
            $url .= '/' . $searchParams->term;
        }
        $response = $this->getUrlContents($url);
        $response = json_decode($response);
        $sales = $response[0];
        try {
            $outputPath = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;
            if (!file_exists($outputPath)) {
                mkdir($outputPath, 0777, true);
            }
            $fileName = FilenameHelper::createTimeStampedFileName('ventas-beyond-renovacion.xlsx');
            $this->createSalesReport($sales, $outputPath, $fileName);
            // Envía el archivo al navegador
            Yii::$app->response->sendFile($outputPath . $fileName, basename($fileName))
                ->on(Response::EVENT_AFTER_SEND, function ($event) {
                    // Elimina el archivo una vez enviado
                    unlink($event->data);
                }, $outputPath . $fileName);
        } catch (Exception $exception) {
            Yii::error('Ocurrió un problema al descargar el reporte de ventas.');
            Yii::error($exception);
            throw new InternalErrorException('Ocurrió un problema al descargar el reporte de ventas.', 500, $exception);
        }
    }

    public function actionFindRenewalSummaryDetailData()
    {
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new BeyondRenewalSummaryDetail();
        $data = $model->findKpisReport($searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionUploadDatabase()
    {
        if ($this->request->isPost) {
            $model = new DatabaseUpload();

            if ($model->load($this->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');

                if ($model->validate()) {
                    $filePath = "uploads/database_" . $model->module_origin . "_" . $model->submodule_origin . "_" . time() . "." . $model->file->extension;

                    if ($model->file->saveAs($filePath)) {
                        $model->file_path = $filePath;
                        $model->user_id = Yii::$app->user->id;
                        $model->submodule_origin = Yii::$app->params['report_submodule_dict'][$model->submodule_origin];
                        $now = new DateTime('now');
                        $model->created_at = $now->format("Y-m-d H:i:s");

                        $model->save(false);

                        $user = User::findOne([
                            'user_id' => $model->user_id
                        ]);
                        $email_addresses = explode(',', Yii::$app->params['email_address_database_to']);

                        Yii::$app
                            ->mailer
                            ->compose('database-upload', ['user' => $user])
                            ->setFrom(Yii::$app->components['mailer']['transport']['username'])
                            ->setTo($email_addresses)
                            ->setSubject('Envío de Base de datos')
                            ->attach($filePath)
                            ->send();
                        return $this->redirect(Yii::$app->request->referrer);
                    }
                }
            }
        } else {
            return $this->goBack();
        }
    }
}