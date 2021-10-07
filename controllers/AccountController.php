<?php

namespace app\controllers;

use app\models\db\UserInfo;
use app\models\forms\ChangePassword;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class AccountController extends Controller
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
                        'actions' => ['profile', 'update-password'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'profile' => ['get'],
                    'update-password' => ['post'],
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
    public function actionProfile()
    {
        $userId = Yii::$app->session->get("userIdentity")->user_id;
        $userInfo = UserInfo::findById($userId);
        $username = Yii::$app->session->get("userIdentity")->username;
        $user = User::findByUsername($username);
        return $this->render('profile', [
            'email' => $user->email,
            'userInfo' => $userInfo
        ]);
    }

    public function actionUpdatePassword()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $changePasswordRequest = new ChangePassword();
        $changePasswordRequest->load(Yii::$app->request->post());
        $username = Yii::$app->session->get("userIdentity")->username;
        $user = User::findByUsername($username);
        if (password_verify($changePasswordRequest->currentPassword, $user->password)) {
            $user->password = password_hash($changePasswordRequest->newPassword, PASSWORD_BCRYPT);
            $user->save();
        } else {
            throw new BadRequestHttpException('La contraseña actual es incorrecta');
        }
    }
}