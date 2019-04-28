<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * SignUpForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignUpForm extends Model
{
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $role;
    public $password;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            [['username', 'first_name', 'last_name', 'email', 'password'], 'safe'],
            [['email'], 'email'],
            [['username', 'first_name', 'last_name', 'email'], 'string', 'max' => 40],
            [['password'], 'string', 'max' => 100],
            [['phone', 'role'], 'string', 'max' => 20],
            [['username'], 'unique', 'targetClass' => User::className()],
            [['email'], 'unique', 'targetClass' => User::className()],
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
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
