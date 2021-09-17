<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "password_resets".
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property string $created_at
 */
class PasswordReset extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'password_resets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'trim'],
            [['email'], 'string', 'max' => 100],
            [
                'email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => 1],
                'message' => 'No existe un usuario con esa dirección de correo electrónico.'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'token' => 'Token',
            'created_at' => 'Created At',
        ];
    }

    public function sendEmail()
    {
        $user = User::findOne([
            'email' => $this->email,
        ]);

        /* if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
            $user->generatePasswordResetToken();
            if (!$user->save()) {
                return false;
            }
        } */

        return Yii::$app
            ->mailer
            ->compose('forgot-password', ['user' => $user, 'token' => $this->token])
            ->setFrom(Yii::$app->params['email_sender'])
            ->setTo($this->email)
            ->setSubject('Restauración de contraseña en ' . Yii::$app->name)
            ->send();
    }

    public function findByToken($token)
    {
        return self::findOne([
            'token' => $token,
        ]);
    }
}