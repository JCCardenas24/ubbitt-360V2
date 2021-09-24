<?php

namespace app\models\db;

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
        return self::find()
            ->where(['between', 'date', $startDate, $endDate])
            ->andWhere(['campaign_id' => $campaignId])
            ->all();
    }
}