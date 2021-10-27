<?php

namespace app\controllers;

use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\VerbFilter;
use yii\rest\Controller;

class TestController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'index' => ['get'],
            ],
        ];

        return $behaviors;
    }

    public function actionIndex()
    {
        return ['ok' => 200];
    }
}