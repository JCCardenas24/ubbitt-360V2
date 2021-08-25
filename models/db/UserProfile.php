<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "UserProfile".
 *
 * @property string $username
 * @property integer $permissionId
 *
 */
class UserProfile extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'profile_id'], 'required'],
            [['user_id'], 'string'],
            [['profile_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Id Usuario',
            'profile_id' => 'Id Perfil',
        ];
    }

    public function getPermissionId()
    {
        return $this->permission_id;
    }

    public function getProfileId()
    {
        return $this->profile_id;
    }

    /**
     * Deletes all profiles by user id
     * @param string $username
     */
    public static function deleteByUserId($userId)
    {
        self::deleteAll([
            'user_id' => $userId
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfilePermissions()
    {
        return $this->hasMany(ProfilePermission::class, ['profile_id' => 'profile_id']);
    }

    /**
     * @return \app\models\db\UserProfile
     */
    public function findUserProfileByUserId($userId)
    {
        return $this->findOne([
            'user_id' => $userId
        ]);
    }
}