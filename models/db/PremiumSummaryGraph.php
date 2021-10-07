<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_summary_graph".
 *
 * @property integer $campaignId
 * @property date $uploadDate
 * @property date $date
 * @property double $investment
 * @property double $sales
 * @property double $collected
 * @property string $type
 *
 */
class PremiumSummaryGraph extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_summary_graph';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campaign_id', 'upload_date', 'date', 'investment', 'sales', 'collected', 'type'], 'required'],
            [['campaign_id',], 'integer'],
            [['investment', 'sales', 'collected'], 'double'],
            [['upload_date', 'date'], 'date', 'format' => 'php:Y-m-d'],
            [['type',], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'upload_date' => 'Fecha de carga',
            'date' => 'Fecha',
            'investment' => 'Inversión',
            'sales' => 'Ventas',
            'collected' => 'Cobrado',
            'type' => 'Tipo',
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
            ->andWhere(['type' => $this->type])
            ->one();
    }

    public function findByDates($campaignId, $startDate, $endDate)
    {
        $date = new \yii\db\Expression("DATE_FORMAT(upload_date, '%d/%m/%Y') as upload_date, DATE_FORMAT(`date`, '%d/%m/%Y') as `date`, investment, sales, collected, type");
        return self::find()
            ->select($date)
            ->where(['between', 'date', $startDate, $endDate])
            ->andWhere(['campaign_id' => $campaignId])
            ->all();
    }
}