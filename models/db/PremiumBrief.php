<?php

namespace app\models\db;

use yii\db\ActiveRecord;

/**
 * This is the  class for table "premium_campaign_brief".
 *
 * @property integer $campaignId
 *
 */
class PremiumBrief extends ActiveRecord
{

    public $name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'premium_campaign_brief';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'campaign_id', 'industry_type', 'product_description', 'product_insights',
                'product_added_value', 'product_average_price', 'product_first_payment_average_price',
                'payment_frequency_yearly', 'payment_frequency_biannual', 'payment_frequency_quarterly',
                'payment_frequency_monthly', 'payment_type_cash',
                'payment_type_card_months_without_interest', 'payment_type_card_single_payment',
                'payment_method_card', 'payment_method_cash_pickup', 'payment_method_wire_transfer',
                'investment', 'start_date', 'end_date', 'expected_bidding_per_lead', 'expected_total_sales'
            ], 'required'],
            [[
                'industry_type', 'product_description', 'product_insights',
                'product_added_value', 'product_average_price', 'investment',
                'expected_bidding_per_lead', 'expected_total_sales', 'start_date', 'end_date',
            ], 'string'],
            [[
                'campaign_id', 'payment_frequency_yearly', 'payment_frequency_biannual', 'payment_frequency_quarterly', 'payment_frequency_monthly', 'payment_type_cash',
                'payment_type_card_months_without_interest', 'payment_type_card_single_payment', 'payment_method_card', 'payment_method_cash_pickup', 'payment_method_wire_transfer',
            ], 'integer'],
            // [['start_date', 'end_date',], 'date', 'format' => 'php:Y-m-d'],
            // [['name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'campaign_id' => 'Id Campaña',
            'industry_type' => 'Tipo de Industria',
            'product_description' => 'Descripción del producto',
            'product_insights' => 'Insights del producto',
            'product_added_value' => '¿Cuál es el valor agregado del producto?',
            'product_average_price' => 'Precio promedio del producto/servicio',
            'product_first_payment_average_price' => 'Precio promedio del primer pago del producto/ servicio',
            'investment' => 'Inversión',
            'start_date' => 'Fecha de inicio',
            'end_date' => 'Finalización',
            'expected_bidding_per_lead' => 'Bidding por lead esperado',
            'expected_total_sales' => 'Ventas totales esperadas',
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

    public function getIndustryType()
    {
        return $this->industry_type;
    }

    public function setIndustryType($industryType)
    {
        $this->industry_type = $industryType;
    }

    public function getProductDescription()
    {
        return $this->product_description;
    }

    public function setProductDescription($productDescription)
    {
        $this->product_description = $productDescription;
    }

    public function getProductInsights()
    {
        return $this->product_insights;
    }

    public function setProductInsights($productInsights)
    {
        $this->product_insights = $productInsights;
    }

    public function getProductAddedValue()
    {
        return $this->product_added_value;
    }

    public function setProductAddedValue($productAddedValue)
    {
        $this->product_added_value = $productAddedValue;
    }

    public function getProductAveragePrice()
    {
        return $this->product_average_price;
    }

    public function setProductAveragePrice($productAveragePrice)
    {
        $this->product_average_price = $productAveragePrice;
    }

    public function findByCampaignId($campaignId)
    {
        return self::find()
            ->where(['campaign_id' => $campaignId])
            ->one();
    }
}