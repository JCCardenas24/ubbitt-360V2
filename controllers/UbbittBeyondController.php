<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

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
                        'actions' => ['collection-dashboard', 'renewal-dashboard'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'collection-dashboard' => ['get'],
                    'renewal-dashboard' => ['get'],
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
        return $this->render('collection-dashboard');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionRenewalDashboard()
    {
        return $this->render('renewal-dashboard');
    }
}