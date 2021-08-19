<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class UserModel extends ActiveRecord
{
    public $id;
    public $username;
    public $password;
    // public $authKey;
    // public $accessToken;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return UserModel::find()
            ->where(['user_id' => $id])
            ->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // foreach (self::$users as $user) {
        //     if ($user['accessToken'] === $token) {
        //         return new static($user);
        //     }
        // }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return UserModel::find()
            ->where(['username' => $username])
            ->one();
    }
}