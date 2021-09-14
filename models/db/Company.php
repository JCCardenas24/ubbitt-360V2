<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "company".
 *
 * @property integer $companyId
 * @property string $name
 * @property string $businessName
 * @property string $address
 * @property string $city
 * @property string $municipality
 * @property string $zipCode
 * @property string $email
 * @property string $phone
 *
 */
class Company extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'name', 'business_name', 'address', 'city', 'municipality', 'zip_code'], 'required'],
            [['company_id',], 'integer'],
            [['name', 'business_name', 'address', 'city', 'municipality', 'zip_code', 'email', 'phone'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'company_id' => 'Id Compañía',
            'name' => 'Nombre',
            'business_name' => 'Razón social',
            'address' => 'Dirección',
            'city' => 'Ciudad',
            'municipality' => 'Municipio',
            'zip_code' => 'Código postal',
            'email' => 'Email',
            'phone' => 'Teléfono',
        ];
    }

    public function getCompanyId()
    {
        return $this->company_id;
    }

    public function setCompanyId($companyId)
    {
        $this->company_id = $companyId;
    }

    public function getBusinessName()
    {
        return $this->business_name;
    }

    public function setBusinessName($businessName)
    {
        $this->business_name = $businessName;
    }

    public function getZipCode()
    {
        return $this->zip_code;
    }

    public function setZipCode($zipCode)
    {
        $this->zip_code = $zipCode;
    }

    /**
     * Finds a Permission by its id
     * @param integer $id
     * @return \app\models\db\UserInfo
     */
    public function findById($id)
    {
        return self::findOne($id);
    }
}