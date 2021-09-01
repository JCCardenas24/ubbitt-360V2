<?php

namespace app\models\forms;

use yii\base\Model;

/**
 * Used to request searches by start and end dates. It also supports pagination.
 *
 * @property string $startDate
 * @property string $endDate
 * @property integer $page
 *
 */
class SearchByDateForm extends Model
{
    public $startDate;
    public $endDate;
    public $page;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['startDate', 'endDate'], 'required'],
            [['startDate', 'endDate'], 'date'],
            [['page'], 'integer'],
        ];
    }
}