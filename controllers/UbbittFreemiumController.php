<?php

namespace app\controllers;

use app\models\db\FreemiumCallCenterKpi;
use app\models\db\FreemiumSummaryDetail;
use app\models\db\FreemiumSummaryGraph;
use app\models\db\webhook\WebHookCalls;
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
                        'actions' => ['dashboard', 'find-calls', 'find-summary-graph-data', 'find-call-center-kpis', 'find-summary-detail-data'],
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