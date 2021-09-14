<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "user_info".
 *
 * @property integer $userId
 * @property string $name
 * @property string $phoneNumber
 * @property integer $companyId
 *
 */
class UserInfo extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'name', 'company_id'], 'required'],
            [['user_id', 'company_id'], 'integer'],
            [['name', 'phone_number'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'Id Permiso',
            'name' => 'Nombre',
            'phone_number' => 'Teléfono de contacto',
            'company_id' => 'Compañía',
        ];
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($userId)
    {
        $this->user_id = $userId;
    }

    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    public function setPhoneNumber($phoneNumber)
    {
        $this->phone_number = $phoneNumber;
    }

    public function getCompanyId()
    {
        return $this->company_id;
    }

    public function setCompanyId($companyId)
    {
        $this->company_id = $companyId;
    }

    /**
     * @return array
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['company_id' => 'company_id']);
    }

    /**
     * Finds a Permission by its id
     * @param integer $id
     * @return \app\models\db\UserInfo
     */
    public static function findById($id)
    {
        return self::findOne($id);
    }
}