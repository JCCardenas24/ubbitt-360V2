<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_media_data".
 *
 * @property integer $campaignId
 * @property date $date
 * @property string $media
 *
 */
class PremiumMediaData extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_media_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'campaign_id', 'date', 'media', 'impressions', 'clicks', 'visits', 'leads', 'contacted', 'sales',
            ], 'required'],
            [['campaign_id', 'impressions', 'clicks', 'visits', 'leads', 'contacted', 'sales'], 'integer'],
            [['media',], 'string'],
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
            'media' => 'Medio',
            'impressions' => 'Impresiones',
            'clicks' => 'Clicks',
            'visits' => 'Visitas',
            'leads' => 'Leads',
            'contacted' => 'Contactados',
            'sales' => 'Ventas'
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
            ->andWhere(['media' => $this->media])
            ->one();
    }

    public function findByDates($campaignId, $startDate, $endDate)
    {
        return Yii::$app->db->createCommand('
                SELECT
                    media,
                    COALESCE(SUM(impressions), 0) AS impressions,
                    COALESCE(SUM(clicks), 0) AS clicks,
                    COALESCE(SUM(visits), 0) AS visits,
                    COALESCE(SUM(leads), 0) AS leads,
                    COALESCE(SUM(contacted), 0) AS contacted,
                    COALESCE(SUM(sales), 0) AS sales
                FROM premium_media_data
                WHERE date BETWEEN :startDate AND :endDate
                    AND campaign_id = :campaignId
                GROUP BY media
                ORDER BY media', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'campaignId' => $campaignId
        ])->queryOne();
    }
}