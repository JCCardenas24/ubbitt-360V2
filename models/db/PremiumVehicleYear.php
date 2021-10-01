<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_vehicle_year".
 *
 * @property integer $campaignId
 * @property date $date
 * @property string $year
 * @property integer $amount
 *
 */
class PremiumVehicleYear extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_vehicle_year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'campaign_id', 'date', 'year', 'amount'
            ], 'required'],
            [['campaign_id', 'amount',], 'integer'],
            [['year'], 'string'],
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
            'year' => 'Año',
            'amount' => 'Cantidad',
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
            ->andWhere(['year' => $this->year])
            ->one();
    }

    public function findByDates($campaignId, $startDate, $endDate)
    {
        return Yii::$app->db->createCommand('
                SELECT
                    year,
                    SUM(amount) AS amount
                FROM premium_vehicle_year
                WHERE date BETWEEN :startDate AND :endDate
                    AND campaign_id = :campaignId
                GROUP BY year
                ORDER BY amount DESC
                LIMIT 5', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'campaignId' => $campaignId
        ])->queryAll();
    }
}