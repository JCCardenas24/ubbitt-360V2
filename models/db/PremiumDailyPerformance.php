<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_daily_performance".
 *
 * @property integer $campaignId
 * @property date $uploadedDate
 * @property date $date
 *
 */
class PremiumDailyPerformance extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_daily_performance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campaign_id', 'upload_date', 'date', 'investment', 'leads', 'sales'], 'required'],
            [['campaign_id', 'leads'], 'integer'],
            [['investment', 'sales'], 'double'],
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
            'investment' => 'Inversión',
            'leads' => 'Leads',
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
        $date = new \yii\db\Expression("DATE_FORMAT(upload_date, '%d/%m/%Y') as upload_date, DATE_FORMAT(`date`, '%d/%m/%Y') as `date`, investment, leads, sales");
        return self::find()
            ->select($date)
            ->where(['between', 'date', $startDate, $endDate])
            ->andWhere(['campaign_id' => $campaignId])
            ->all();
    }
}