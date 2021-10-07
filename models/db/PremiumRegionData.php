<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_region_data".
 *
 * @property integer $campaignId
 * @property date $date
 * @property string $place
 * @property string $amount
 *
 */
class PremiumRegionData extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_region_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'campaign_id', 'date', 'place', 'amount'
            ], 'required'],
            [[
                'campaign_id', 'amount'
            ], 'integer'],
            [['place'], 'string'],
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
            'place' => 'Lugar',
            'amount' => 'Cantidad'
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
            ->andWhere(['place' => $this->place])
            ->one();
    }

    public function findByDates($campaignId, $startDate, $endDate)
    {
        return Yii::$app->db->createCommand('
                SELECT
                    place,
                    SUM(amount) AS amount
                FROM premium_region_data
                WHERE date BETWEEN :startDate AND :endDate
                    AND campaign_id = :campaignId
                GROUP BY place
                ORDER BY amount DESC
                LIMIT 5', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'campaignId' => $campaignId
        ])->queryAll();
    }
}