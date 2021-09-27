<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_leads_calls_graph".
 *
 * @property integer $campaignId
 * @property date $uploadDate
 * @property date $date
 * @property integer $leads
 * @property integer $calls
 *
 */
class PremiumLeadsCallsGraph extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_leads_calls_graph';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campaign_id', 'upload_date', 'date', 'leads', 'calls'], 'required'],
            [['campaign_id', 'leads', 'calls'], 'integer'],
            [['upload_date', 'date'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'campaign_id' => 'Id Campaña',
            'upload_date' => 'Fecha de carga',
            'date' => 'Fecha',
            'leads' => 'Leads',
            'calls' => 'Llamadas',
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

    public function getUploadDate()
    {
        return $this->upload_date;
    }

    public function setUploadDate($uploadDate)
    {
        $this->upload_date = $uploadDate;
    }

    public function findExisting()
    {
        return self::find()
            ->where(['date' => $this->date])
            ->andWhere(['campaign_id' => $this->campaignId])
            ->one();
    }

    public function findByDates($campaignId, $startDate, $endDate)
    {
        $date = new \yii\db\Expression("DATE_FORMAT(upload_date, '%d/%m/%Y') as upload_date, DATE_FORMAT(`date`, '%d/%m/%Y') as `date`, leads, calls");
        return self::find()
            ->select($date)
            ->where(['between', 'date', $startDate, $endDate])
            ->andWhere(['campaign_id' => $campaignId])
            ->all();
    }
}