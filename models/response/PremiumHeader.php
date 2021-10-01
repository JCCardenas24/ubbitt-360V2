<?php

namespace app\models\response;

use yii\base\Model;

/**
 * Used to return the header of the Premium plan
 *
 * @property integer $campaignId
 * @property integer $spentBudget
 * @property integer $sales
 *
 */
class PremiumHeader extends Model
{
    public $investment;
    public $spentBudget;
    public $sales;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['investment', 'spentBudget', 'sales'], 'required'],
            [['investment', 'spentBudget', 'sales'], 'double'],
        ];
    }
}