<?php

namespace app\controllers;

use app\models\ReportFile;
use app\models\ReportFileSearch;
use DateTime;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;
use app\models\forms\SearchByDateForm;
use yii\web\Response;

/**
 * ReportFileController implements the CRUD actions for ReportFile model.
 */
class ReportFileController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['GET'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ReportFile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReportFileSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReportFile model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ReportFile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ReportFile();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->validate()) {
                    $filePath = "uploads/report_freemium_".time().".".$model->file->extension;
                    if ($model->file->saveAs($filePath)) {
                        $model->file_path = $filePath;
                        $model->user_id = Yii::$app->user->id;
                        $now = new DateTime('now');
                        $model->created_at = $now->format("Y-m-d H:i:s");
                        $model->updated_at = $now->format("Y-m-d H:i:s");

                        $model->save(false);
                        return $this->redirect(Yii::$app->request->referrer);                        
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('dashboard', [
            'reportFileModel' => $model
        ]);
    }

    /**
     * Updates an existing ReportFile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ReportFile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        if(file_exists($model->file_path)) {
            unlink($model->file_path);
        }
        
        $model->delete();
        
        return $this->redirect('/ubbitt-freemium/dashboard');
    }

    /**
     * Finds the ReportFile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ReportFile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReportFile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionFindReports()
    {
        $searchParams = new SearchByDateForm();
        $searchParams->load(Yii::$app->request->post());
        $searchParams->page = $searchParams->page == null ? 1 : $searchParams->page;
        $reports = new ReportFile();
        $reportsArray = $reports->findByDate($searchParams->startDate, $searchParams->endDate, $searchParams->page);
        Yii::$app->response->format = Response::FORMAT_JSON;
        return $reportsArray;
    }
}
