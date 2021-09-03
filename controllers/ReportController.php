<?php

namespace app\controllers;

use app\business\UploadReportBusiness;
use app\exception\UploadBusinessException;
use app\models\response\BaseResponse;
use Exception;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\web\ServerErrorHttpException;
use yii\web\UploadedFile;

class ReportController extends Controller
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
                        'actions' => ['upload', 'upload-file'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'upload' => ['get'],
                    'upload-file' => ['post'],
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

    public function actionUpload()
    {
        return $this->render('upload');
    }

    public function actionUploadFile()
    {
        $response = new BaseResponse();
        Yii::$app->response->format = Response::FORMAT_JSON;
        $file = UploadedFile::getInstanceByName('file');
        $uploadReportsBusiness = new UploadReportBusiness();
        try {
            $uploadReportsBusiness->saveReports($file);
        } catch (UploadBusinessException $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        } catch (Exception $exception) {
            Yii::error($exception);
            throw new ServerErrorHttpException();
        }
        return $response;
    }
}