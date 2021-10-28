<?php

namespace app\controllers;

use app\models\db\Campaign;
use app\models\db\FreemiumCallCenterKpi;
use app\models\db\FreemiumSummaryDetail;
use app\models\db\FreemiumSummaryGraph;
use app\models\db\SyntelCallInfo;
use app\models\db\UserInfo;
use app\models\db\webhook\WebHookCalls;
use app\models\forms\SearchByDateAndTermsForm;
use app\models\forms\SearchByDateForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\models\ReportFile;
use app\models\utils\DateHelper;
use app\models\utils\FilenameHelper;
use app\models\utils\NumberFormatter;
use Exception;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use ZipArchive;

class UbbittFreemiumController extends Controller
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
                        'actions' => ['dashboard', 'find-calls', 'download-calls-audios', 'find-sales', 'download-policies', 'find-summary-graph-data', 'find-call-center-kpis', 'find-summary-detail-data'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'dashboard' => ['get', 'post'],
                    'find-calls' => ['post'],
                    'download-calls-audios' => ['get'],
                    'find-sales' => ['post'],
                    'download-policies' => ['get'],
                    'find-summary-graph-data' => ['post'],
                    'find-call-center-kpis' => ['post'],
                    'find-summary-detail-data' => ['post'],
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
    public function actionDashboard()
    {
        $reportFileModel = new ReportFile();
        if (!in_array('menu_ubbitt_freemium', Yii::$app->session->get("userPermissions"))) {
            if (in_array('menu_ubbitt_premium', Yii::$app->session->get("userPermissions"))) {
                $userId = Yii::$app->session->get("userIdentity")->user_id;
                $userInfo = UserInfo::findById($userId);
                $campaignModel = new Campaign();
                $campaigns = $campaignModel->findByCompanyId($userInfo->companyId);
                $this->redirect('/ubbitt-premium/dashboard?id=' . $campaigns[0]->campaignId);
            } else {
                if (in_array('menu_ubbitt_beyond_collection', Yii::$app->session->get("userPermissions"))) {
                    $this->redirect('/ubbitt-premium/collection-dashboard');
                } else {
                    $this->redirect('/ubbitt-premium/renewal-dashboard');
                }
            }
        }

        return $this->render('dashboard', [
            'reportFileModel' => $reportFileModel
        ]);
    }

    public function actionFindCalls()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $calls = new WebHookCalls();
        $callsArray = $calls->findByDateAndTermInbound(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, $searchParams->term, $searchParams->page);
        return $callsArray;
    }

    public function actionDownloadCallsAudios()
    {
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->get());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $callsModel = new WebHookCalls();
        $calls = $callsModel->findAllByDateAndTermInbound(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, $searchParams->term);

        try {
            $outputPath = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;
            if (!file_exists($outputPath)) {
                mkdir($outputPath, 0777, true);
            }
            $fileName = FilenameHelper::createTimeStampedFileName('llamadas-audios-freemium.zip');
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

    public function actionFindSales()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $url = Yii::$app->params['sales_database_service_url'] . $searchParams->startDate . '/' . $searchParams->endDate . '/' . $searchParams->page . '/' . Yii::$app->params['sales_database_service_api_key'];
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

    function actionDownloadPolicies()
    {
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->get());
        $url = Yii::$app->params['sales_database_service_url'] . $searchParams->startDate . '/' . $searchParams->endDate . '/0/0eb422ebc0760f6a22c3c24125aa5f9b';
        if (!empty($searchParams->term)) {
            $url .= '/' . $searchParams->term;
        }
        $response = $this->getUrlContents($url);
        $response = json_decode($response);
        $policies = $response[0];
        try {
            $outputPath = Yii::getAlias('@app') . DIRECTORY_SEPARATOR . 'temp' . DIRECTORY_SEPARATOR;
            if (!file_exists($outputPath)) {
                mkdir($outputPath, 0777, true);
            }
            $fileName = FilenameHelper::createTimeStampedFileName('polizas.zip');
            $zipArchive = new ZipArchive();
            $zipArchive->open($outputPath . $fileName, ZipArchive::CREATE);

            foreach ($policies as $policy) {
                $encodedUrl = urlencode($policy->documento);
                $fixedEncodedUrl = str_replace(['%2F', '%3A'], ['/', ':'], $encodedUrl);
                $policyFile = $this->getUrlContents($fixedEncodedUrl);
                if ($policyFile) {
                    $zipArchive->addFromString(basename($policy->documento), $policyFile);
                }
            }
            $zipArchive->close();
            // Envía el archivo al navegador
            if (file_exists($outputPath . $fileName)) {
                // Envía el archivo al navegador
                Yii::$app->response->sendFile($outputPath . $fileName, basename($fileName))
                    ->on(Response::EVENT_AFTER_SEND, function ($event) {
                        // Elimina el archivo una vez enviado
                        unlink($event->data);
                    }, $outputPath . $fileName);
            } else {
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::$app->response->statusCode = 400;
                return 'No se encontraron pólizas para descargar.';
            }
        } catch (Exception $exception) {
            Yii::error('Ocurrió un problema al descargar las pólizas.');
            Yii::error($exception);
            throw new InternalErrorException('Ocurrió un problema al descargar las pólizas.', 500, $exception);
        }
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

    public function actionFindSummaryGraphData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $summaryGraphModel = new FreemiumSummaryGraph();
        $data = $summaryGraphModel->findByDates($searchParams->startDate, $searchParams->endDate);
        $syntelCallInfoModel = new SyntelCallInfo();
        $callsCounts = $syntelCallInfoModel->countCallsByCallPickerNumberAndDates(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate);
        foreach ($data as &$row) {
            $row['calls'] = $this->findCallsCountByDate($callsCounts, DateHelper::ddMmYyyyToDatabase($row['date']));
        }
        return $data;
    }

    private function findCallsCountByDate($callsCounts, $date)
    {
        foreach ($callsCounts as $callCount) {
            if ($callCount['date'] == $date) {
                return intval($callCount['calls']);
            }
        }
        return 0;
    }

    public function actionFindCallCenterKpis()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new FreemiumCallCenterKpi();
        $data = $model->findKpisReport($searchParams->startDate, $searchParams->endDate);
        $syntelCallInfoModel = new SyntelCallInfo();
        $data['inbound_calls'] = $syntelCallInfoModel->countByCallPickerNumberAndDateAndType(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'inbound');
        $data['outbound_calls'] = $syntelCallInfoModel->countByCallPickerNumberAndDateAndType(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'outbound');
        $data['answered_calls'] = $syntelCallInfoModel->countAllAnsweredByCallPickerNumberAndDate(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate);
        return $data;
    }

    public function actionFindSummaryDetailData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new FreemiumSummaryDetail();
        $data = $model->findKpisReport($searchParams->startDate, $searchParams->endDate);
        $syntelCallInfoModel = new SyntelCallInfo();
        $data['nco_total_calls'] = $syntelCallInfoModel->countAllByCallPickerNumberAndDate(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate);
        $data['sale_reason'] = $syntelCallInfoModel->countByPurpose(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Ventas');
        $data['sale_reason_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['sale_reason'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_calls'] = $syntelCallInfoModel->countByPurpose(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Otros');
        $data['cust_serv_calls_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls'] * 100 / $data['nco_total_calls']));
        $data['sale_accepted'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Acepta Venta', null);
        $data['sale_accepted_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['sale_accepted'] * 100 / $data['nco_total_calls']));
        $data['call_scheduled'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Agenda Llamada', null);
        $data['call_scheduled_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['call_scheduled'] * 100 / $data['nco_total_calls']));
        $data['payment_promise_scheduled'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Agenda Promesa de Pago', null);
        $data['payment_promise_scheduled_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['payment_promise_scheduled'] * 100 / $data['nco_total_calls']));
        $data['deposit_slip_sent'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Se envía ficha de depósito', null);
        $data['deposit_slip_sent_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['deposit_slip_sent'] * 100 / $data['nco_total_calls']));
        // Asistencia Ubbitt
        $data['cust_serv_calls_product_questions'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Dudas de producto', 'Asistencia Ubbitt');
        $data['cust_serv_calls_product_questions_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls_product_questions'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_calls_product_advisory'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Asesorías de producto', 'Asistencia Ubbitt');
        $data['cust_serv_calls_product_advisory_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls_product_advisory'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_calls_product_linkage'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Enlace de producto', 'Asistencia Ubbitt');
        $data['cust_serv_calls_product_linkage_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls_product_linkage'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_calls_coverage_linkage'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Enlace de coberturas', 'Asistencia Ubbitt');
        $data['cust_serv_calls_coverage_linkage_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls_coverage_linkage'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_calls_ubbitt_assistance'] = intval($data['cust_serv_calls_product_questions']) + intval($data['cust_serv_calls_product_advisory']) + intval($data['cust_serv_calls_product_linkage']) + intval($data['cust_serv_calls_coverage_linkage']);
        $data['cust_serv_calls_ubbitt_assistance_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls_ubbitt_assistance'] * 100 / $data['nco_total_calls']));
        // Otros productos
        $data['cust_serv_calls_other_products_medical_expenses'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Gastos médicos', 'Otros Seguros') + $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Gastos Médicos Mayores', 'Otros Seguros');
        $data['cust_serv_calls_other_products_medical_expenses_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls_other_products_medical_expenses'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_calls_other_products_life'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Vida', 'Otros Seguros');
        $data['cust_serv_calls_other_products_life_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls_other_products_life'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_calls_other_products_legalized'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Legalizados', 'Otros Seguros');
        $data['cust_serv_calls_other_products_legalized_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls_other_products_legalized'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_calls_other_products_platforms'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Plataformas', 'Otros Seguros') + $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Plataformas (Uber, Didi, Cabify...)', 'Otros Seguros');
        $data['cust_serv_calls_other_products_platforms_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls_other_products_platforms'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_calls_other_products_residential'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Residencial', 'Otros Seguros');
        $data['cust_serv_calls_other_products_residential_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls_other_products_residential'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_calls_other_products'] = intval($data['cust_serv_calls_other_products_medical_expenses']) + intval($data['cust_serv_calls_other_products_life']) + intval($data['cust_serv_calls_other_products_legalized']) + intval($data['cust_serv_calls_other_products_platforms']) + intval($data['cust_serv_calls_other_products_residential']);
        $data['cust_serv_calls_other_products_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_calls_other_products'] * 100 / $data['nco_total_calls']));
        // Atención a clientes
        $data['cust_serv_cust_serv_report_advisor_care'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Reportar atención de asesor', 'Atención a Clientes (ATC)');
        $data['cust_serv_cust_serv_report_advisor_care_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_cust_serv_report_advisor_care'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_cust_serv_policy_renewal_review'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Revisión renovación de póliza', 'Atención a Clientes (ATC)');
        $data['cust_serv_cust_serv_policy_renewal_review_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_cust_serv_policy_renewal_review'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_cust_serv_product_cancellation'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Cancelación de producto', 'Atención a Clientes (ATC)');
        $data['cust_serv_cust_serv_product_cancellation_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_cust_serv_product_cancellation'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_cust_serv_check_expiration_dates'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Checar fechas de vigencia', 'Atención a Clientes (ATC)');
        $data['cust_serv_cust_serv_check_expiration_dates_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_cust_serv_check_expiration_dates'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_cust_serv'] = intval($data['cust_serv_cust_serv_report_advisor_care']) + intval($data['cust_serv_cust_serv_policy_renewal_review']) + intval($data['cust_serv_cust_serv_product_cancellation']) + intval($data['cust_serv_cust_serv_check_expiration_dates']);
        $data['cust_serv_cust_serv_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_cust_serv'] * 100 / $data['nco_total_calls']));
        // Dudas de cobranza
        $data['cust_serv_collection_questions_payment_track'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Seguimiento de pago', 'Cobranza');
        $data['cust_serv_collection_questions_payment_track_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_collection_questions_payment_track'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_collection_questions_payment_clarification'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Aclaraciones de pagos', null);
        $data['cust_serv_collection_questions_payment_clarification_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_collection_questions_payment_clarification'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_collection_questions_make_payment'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Realizar pago', 'Cobranza');
        $data['cust_serv_collection_questions_make_payment_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_collection_questions_make_payment'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_collection_questions_refund'] = $syntelCallInfoModel->countByTrackerNameAndStepName(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, 'Reembolsos', 'Atención a Clientes (ATC)');
        $data['cust_serv_collection_questions_refund_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_collection_questions_refund'] * 100 / $data['nco_total_calls']));
        $data['cust_serv_collection_questions'] = intval($data['cust_serv_collection_questions_payment_track']) + intval($data['cust_serv_collection_questions_refund']) + intval($data['cust_serv_collection_questions_payment_clarification']) + intval($data['cust_serv_collection_questions_make_payment']);
        $data['cust_serv_collection_questions_percentage'] = strval(NumberFormatter::truncateTwoDecimal($data['cust_serv_collection_questions'] * 100 / $data['nco_total_calls']));
        return $data;
    }
}