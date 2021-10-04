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
use app\models\User;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use DateTime;

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
                        'actions' => ['collection-dashboard', 'find-collection-summary-graph-data', 'find-collection-call-center-kpis', 'find-collection-calls', 'find-collection-sales', 'find-collection-summary-detail-data', 'renewal-dashboard', 'find-renewal-summary-graph-data', 'find-renewal-call-center-kpis', 'find-renewal-calls', 'find-renewal-summary-detail-data', 'upload-database'],
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
                    'find-collection-sales' => ['post'],
                    'find-collection-summary-detail-data' => ['post'],
                    'renewal-dashboard' => ['get'],
                    'find-renewal-summary-graph-data' => ['post'],
                    'find-renewal-call-center-kpis' => ['post'],
                    'find-renewal-calls' => ['post'],
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
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $calls = new WebHookCalls();
        $callsArray = $calls->findByDate(Yii::$app->params['ubbitt_beyond_collection_did'], $searchParams->startDate, $searchParams->endDate, $searchParams->page);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $callsArray;
    }
    
    public function actionFindCollectionSales()
    {
        $data = [];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
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

    public function actionUploadDatabase() {
        if ($this->request->isPost) {
            $model = new DatabaseUpload();
     
            if ($model->load($this->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
     
                if ($model->validate()) {
                    $filePath = "uploads/database_".$model->module_origin."_".$model->submodule_origin."_".time().".".$model->file->extension;

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
                        ->setFrom(Yii::$app->params['email_sender'])
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