<?php

namespace app\models\forms;

use yii\base\Model;

/**
 * Used to request searches by start and end dates. It also supports pagination.
 *
 * @property string $startDate
 * @property string $endDate
 * @property integer $page
 * @property string $type
 * @property string $module_origin
 * @property string $submodule_origin
 *
 */
class SearchByDateForm extends Model
{
    public $startDate;
    public $endDate;
    public $page;
    public $module_origin;
    public $submodule_origin;
    public $type;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['startDate', 'endDate'], 'required'],
            [['startDate', 'endDate'], 'date'],
            [['page'], 'integer'],
            [['module_origin'], 'default', 'value' => null],
            [['submodule_origin'], 'default', 'value' => null],
            [['type'], 'default', 'value' => null]
        ];
    }
}