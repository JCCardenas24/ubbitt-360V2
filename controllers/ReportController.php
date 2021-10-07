<?php

namespace app\controllers;

use app\business\UploadPremiumReportBusiness;
use app\business\UploadReportBusiness;
use app\exception\UploadBusinessException;
use app\models\forms\CampaignForm;
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
                        'actions' => ['upload', 'upload-file', 'upload-premium', 'upload-premium-file'],
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
                    'upload-premium' => ['get'],
                    'upload-premium-file' => ['post'],
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
    }

    public function actionUploadPremium()
    {
        return $this->render('upload-premium');
    }

    public function actionUploadPremiumFile()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $file = UploadedFile::getInstanceByName('file');
        $companyForm = new CampaignForm();
        $companyForm->load($this->request->post());
        $uploadReportsBusiness = new UploadPremiumReportBusiness();
        try {
            $uploadReportsBusiness->saveReports($companyForm->campaignId, $file);
        } catch (UploadBusinessException $exception) {
            throw new BadRequestHttpException($exception->getMessage());
        } catch (Exception $exception) {
            Yii::error($exception);
            throw new ServerErrorHttpException();
        }
    }
}