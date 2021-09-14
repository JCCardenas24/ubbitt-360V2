<?php

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;
use DateTime;
use Yii;

use app\models\GeneratePasswordForm;
use app\models\PasswordReset;

class PasswordResetController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['request-reset','generate'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            /* 'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'index' => ['get', 'post'],
                    'logout' => ['get'],
                ],
            ], */
        ];
    }
    /**
     * {@inheritDoc}
     * @see \yii\web\Controller::beforeAction()
     */
    public function beforeAction($action)
    {
        $this->layout = 'login';
        return parent::beforeAction($action);
    }

    public function actionRequestReset() {
        if ($this->request->isPost) {
            $model = new PasswordReset();
            if ($model->load($this->request->post()) && $model->validate()) {
                $token = bin2hex(random_bytes(16));
                $now = new DateTime('now');

                $model->token = $token;
                $model->created_at = $now->format("Y-m-d H:i:s");
                $model->save();
                if($model->sendEmail()) {
                    Yii::$app->session->setFlash('success-reset', "Revisa la bandeja de tu correo electrónico para continuar con la recuperación de tu contraseña");
                } else {
                    Yii::$app->session->setFlash('reset-form-errors', ["send_mail" => ["Revisa la bandeja de tu correo electrónico para continuar con la recuperación de tu contraseña"]]);
                }
                return $this->goBack();
            } else {
                Yii::$app->session->setFlash('reset-form-errors', $model->getErrors());
                return $this->goBack();
            }
        } else {
            return $this->redirect('/login/index');
        }
    }

    public function actionGenerate($token) {
        // Yii::$app->params['reset_password_token_expires'];
        $model = new GeneratePasswordForm();
        
        return $this->render('generate-password', ['model' => $model]);
    } 
}
