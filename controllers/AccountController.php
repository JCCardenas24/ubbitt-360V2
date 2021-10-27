<?php

namespace app\controllers;

use app\models\db\SyntelCallInfo;
use app\models\db\UserInfo;
use app\models\forms\ChangeEmail;
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
                        'actions' => ['profile', 'update-password', 'update-email'],
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
                    'update-email' => ['post'],
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

    public function actionUpdateEmail()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $changeEmailRequest = new ChangeEmail();
        $changeEmailRequest->load(Yii::$app->request->post());
        $username = Yii::$app->session->get("userIdentity")->username;
        $user = User::findByUsername($username);
        $user->email = $changeEmailRequest->newEmail;
        $user->save();
    }

    /**
     * Creates a new JWT token
     *
     *
     * @return Jwt
     */
    private function createToken()
    {
        /** @var Jwt $jwt */
        $jwt = Yii::$app->jwt;
        $signer = $jwt->getSigner('HS256');
        $key = $jwt->getKey();
        $time = time();
        return $jwt->getBuilder()
            ->issuedBy('http://ubbitt360.com') // Configures the issuer (iss claim)
            ->permittedFor('*') // Configures the audience (aud claim)
            ->identifiedBy('5c6fg4aad3d', true) // Configures the id (jti claim), replicating as a header item
            ->issuedAt($time) // Configures the time that the token was issue (iat claim)
            //->expiresAt($time + 15552000) // Configures the expiration time of the token (exp claim), the default time is 6 months
            ->withClaim('user', "backend") // Configures a new claim, called "clientId"}
            ->getToken($signer, $key); // Retrieves the generated token
    }
}