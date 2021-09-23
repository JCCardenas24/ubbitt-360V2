<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "freemium_campaign_forecast".
 *
 * @property integer $campaignId
 * @property string $date
 * @property double $ubbittInvestment
 * @property double $salesForecast
 * @property double $collectedForecast
 *
 */
class CampaignForecast extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'freemium_campaign_forecast';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campaign_id', 'date', 'ubbitt_investment', 'sales_forecast', 'collected_forecast'], 'required'],
            [['campaign_id',], 'integer'],
            [['date',], 'date', 'format' => 'php:Y-m-d'],
            [['ubbitt_investment', 'sales_forecast', 'collected_forecast',], 'double'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'campaign_id' => 'Id Campaña',
            'date' => 'Date',
            'ubbitt_investment' => 'Inversión Ubbitt',
            'sales_forecast' => 'Forecast Ventas',
            'collected_forecast' => 'Forecast Cobrado',
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

    public function getUbbittInvestment()
    {
        return $this->ubbitt_investment;
    }

    public function setUbbittInvestment($ubbittInvestment)
    {
        $this->ubbitt_investment = $ubbittInvestment;
    }

    public function getSalesForecast()
    {
        return $this->sales_forecast;
    }

    public function setSalesForecast($salesForecast)
    {
        $this->sales_forecast = $salesForecast;
    }

    public function getCollectedForecast()
    {
        return $this->collected_forecast;
    }

    public function setCollectedForecast($collectedForecast)
    {
        $this->collected_forecast = $collectedForecast;
    }

    /**
     * Find the campaign forecast by a range date and it's campaign id
     * @param integer $campaignId
     * @param string $startDate
     * @param string $endDate
     * @return \app\models\db\CampaignForecast
     */
    public function findReport($campaignId, $startDate, $endDate)
    {
        $date = new \yii\db\Expression("DATE_FORMAT(date, '%d/%m/%Y') as `date`, ubbitt_investment, sales_forecast, collected_forecast");
        return self::find()
            ->select($date)
            ->where(['between', 'date', $startDate, $endDate])
            ->andWhere(['campaign_id' => $campaignId])
            ->all();
    }

    /**
     * Finds a campaign forecast registry by it's date
     */
    public function findByDate()
    {
        return self::find()
            ->where(['date' => $this->date])
            ->one();
    }
}