<?php

namespace app\models;

use app\models\db\UserProfile;
use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $termsConditions;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            ['termsConditions', 'required', 'requiredValue' => 1, 'message' => 'Para ingresar primero debes aceptar los términos y condiciones.'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Usuario o contraseña incorrecto.');
            } else {
                Yii::$app->session->set("userIdentity", $this->_user);
                Yii::$app->session->set("userPermissions", $this->getPermissions());
            }
        }
    }

    private function getPermissions()
    {
        $userProfile = new UserProfile();
        $userProfile = $userProfile->findUserProfileByUserId($this->getUser()->getId());
        $permissions = $userProfile->findAllPermissions();
        return array_map(function ($permission) {
            return $permission->permission_code_name;
        }, $permissions);
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}