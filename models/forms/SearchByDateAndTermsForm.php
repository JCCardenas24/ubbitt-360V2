<?php

namespace app\models\forms;

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
class SearchByDateAndTermsForm extends SearchByDateForm
{
    public $term;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['startDate', 'endDate'], 'required'],
            [['term'], 'string'],
            [['page'], 'integer'],
            [['startDate', 'endDate'], 'date'],
        ];
    }
}