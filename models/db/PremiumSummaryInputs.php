<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_summary_inputs".
 *
 * @property integer $campaignId
 * @property date $date
 * @property double $spent_budget
 * @property integer $
 * @property integer $
 *
 */
class PremiumSummaryInputs extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_summary_inputs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'campaign_id', 'date', 'spent_budget', 'roi', 'roi_percentage', 'cpl', 'cpa', 'cpa_percentage', 'leads', 'calls_total', 'sales_total', 'conversion_percentage',
                'collected_total', 'collected_percentage', 'spent_investment', 'sales_total_amount', 'sales_percentage', 'collected_total_amount', 'collection_percentage', 'total_emitted_sales', 'total_paid_sales'
            ], 'required'],
            [['campaign_id', 'leads', 'calls_total', 'sales_total', 'collected_total'], 'integer'],
            [['spent_budget', 'roi', 'roi_percentage', 'cpl', 'cpa', 'cpa_percentage', 'conversion_percentage', 'collected_percentage', 'spent_investment', 'sales_total_amount', 'sales_percentage', 'collected_total_amount', 'collection_percentage', 'total_emitted_sales', 'total_paid_sales'], 'double'],
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
            'spent_budget' => 'Presupuesto gastado',
            'roi' => 'ROI',
            'roi_percentage  ' => 'ROI %',
            'cpl' => 'CPL',
            'cpa' => 'CPA',
            'cpa_percentage' => 'CPA %',
            'leads' => 'Leads',
            'calls_total' => 'Total de llamadas',
            'sales_total' => 'Total ventas',
            'conversion_percentage' => 'Conversión',
            'collected_total' => 'Total de cobros',
            'collected_percentage' => '% de Cobranza',
            'spent_investment' => 'Inversión gastada',
            'sales_total_amount' => 'Total de ventas',
            'sales_percentage' => 'Porcentaje de ventas',
            'collected_total_amount' => 'Total de cobros',
            'collection_percentage' => 'Porcentaje de cobros',
            'total_emitted_sales' => 'Venta emitida total',
            'total_paid_sales' => 'Venta pagada total',
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
                    COALESCE(SUM(spent_budget), 0) AS spent_budget,
                    COALESCE(SUM(roi), 0) AS roi,
                    COALESCE(CAST(AVG(roi_percentage) AS DECIMAL(5,2)), 0) AS roi_percentage,
                    COALESCE(SUM(cpl), 0) AS cpl,
                    COALESCE(SUM(cpa), 0) AS cpa,
                    COALESCE(CAST(AVG(cpa_percentage) AS DECIMAL(5,2)), 0) AS cpa_percentage,
                    COALESCE(SUM(leads), 0) AS leads,
                    COALESCE(SUM(calls_total), 0) AS calls_total,
                    COALESCE(SUM(sales_total), 0) AS sales_total,
                    COALESCE(CAST(AVG(conversion_percentage) AS DECIMAL(5,2)), 0) AS conversion_percentage,
                    COALESCE(SUM(collected_total), 0) AS collected_total,
                    COALESCE(CAST(AVG(collected_percentage) AS DECIMAL(5,2)), 0) AS collected_percentage,
                    COALESCE(SUM(spent_investment), 0) AS spent_investment,
                    COALESCE(SUM(sales_total_amount), 0) AS sales_total_amount,
                    COALESCE(CAST(AVG(sales_percentage) AS DECIMAL(5,2)), 0) AS sales_percentage,
                    COALESCE(SUM(collected_total_amount), 0) AS collected_total_amount,
                    COALESCE(CAST(AVG(collection_percentage) AS DECIMAL(5,2)), 0) AS collection_percentage,
                    COALESCE(SUM(total_emitted_sales), 0) AS total_emitted_sales,
                    COALESCE(SUM(total_paid_sales), 0) AS total_paid_sales
                FROM premium_summary_inputs
                WHERE date BETWEEN :startDate AND :endDate
                    AND campaign_id = :campaignId', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'campaignId' => $campaignId
        ])->queryOne();
    }
}