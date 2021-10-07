<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_campaign_forecast".
 *
 * @property integer $campaignId
 * @property string $date
 * @property double $ubbittInvestment
 * @property double $salesForecast
 * @property double $collectedForecast
 *
 */
class PremiumCampaignForecast extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_campaign_forecast';
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
     * Finds a campaign forecast registry by it's date
     */
    public function findExisting()
    {
        return self::find()
            ->where(['date' => $this->date])
            ->andWhere(['campaign_id' => $this->campaignId])
            ->one();
    }

    /**
     * Find the campaign forecast by a range date and it's campaign id
     * @param integer $campaignId
     * @param string $startDate
     * @param string $endDate
     * @return \app\models\db\CampaignForecast
     */
    public function findByDates($campaignId, $startDate, $endDate)
    {
        return Yii::$app->db->createCommand('
            SELECT
                COALESCE(SUM(ubbitt_investment), 0) AS ubbitt_investment,
                COALESCE(SUM(sales_forecast), 0) AS sales_forecast,
                COALESCE(SUM(collected_forecast), 0) AS collected_forecast
            FROM premium_campaign_forecast
            WHERE date BETWEEN :startDate AND :endDate
                AND campaign_id = :campaignId', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'campaignId' => $campaignId,
        ])->queryOne();
    }
}