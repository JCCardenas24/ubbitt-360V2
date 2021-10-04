<?php

namespace app\controllers;

use app\models\db\Campaign;
use app\models\db\PremiumAgeData;
use app\models\db\PremiumBrief;
use app\models\db\PremiumCallCenterKpi;
use app\models\db\PremiumCampaignForecast;
use app\models\db\PremiumDailyPerformance;
use app\models\db\PremiumLeadsCallsGraph;
use app\models\db\PremiumMarketingInputs;
use app\models\db\PremiumMediaData;
use app\models\db\PremiumRegionData;
use app\models\db\PremiumScheduleData;
use app\models\db\PremiumSummaryGraph;
use app\models\db\PremiumSummaryInputs;
use app\models\db\PremiumVehicleModel;
use app\models\db\PremiumVehicleYear;
use app\models\db\webhook\WebHookCalls;
use app\models\forms\PremiumBriefForm;
use app\models\response\PremiumHeader;
use app\models\forms\SearchByDateCampaignForm;
use app\models\forms\SearchByDateForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
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
                            'dashboard', 'find-header-data', 'find-forecast-data', 'find-summary-graph-data', 'find-leads-calls-graph-data',
                            'find-summary-inputs-data', 'find-marketing-general-data',
                            'find-marketing-media-data', 'find-marketing-daily-performance-data', 'find-marketing-segment-data',
                            'find-calls', 'find-marketing-kpis-data',
                            'find-brief',
                            'save-brief'
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
                    'find-header-data' => ['post'],
                    'find-forecast-data' => ['post'],
                    'find-summary-graph-data' => ['post'],
                    'find-leads-calls-graph-data' => ['post'],
                    'find-summary-inputs-data' => ['post'],
                    'find-marketing-general-data' => ['post'],
                    'find-marketing-daily-performance-data' => ['post'],
                    'find-marketing-segment-data' => ['post'],
                    'find-calls' => ['post'],
                    'find-marketing-kpis-data' => ['post'],
                    'find-brief' => ['post'],
                    'save-brief' => ['post'],
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

    public function actionFindHeaderData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchParams = new SearchByDateCampaignForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new PremiumSummaryInputs();
        $summaryInputsData = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        $forecastModel = new PremiumCampaignForecast();
        $forecastData = $forecastModel->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        $summaryGraphModel = new PremiumSummaryGraph();
        $summaryGraphData = $summaryGraphModel->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        $headerData = new PremiumHeader();
        $headerData->investment = $forecastData['ubbitt_investment'];
        $headerData->sales = array_reduce($summaryGraphData, function ($carry, $item) {
            if ($item->type == 'actual') {
                $carry += $item->sales;
            }
            return $carry;
        }, 0);
        $headerData->spentBudget = $summaryInputsData['spent_budget'];
        return $headerData;
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
        $model = new PremiumVehicleModel();
        $response['topModelsData'] = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        $model = new PremiumVehicleYear();
        $response['topYearsData'] = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
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

    public function actionFindMarketingKpisData()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchParams = new SearchByDateCampaignForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new PremiumCallCenterKpi();
        $data = $model->findByDates($searchParams->campaignId, $searchParams->startDate, $searchParams->endDate);
        return $data;
    }

    public function actionFindBrief()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $searchParams = new SearchByDateCampaignForm();
        $searchParams->load(Yii::$app->request->post());
        $model = new PremiumBrief();
        $data = $model->findByCampaignId($searchParams->campaignId);
        $campaignModel = new Campaign();
        $campaign = $campaignModel->findById($searchParams->campaignId);
        $returnModel = new PremiumBriefForm();
        $returnModel->name = $campaign->name;
        if ($data != null) {
            $returnModel->industryType = $data->industry_type;
            $returnModel->productDescription = $data->product_description;
            $returnModel->productInsights = $data->product_insights;
            $returnModel->productAddedValue = $data->product_added_value;
            $returnModel->productAveragePrice = $data->product_average_price;
            $returnModel->productFirstPaymentAveragePrice = $data->product_first_payment_average_price;
            $returnModel->paymentFrequencyYearly = $data->payment_frequency_yearly;
            $returnModel->paymentFrequencyBiannual = $data->payment_frequency_biannual;
            $returnModel->paymentFrequencyQuarterly = $data->payment_frequency_quarterly;
            $returnModel->paymentFrequencyMonthly = $data->payment_frequency_monthly;
            $returnModel->paymentTypeCash = $data->payment_type_cash;
            $returnModel->paymentTypeCardMonthsWithoutInterest = $data->payment_type_card_months_without_interest;
            $returnModel->paymentTypeCardSinglePayment = $data->payment_type_card_single_payment;
            $returnModel->paymentMethodCard = $data->payment_method_card;
            $returnModel->paymentMethodCashPickup = $data->payment_method_cash_pickup;
            $returnModel->paymentMethodWireTransfer = $data->payment_method_wire_transfer;
            $returnModel->investment = $data->investment;
            $returnModel->startDate = $data->start_date;
            $returnModel->endDate = $data->end_date;
            $returnModel->expectedBiddingPerLead = $data->expected_bidding_per_lead;
            $returnModel->expectedTotalSales = $data->expected_total_sales;
        }
        return $returnModel;
    }

    public function actionSaveBrief()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $briefForm = new PremiumBriefForm();
        $briefForm->load(Yii::$app->request->post());

        $campaignModel = new Campaign();
        $campaign = $campaignModel->findById($briefForm->campaignId);

        if ($campaign == null) {
            throw new BadRequestHttpException('La campaña no existe');
        }
        $campaign->name = $briefForm->name;
        $campaign->save();

        $briefDbModel = new PremiumBrief();
        $briefDb = $briefDbModel->findByCampaignId($briefForm->campaignId);
        if ($briefDb == null) {
            $briefDb = new PremiumBrief();
            $briefDb->campaignId = $briefForm->campaignId;
        }
        $briefDb->industry_type = $briefForm->industryType;
        $briefDb->product_description = $briefForm->productDescription;
        $briefDb->product_insights = $briefForm->productInsights;
        $briefDb->product_added_value = $briefForm->productAddedValue;
        $briefDb->product_average_price = $briefForm->productAveragePrice;
        $briefDb->product_first_payment_average_price = $briefForm->productFirstPaymentAveragePrice;
        $briefDb->payment_frequency_yearly = $briefForm->paymentFrequencyYearly;
        $briefDb->payment_frequency_biannual = $briefForm->paymentFrequencyBiannual;
        $briefDb->payment_frequency_quarterly = $briefForm->paymentFrequencyQuarterly;
        $briefDb->payment_frequency_monthly = $briefForm->paymentFrequencyMonthly;
        $briefDb->payment_type_cash = $briefForm->paymentTypeCash;
        $briefDb->payment_type_card_months_without_interest = $briefForm->paymentTypeCardMonthsWithoutInterest;
        $briefDb->payment_type_card_single_payment = $briefForm->paymentTypeCardSinglePayment;
        $briefDb->payment_method_card = $briefForm->paymentMethodCard;
        $briefDb->payment_method_cash_pickup = $briefForm->paymentMethodCashPickup;
        $briefDb->payment_method_wire_transfer = $briefForm->paymentMethodWireTransfer;
        $briefDb->investment = $briefForm->investment;
        $briefDb->start_date = $briefForm->startDate;
        $briefDb->end_date = $briefForm->endDate;
        $briefDb->expected_bidding_per_lead = $briefForm->expectedBiddingPerLead;
        $briefDb->expected_total_sales = $briefForm->expectedTotalSales;
        $briefDb->save();
    }
}