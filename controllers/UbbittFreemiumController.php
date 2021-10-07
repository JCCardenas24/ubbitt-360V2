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
                        'actions' => ['dashboard', 'find-calls', 'find-sales', 'find-summary-graph-data', 'find-call-center-kpis', 'find-summary-detail-data'],
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
                    'find-sales' => ['post'],
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
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $calls = new WebHookCalls();
        $callsArray = $calls->findByDate(Yii::$app->params['ubbitt_freemium_did'], $searchParams->startDate, $searchParams->endDate, $searchParams->page);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $callsArray;
    }

    public function actionFindSales()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $url = Yii::$app->params['sales_database_service_url'] . $searchParams->startDate . '/' . $searchParams->endDate . '/' . $searchParams->page . '/0eb422ebc0760f6a22c3c24125aa5f9b';
        if (!empty($searchParams->term)) {
            $url .= '/' . urlencode($searchParams->term);
        }
        $response = file_get_contents($url);
        $response = json_decode($response);
        $data = [];
        $data['totalPages'] = $response[1];
        $data['salesRecords'] = $response[2];
        return $data;
    }

    function actionDownloadPolicies()
    {
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->post());
        $url = Yii::$app->params['sales_database_service_url'] . $searchParams->startDate . '/' . $searchParams->endDate . '/1/0eb422ebc0760f6a22c3c24125aa5f9b';
        if (!empty($searchParams->term)) {
            $url .= '/' . urlencode($searchParams->term);
        }
        $response = file_get_contents($url);
        $response = json_decode($response);
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