<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_schedule_data".
 *
 * @property integer $campaignId
 * @property date $date
 * @property string $media
 *
 */
class PremiumScheduleData extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_schedule_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'campaign_id', 'date',
                'schedule_06_10_clicks', 'schedule_06_10_impressions', 'schedule_11_13_clicks', 'schedule_11_13_impressions',
                'schedule_14_16_clicks', 'schedule_14_16_impressions', 'schedule_17_20_clicks', 'schedule_17_20_impressions',
                'schedule_21_23_clicks', 'schedule_21_23_impressions', 'schedule_00_02_clicks', 'schedule_00_02_impressions'
            ], 'required'],
            [[
                'campaign_id',
                'schedule_06_10_clicks', 'schedule_06_10_impressions', 'schedule_11_13_clicks', 'schedule_11_13_impressions',
                'schedule_14_16_clicks', 'schedule_14_16_impressions', 'schedule_17_20_clicks', 'schedule_17_20_impressions',
                'schedule_21_23_clicks', 'schedule_21_23_impressions', 'schedule_00_02_clicks', 'schedule_00_02_impressions'
            ], 'integer'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'campaign_id' => 'Id Campaña',
            'date' => 'Fecha',
            'schedule_06_10_clicks' => '06:00-10:00 clicks',
            'schedule_06_10_impressions' => '06:00-10:00 Impresiones',
            'schedule_11_13_clicks' => '11:00-13:00 clicks',
            'schedule_11_13_impressions' => '11:00-13:00 impresiones',
            'schedule_14_16_clicks' => '14:00-16:00 clicks',
            'schedule_14_16_impressions' => '14:00-16:00 Impresiones',
            'schedule_17_20_clicks' => '17:00-20:00 clicks',
            'schedule_17_20_impressions' => '17:00-20:00 impresiones',
            'schedule_21_23_clicks' => '21:00-23:00 clicks',
            'schedule_21_23_impressions' => '21:00-23:00 impresiones',
            'schedule_00_02_clicks' => '00:00-02:00 clicks',
            'schedule_00_02_impressions' => '00:00-02:00 impresiones'
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

    public function findExisting()
    {
        return self::find()
            ->where(['date' => $this->date])
            ->andWhere(['campaign_id' => $this->campaignId])
            ->one();
    }

    public function findByDates($campaignId, $startDate, $endDate)
    {
        return Yii::$app->db->createCommand('
            SELECT
                COALESCE(SUM(schedule_06_10_clicks), 0) AS schedule_06_10_clicks,
                COALESCE(SUM(schedule_06_10_impressions), 0) AS schedule_06_10_impressions,
                COALESCE(SUM(schedule_11_13_clicks), 0) AS schedule_11_13_clicks,
                COALESCE(SUM(schedule_11_13_impressions), 0) AS schedule_11_13_impressions,
                COALESCE(SUM(schedule_14_16_clicks), 0) AS schedule_14_16_clicks,
                COALESCE(SUM(schedule_14_16_impressions), 0) AS schedule_14_16_impressions,
                COALESCE(SUM(schedule_17_20_clicks), 0) AS schedule_17_20_clicks,
                COALESCE(SUM(schedule_17_20_impressions), 0) AS schedule_17_20_impressions,
                COALESCE(SUM(schedule_21_23_clicks), 0) AS schedule_21_23_clicks,
                COALESCE(SUM(schedule_21_23_impressions), 0) AS schedule_21_23_impressions,
                COALESCE(SUM(schedule_00_02_clicks), 0) AS schedule_00_02_clicks,
                COALESCE(SUM(schedule_00_02_impressions), 0) AS schedule_00_02_impressions
            FROM premium_schedule_data
            WHERE date BETWEEN :startDate AND :endDate
                AND campaign_id = :campaignId', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'campaignId' => $campaignId
        ])->queryOne();
    }
}