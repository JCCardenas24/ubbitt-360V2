<?php

namespace app\models\forms;

use yii\base\Model;

/**
 * Used to change email from the user profile
 *
 * @property string $newEmail
 *
 */
class ChangeEmail extends Model
{
    public $newEmail;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['newEmail'], 'required'],
            [['newEmail'], 'string'],
        ];
    }
}