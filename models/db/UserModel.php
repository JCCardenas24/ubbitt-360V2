<?php

namespace app\models\db;

use yii\db\ActiveRecord;

class UserModel extends ActiveRecord
{
    public $username;
    public $password;

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