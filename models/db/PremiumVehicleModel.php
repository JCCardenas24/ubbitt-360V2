<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_vehicle_model".
 *
 * @property integer $campaignId
 * @property date $date
 * @property string $model
 * @property integer $amount
 *
 */
class PremiumVehicleModel extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_vehicle_model';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'campaign_id', 'date', 'model', 'amount'
            ], 'required'],
            [['campaign_id', 'amount'], 'integer'],
            [['model'], 'string'],
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
            'model' => 'Modelo',
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
            ->andWhere(['model' => $this->model])
            ->one();
    }

    public function findByDates($campaignId, $startDate, $endDate)
    {
        return Yii::$app->db->createCommand('
                SELECT
                    model,
                    SUM(amount) AS amount
                FROM premium_vehicle_model
                WHERE date BETWEEN :startDate AND :endDate
                    AND campaign_id = :campaignId
                GROUP BY model
                ORDER BY amount DESC
                LIMIT 7', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'campaignId' => $campaignId
        ])->queryAll();
    }
}