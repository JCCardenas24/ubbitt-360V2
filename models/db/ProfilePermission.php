<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "ProfilePermission".
 *
 * @property integer $permissionId
 * @property string $name
 * @property string $codeName
 * @property integer $parentPermission
 * @property array $subPermissions
 *
 */
class ProfilePermission extends ActiveRecord
{

    public $subPermissions = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile_permission';
    }

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->subPermissions = [];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'permission_id'], 'required'],
            [['profile_id', 'permission_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permission_id' => 'Id Permiso',
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
     * @return \yii\db\ActiveQuery
     */
    public function getPermissions()
    {
        return $this->hasMany(Permission::class, ['permission_id' => 'permission_id']);
    }

    /**
     * @return array
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::class, ['profile_id' => 'profile_id']);
    }

    /**
     * Finds permissions by their parent
     * @param integer $id
     * @return array
     */
    // public function findsubPermissions($permissionId)
    // {
    //     return self::findAll(['parent_permission' => $permissionId]);
    // }

    /**
     * Finds all the parent permissions for the user
     * @param string $userId
     * @return array \app\s\db\Permission
     */
    // public function findPermissionsByUserId($userId)
    // {
    //     //with('userProfile') sentence is used to load the document data all at once
    //     //instead of asking for it to the database each time
    //     return $this->find()
    //         ->with('userProfile')
    //         ->innerJoinWith('userProfile', 'Permission.permission_id = userProfile.permission_id')
    //         ->where(['user_profile.user_id' => $userId, 'parent_permission' => null])
    //         ->orderBy('permission_id ASC')
    //         ->all();
    // }

    /**
     * Finds all the sub permissions for the user by parent permission id
     * @param string $permissionId
     * @param string $userId
     * @return array \app\s\db\Permission
     */
    // public function findsubPermissionsByPermissionIdAndUsername($permissionId, $userId)
    // {
    //     //with('userProfiles') sentence is used to load the document data all at once
    //     //instead of asking for it to the database each time
    //     return $this->find()
    //         ->with('userProfile')
    //         ->innerJoinWith('userProfile', 'Permission.permission_id = userProfile.permission_id')
    //         ->where(['user_profile.user_id' => $userId, 'parent_permission' => $permissionId])
    //         ->orderBy('permission_id ASC')
    //         ->all();
    // }
}