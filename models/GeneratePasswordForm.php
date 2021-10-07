<?php

namespace app\models;

use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class GeneratePasswordForm extends Model
{
    public $password;
    public $password_confirm;
    public $token;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password', 'password_confirm', 'token'], 'required'],
            [['password', 'password_confirm', 'token'], 'string'],
        ];
    }
}