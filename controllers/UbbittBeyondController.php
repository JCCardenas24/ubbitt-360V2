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
                        'actions' => ['collection-dashboard', 'find-collection-summary-graph-data', 'find-collection-call-center-kpis', 'find-collection-calls', 'download-collection-calls-audios', 'find-collection-sales', 'find-collection-summary-detail-data', 'renewal-dashboard', 'find-renewal-summary-graph-data', 'find-renewal-call-center-kpis', 'find-renewal-calls', 'find-renewal-sales', 'find-renewal-summary-detail-data', 'upload-database'],
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
                    'find-collection-summary-detail-data' => ['post'],
                    'renewal-dashboard' => ['get'],
                    'find-renewal-summary-graph-data' => ['post'],
                    'find-renewal-call-center-kpis' => ['post'],
                    'find-renewal-calls' => ['post'],
                    'find-renewal-sales' => ['post'],
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
        $callsArray = $calls->findByDateAndTerm(Yii::$app->params['ubbitt_beyond_collection_did'], $searchParams->startDate, $searchParams->endDate, $searchParams->term, $searchParams->page);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $callsArray;
    }

    public function actionDownloadCollectionCallsAudios()
    {
        $searchParams = new SearchByDateAndTermsForm();
        $searchParams->load(Yii::$app->request->get());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $this->downloadAudios($searchParams, Yii::$app->params['ubbitt_beyond_collection_did'], 'llamadas-audios-beyond-cobranza.zip');
    }

    private function downloadAudios(SearchByDateAndTermsForm $searchParams, $did, $zipFileName)
    {
        $callsModel = new WebHookCalls();
        $calls = $callsModel->findAllByDateAndTerm($did, $searchParams->startDate, $searchParams->endDate, $searchParams->term);

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

    public function actionFindRenewalSales()
    {
        $data = [];
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $data;
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