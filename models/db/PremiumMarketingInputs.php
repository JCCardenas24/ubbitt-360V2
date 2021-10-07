<?php

namespace app\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_marketing_inputs".
 *
 * @property integer $campaignId
 * @property date $date
 *
 */
class PremiumMarketingInputs extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_marketing_inputs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'campaign_id', 'date', 'budget', 'spent_budget', 'spent_budget_percentage', 'available_budget', 'available_budget_percentage', 'impressions', 'ctr', 'clicks', 'rebound',
                'visits', 'visits_conversion', 'leads', 'leads_conversion', 'contacting', 'contacting_conversion',
                'sales', 'cpm', 'cpc', 'cp_visit', 'cpl', 'cpl_contacted', 'sale_cost', 'roa', 'sales_amount', 'expenses', 'investment'
            ], 'required'],
            [['campaign_id', 'impressions', 'clicks', 'visits', 'leads', 'contacting', 'sales'], 'integer'],
            [[
                'budget', 'spent_budget', 'spent_budget_percentage', 'available_budget', 'available_budget_percentage', 'ctr', 'rebound', 'visits_conversion', 'leads_conversion', 'contacting_conversion',
                'cpm', 'cpc', 'cp_visit', 'cpl', 'cpl_contacted', 'sale_cost', 'roa', 'sales_amount',
                'expenses', 'investment'
            ], 'double'],
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
            'budget' => 'Presupuesto Ubbitt',
            'spent_budget' => 'Presupuesto gastado',
            'spent_budget_percentage' => '% presupuesto gastado',
            'available_budget' => 'Presupuesto disponible',
            'available_budget_percentage' => '% presupuesto disponible',
            'impressions' => 'Impresiones',
            'ctr' => 'CTR',
            'clicks' => 'Clicks',
            'rebound' => 'Rebote',
            'visits' => 'Visitas',
            'visits_conversion' => 'Visitas Conversión',
            'leads' => 'Leads',
            'leads_conversion' => 'Leads Conversión',
            'contacting' => 'Contactación',
            'contacting_conversion' => 'Contactación Conversión',
            'sales' => 'Ventas',
            'cpm' => 'CPM',
            'cpc' => 'CPC',
            'cp_visit' => 'CP Visita',
            'cpl' => 'CPL',
            'cpl_contacted' => 'CPL contactados',
            'sale_cost' => 'Costo por venta',
            'roa' => 'ROA',
            'sales_amount' => 'Ventas',
            'expenses' => 'Gasto',
            'investment' => 'Inversión'
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
                COALESCE(SUM(budget), 0) AS budget,
                COALESCE(SUM(spent_budget), 0) AS spent_budget,
                COALESCE(CAST(AVG(spent_budget_percentage) AS DECIMAL(5,2)), 0) AS spent_budget_percentage,
                COALESCE(SUM(available_budget), 0) AS available_budget,
                COALESCE(CAST(AVG(available_budget_percentage) AS DECIMAL(5,2)), 0) AS available_budget_percentage,
                COALESCE(SUM(impressions), 0) AS impressions,
                COALESCE(CAST(AVG(ctr) AS DECIMAL(5,2)), 0) AS ctr,
                COALESCE(SUM(clicks), 0) AS clicks,
                COALESCE(CAST(AVG(rebound) AS DECIMAL(5,2)), 0) AS rebound,
                COALESCE(SUM(visits), 0) AS visits,
                COALESCE(CAST(AVG(visits_conversion) AS DECIMAL(5,2)), 0) AS visits_conversion,
                COALESCE(SUM(leads), 0) AS leads,
                COALESCE(CAST(AVG(leads_conversion) AS DECIMAL(5,2)), 0) AS leads_conversion,
                COALESCE(SUM(contacting), 0) AS contacting,
                COALESCE(CAST(AVG(contacting_conversion) AS DECIMAL(5,2)), 0) AS contacting_conversion,
                COALESCE(SUM(sales), 0) AS sales,
                COALESCE(CAST(AVG(cpm) AS DECIMAL(5,2)), 0) AS cpm,
                COALESCE(CAST(AVG(cpc) AS DECIMAL(5,2)), 0) AS cpc,
                COALESCE(CAST(AVG(cp_visit) AS DECIMAL(5,2)), 0) AS cp_visit,
                COALESCE(CAST(AVG(cpl) AS DECIMAL(5,2)), 0) AS cpl,
                COALESCE(CAST(AVG(cpl_contacted) AS DECIMAL(5,2)), 0) AS cpl_contacted,
                COALESCE(CAST(AVG(sale_cost) AS DECIMAL(5,2)), 0) AS sale_cost,
                COALESCE(CAST(AVG(roa) AS DECIMAL(5,2)), 0) AS roa,
                COALESCE(SUM(sales_amount), 0) AS sales_amount,
                COALESCE(SUM(expenses), 0) AS expenses,
                COALESCE(SUM(investment), 0) AS investment
            FROM premium_marketing_inputs
            WHERE date BETWEEN :startDate AND :endDate
        AND campaign_id = :campaignId', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'campaignId' => $campaignId
        ])->queryOne();
    }
}