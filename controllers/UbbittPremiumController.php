<?php

namespace app\controllers;

use app\models\db\PremiumCampaignForecast;
use app\models\db\PremiumLeadsCallsGraph;
use app\models\db\PremiumSummaryGraph;
use app\models\forms\SearchByDateCampaignForm;
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
                        'actions' => ['dashboard', 'find-forecast-data', 'find-summary-graph-data', 'find-leads-calls-graph-data'],
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
        $summaryGraphModel = new PremiumLeadsCallsGraph();
        $data = $summaryGraphModel->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
    }
}