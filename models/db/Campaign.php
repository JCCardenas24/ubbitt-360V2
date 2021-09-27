<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "freemium_campaign".
 *
 * @property integer $campaignId
 * @property integer $companyId
 * @property string $name
 * @property double $investment
 * @property double $spending
 * @property double $sales
 *
 */
class Campaign extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'freemium_campaign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campaign_id', 'company_id', 'name', 'investment', 'spending', 'sales',], 'required'],
            [['campaign_id', 'company_id',], 'integer'],
            [['name',], 'string'],
            [['investment', 'spending', 'sales',], 'double'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'campaign_id' => 'Id Campaña',
            'company_id' => 'Id Compañía',
            'name' => 'Nombre',
            'investment' => 'Inversión',
            'spending' => 'Gasto',
            'sales' => 'Ventas',
        ];
    }

    public function getCampaignId()
    {
        return $this->campaign_id;
    }

    public function setCampaignId($campaignId)
    {
        $this->campaign_id = $campaignId;
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
     * Finds a Campaign by its id
     * @param integer $id
     * @return \app\models\db\Campaign
     */
    public function findById($id)
    {
        return self::findOne($id);
    }

    public function findByCompanyId($companyId)
    {
        return self::find()
            ->where(['company_id' => $companyId])
            ->all();
    }
}