<?php

namespace app\models\forms;

use yii\base\Model;

/**
 * Used to change password from the user profile
 *
 * @property string $currentPassword
 * @property string $newPassword
 *
 */
class ChangePassword extends Model
{
    public $currentPassword;
    public $newPassword;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['currentPassword', 'newPassword'], 'required'],
            [['currentPassword', 'newPassword'], 'string'],
        ];
    }
}