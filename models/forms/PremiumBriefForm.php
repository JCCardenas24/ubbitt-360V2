<?php

namespace app\models\forms;

use yii\base\Model;

/**
 * Used to send Marketing brief data
 *
 * @property integer $campaignId
 * @property string $industryType
 * @property string $name
 * @property string $productDescription
 * @property string $productInsights
 * @property string $productAddedValue
 * @property string $productAveragePrice
 * @property string $productFirstPaymentAveragePrice
 * @property integer $paymentFrequencyYearly
 * @property integer $paymentFrequencyBiannual
 * @property integer $paymentFrequencyQuarterly
 * @property integer $paymentFrequencyMonthly
 * @property integer $paymentTypeCash
 * @property integer $paymentTypeCardMonthsWithoutInterest
 * @property integer $paymentTypeCardSinglePayment
 * @property integer $paymentMethodCard
 * @property integer $paymentMethodCashPickup
 * @property integer $paymentMethodWireTransfer
 * @property string $investment
 * @property string $startDate
 * @property string $endDate
 * @property string $expectedBiddingPerLead
 * @property string $expectedTotalSales
 *
 */
class PremiumBriefForm extends Model
{
    public $campaignId;
    public $industryType;
    public $name;
    public $productDescription;
    public $productInsights;
    public $productAddedValue;
    public $productAveragePrice;
    public $productFirstPaymentAveragePrice;
    public $paymentFrequencyYearly;
    public $paymentFrequencyBiannual;
    public $paymentFrequencyQuarterly;
    public $paymentFrequencyMonthly;
    public $paymentTypeCash;
    public $paymentTypeCardMonthsWithoutInterest;
    public $paymentTypeCardSinglePayment;
    public $paymentMethodCard;
    public $paymentMethodCashPickup;
    public $paymentMethodWireTransfer;
    public $investment;
    public $startDate;
    public $endDate;
    public $expectedBiddingPerLead;
    public $expectedTotalSales;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [[
                'campaignId', 'industryType', 'name', 'productDescription',
                'productInsights', 'productAddedValue', 'productAveragePrice',
                'productFirstPaymentAveragePrice', 'paymentFrequencyYearly',
                'paymentFrequencyBiannual',
                'paymentFrequencyQuarterly', 'paymentFrequencyMonthly',
                'paymentTypeCash', 'paymentTypeCardMonthsWithoutInterest',
                'paymentTypeCardSinglePayment', 'paymentMethodCard',
                'paymentMethodCashPickup', 'paymentMethodWireTransfer',
                'investment', 'startDate', 'endDate', 'expectedBiddingPerLead',
                'expectedTotalSales'
            ], 'required'],
            [[
                'campaignId', 'paymentFrequencyYearly', 'paymentFrequencyBiannual',
                'paymentFrequencyQuarterly', 'paymentFrequencyMonthly',
                'paymentTypeCash', 'paymentTypeCardMonthsWithoutInterest',
                'paymentTypeCardSinglePayment', 'paymentMethodCard',
                'paymentMethodCashPickup', 'paymentMethodWireTransfer',

            ], 'integer'],
            [[
                'industryType', 'name', 'productDescription', 'productInsights',
                'productAddedValue', 'productAveragePrice', 'productFirstPaymentAveragePrice',
                'investment', 'startDate', 'endDate', 'expectedBiddingPerLead',
                'expectedTotalSales'
            ], 'string'],
        ];
    }
}