<?php
 
namespace frontend\models;
 
use common\models\Person;
use Yii;
use yii\base\Model;
 

class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
 
    private $_user = false;
 
   
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить',
        ];
    }
   
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
 
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Неверное имя пользователя или пароль.');
            } elseif ($user && $user->status == Person::STATUS_BLOCKED) {
                $this->addError('username', 'Ваш аккаунт заблокирован.');
            } elseif ($user && $user->status == Person::STATUS_WAIT) {
                $this->addError('username', 'Ваш аккаунт не подтвежден.');
            }
        }
    }
 
    
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        } else {
            return false;
        }
    }
 
    
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Person::findByUsername($this->username);
        }
 
        return $this->_user;
    }
}