<?php

namespace app\models\forms;

/**
 * Used to request searches by start and end dates. It also supports pagination.
 *
 * @property string $startDate
 * @property string $endDate
 * @property integer $page
 * @property string $type
 * @property string $campaignId
 *
 */
class SearchByDateCampaignForm extends SearchByDateForm
{
    public $campaignId;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['campaignId', 'startDate', 'endDate'], 'required'],
            [['campaignId'], 'integer'],
            [['startDate', 'endDate'], 'date'],
        ];
    }
}