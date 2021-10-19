<?php

namespace app\controllers;

use app\models\db\Campaign;
use app\models\db\FreemiumCallCenterKpi;
use app\models\db\FreemiumSummaryDetail;
use app\models\db\FreemiumSummaryGraph;
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
use app\models\utils\FilenameHelper;
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
        $url = Yii::$app->params['sales_database_service_url'] . $searchParams->startDate . '/' . $searchParams->endDate . '/' . $searchParams->page . '/0eb422ebc0760f6a22c3c24125aa5f9b';
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
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $summaryGraphModel = new FreemiumSummaryGraph();
        $data = $summaryGraphModel->findByDates($searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindCallCenterKpis()
    {
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new FreemiumCallCenterKpi();
        $data = $model->findKpisReport($searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindSummaryDetailData()
    {
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new FreemiumSummaryDetail();
        $data = $model->findKpisReport($searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
}