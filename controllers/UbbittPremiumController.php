<?php

namespace app\controllers;

use app\models\db\PremiumAgeData;
use app\models\db\PremiumCampaignForecast;
use app\models\db\PremiumDailyPerformance;
use app\models\db\PremiumLeadsCallsGraph;
use app\models\db\PremiumMarketingInputs;
use app\models\db\PremiumMediaData;
use app\models\db\PremiumRegionData;
use app\models\db\PremiumScheduleData;
use app\models\db\PremiumSummaryGraph;
use app\models\db\PremiumSummaryInputs;
use app\models\db\webhook\WebHookCalls;
use app\models\forms\SearchByDateCampaignForm;
use app\models\forms\SearchByDateForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;

class UbbittPremiumController extends Controller
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
                            'dashboard', 'find-forecast-data', 'find-summary-graph-data', 'find-leads-calls-graph-data',
                            'find-summary-inputs-data', 'find-marketing-general-data',
                            'find-marketing-media-data', 'find-marketing-daily-performance-data', 'find-marketing-segment-data',
                            'find-calls'
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'dashboard' => ['get'],
                    'find-forecast-data' => ['post'],
                    'find-summary-graph-data' => ['post'],
                    'find-leads-calls-graph-data' => ['post'],
                    'find-summary-inputs-data' => ['post'],
                    'find-marketing-general-data' => ['post'],
                    'find-marketing-daily-performance-data' => ['post'],
                    'find-marketing-segment-data' => ['post'],
                    'find-calls' => ['post'],
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
        $campaignId = Yii::$app->request->get('id');
        return $this->render('dashboard', [
            'campaignId' => $campaignId
        ]);
    }

    public function actionFindForecastData()
    {
        $searchParams = new SearchByDateCampaignForm();
        $searchParams->load(Yii::$app->request->post());
        $forecastModel = new PremiumCampaignForecast();
        $data = $forecastModel->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindSummaryGraphData()
    {
        $searchParams = new SearchByDateCampaignForm();
        $searchParams->load(Yii::$app->request->post());
        $summaryGraphModel = new PremiumSummaryGraph();
        $data = $summaryGraphModel->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindLeadsCallsGraphData()
    {
        $searchParams = new SearchByDateCampaignForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new PremiumLeadsCallsGraph();
        $data = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindSummaryInputsData()
    {
        $searchParams = new SearchByDateCampaignForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new PremiumSummaryInputs();
        $data = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindMarketingGeneralData()
    {
        $searchParams = new SearchByDateCampaignForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new PremiumMarketingInputs();
        $data = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindMarketingMediaData()
    {
        $searchParams = new SearchByDateCampaignForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new PremiumMediaData();
        $data = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindMarketingDailyPerformanceData()
    {
        $searchParams = new SearchByDateCampaignForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new PremiumDailyPerformance();
        $data = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }

    public function actionFindMarketingSegmentData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = [];
        $searchParams = new SearchByDateCampaignForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new PremiumAgeData();
        $response['ageData'] = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        $model = new PremiumRegionData();
        $response['regionData'] = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        $model = new PremiumScheduleData();
        $response['scheduleData'] = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        return $response;
    }

    public function actionFindCalls()
    {
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $calls = new WebHookCalls();
        $callsArray = $calls->findByDate(Yii::$app->params['ubbitt_premium_did'], $searchParams->startDate, $searchParams->endDate, $searchParams->page);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $callsArray;
    }
}