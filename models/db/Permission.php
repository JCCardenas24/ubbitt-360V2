<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "Permission".
 *
 * @property integer $permissionId
 * @property string $name
 * @property string $codeName
 * @property integer $parentPermission
 * @property array $subPermissions
 *
 */
class Permission extends ActiveRecord
{

    public $subPermissions = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permission';
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
            [['permission_id', 'name', 'code_name'], 'required'],
            [['parent_permission', 'type'], 'integer'],
            [['name', 'code_name'], 'string'],
            [['subPermissions'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permission_id' => 'Id Permiso',
            'name' => 'Nombre',
            'code_name' => 'Nombre Código',
            'user_id' => 'Tipo',
            'parent_permission' => 'Permiso padre',
            'subPermissions' => 'Sub permisos',
        ];
    }

    public function getPermissionId()
    {
        return $this->permission_id;
    }

    public function getCodeName()
    {
        return $this->code_name;
    }

    public function getParentPermission()
    {
        return $this->parent_permission;
    }

    /**
     * @return array
     */
    public function getUserProfile()
    {
        return $this->hasMany(UserProfile::class, ['permission_id' => 'permission_id']);
    }

    /**
     * Finds a Permission by its id
     * @param integer $id
     * @return \app\s\db\Permission
     */
    public function findById($id)
    {
        return self::findOne($id);
    }

    /**
     * Finds all parent permissions
     * @param integer $id
     * @return array
     */
    public function findAllParentPermissions()
    {
        return self::findAll(['parent_permission' => null]);
    }

    /**
     * Finds permissions by their parent
     * @param integer $id
     * @return array
     */
    public function findSubPermissions($permissionId)
    {
        return self::findAll(['parent_permission' => $permissionId]);
    }
}