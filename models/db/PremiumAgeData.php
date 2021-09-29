<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_age_data".
 *
 * @property integer $campaignId
 * @property date $date
 *
 */
class PremiumAgeData extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_age_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'campaign_id', 'date', 'men_segment_25_34', 'men_segment_35_44', 'men_segment_45_54', 'men_segment_55_64', 'men_segment_65_plus',
                'women_segment_25_34', 'women_segment_35_44', 'women_segment_45_54', 'women_segment_55_64', 'women_segment_65_plus'
            ], 'required'],
            [[
                'campaign_id', 'men_segment_25_34', 'men_segment_35_44', 'men_segment_45_54', 'men_segment_55_64', 'men_segment_65_plus',
                'women_segment_25_34', 'women_segment_35_44', 'women_segment_45_54', 'women_segment_55_64', 'women_segment_65_plus'
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
            'men_segment_25_34' => '25-34 Hombres',
            'men_segment_35_44' => '35-44 Hombres',
            'men_segment_45_54' => '45-54 Hombres',
            'men_segment_55_64' => '55-64 Hombres',
            'men_segment_65_plus' => '65+ Hombres',
            'women_segment_25_34' => '25-34 Mujeres',
            'women_segment_35_44' => '35-44 Mujeres',
            'women_segment_45_54' => '45-54 Mujeres',
            'women_segment_55_64' => '55-64 Mujeres',
            'women_segment_65_plus' => '65+ Mujeres'
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
        return Yii::$app->db->createCommand('
            SELECT
                COALESCE(SUM(men_segment_25_34), 0) AS men_segment_25_34,
                COALESCE(SUM(men_segment_35_44), 0) AS men_segment_35_44,
                COALESCE(SUM(men_segment_45_54), 0) AS men_segment_45_54,
                COALESCE(SUM(men_segment_55_64), 0) AS men_segment_55_64,
                COALESCE(SUM(men_segment_65_plus), 0) AS men_segment_65_plus,
                COALESCE(SUM(women_segment_25_34), 0) AS women_segment_25_34,
                COALESCE(SUM(women_segment_35_44), 0) AS women_segment_35_44,
                COALESCE(SUM(women_segment_45_54), 0) AS women_segment_45_54,
                COALESCE(SUM(women_segment_55_64), 0) AS women_segment_55_64,
                COALESCE(SUM(women_segment_65_plus), 0) AS women_segment_65_plus
            FROM premium_age_data
            WHERE date BETWEEN :startDate AND :endDate
                AND campaign_id = :campaignId', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'campaignId' => $campaignId
        ])->queryOne();
    }
}