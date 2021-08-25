<?php

namespace app\models;

use app\models\db\UserProfile;
use app\models\db\Permission;
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

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
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
        $profilePermissions = $userProfile->getProfilePermissions()->one();
        $permissions = $profilePermissions->getPermissions()->all();
        return array_map(function ($permission) {
            return $permission->codeName;
        }, $permissions);
    }

    private function getMenu()
    {
        $permissionModel = new Permission();
        $permissions = $permissionModel->findPermissionsByUserId($this->getUser()->getId());

        // Extracts the important info only
        $menus = [];
        /* @var $parentPermission Menu */
        foreach ($permissions as $parentPermission) {
            $menu = [];
            $menu['permissionId'] = $parentPermission->permissionId;
            $menu['name'] = $parentPermission->name;
            $menu['codeName'] = $parentPermission->codeName;
            $menu['type'] = $parentPermission->type;
            $menus[] = $menu;
        }

        /* @var $parentPermission Menu */
        $parentPermission['submenus'] = [];
        foreach ($menus as &$parentPermission) {
            $subpermissions = $permissionModel->findSubpermissionsByPermissionIdAndUsername($parentPermission['menuId'], $this->getUser()->getId());
            // Extracts the important info only
            /* @var $parentPermission Menu */
            foreach ($subpermissions as $subpermissionModel) {
                $subpermission = [];
                $subpermission['permissionId'] = $subpermissionModel->permissionId;
                $subpermission['name'] = $subpermissionModel->name;
                $subpermission['codeName'] = $subpermissionModel->codeName;
                $subpermission['type'] = $subpermissionModel->type;
                $parentPermission['submenus'][] = $subpermission;
            }
        }

        return $menus;
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