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
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

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
                        'actions' => ['collection-dashboard', 'find-collection-summary-graph-data', 'find-collection-call-center-kpis', 'find-collection-calls', 'find-collection-summary-detail-data', 'renewal-dashboard', 'find-renewal-summary-graph-data', 'find-renewal-call-center-kpis', 'find-renewal-calls', 'find-renewal-summary-detail-data'],
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
                    'find-collection-summary-detail-data' => ['post'],
                    'renewal-dashboard' => ['get'],
                    'find-renewal-summary-graph-data' => ['post'],
                    'find-renewal-call-center-kpis' => ['post'],
                    'find-renewal-calls' => ['post'],
                    'find-renewal-summary-detail-data' => ['post'],
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
        return $this->render('collection-dashboard', [
            'reportFileModel' => $reportFileModel
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
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $calls = new WebHookCalls();
        $callsArray = $calls->findByDate(Yii::$app->params['ubbitt_beyond_collection_did'], $searchParams->startDate, $searchParams->endDate, $searchParams->page);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $callsArray;
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
        return $this->render('renewal-dashboard', [
            'reportFileModel' => $reportFileModel
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
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $calls = new WebHookCalls();
        $callsArray = $calls->findByDate(Yii::$app->params['ubbitt_beyond_renewal_did'], $searchParams->startDate, $searchParams->endDate, $searchParams->page);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $callsArray;
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
}