<?php

namespace app\models\forms;

use yii\base\Model;

/**
 * Used to send the campaign id in any form
 *
 * @property integer $campaignId
 *
 */
class CampaignForm extends Model
{
    public $campaignId;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['campaignId',], 'required'],
            [['campaignId',], 'integer'],
        ];
    }
}