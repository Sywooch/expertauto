<?php
namespace frontend\models;

use common\models\Person;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;
 
class ConfirmEmailForm extends Model
{
    

    private $_user;
 
   
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException('Отсутствует код подтверждения.');
        }
        $this->_user = Person::findByEmailConfirmToken($token);
        if (!$this->_user) {
            throw new InvalidParamException('Неверный токен.');
        }
        parent::__construct($config);
    }
 
    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function confirmEmail()
    {
        $user = $this->_user;
        $user->status = Person::STATUS_ACTIVE;
        $user->removeEmailConfirmToken();
 
        return $user->save();
    }
}