<?php
namespace frontend\models;

use common\models\Person;
use yii\base\Model;
use Yii;
use yii\helpers\Html;


class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $verifyCode;
 
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
            ['username', 'string', 'min' => 4],
            ['username', 'unique', 'targetClass' => Person::className(), 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
 
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => Person::className(), 'message' => 'This email address has already been taken.'],
 
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
 
            ['verifyCode', 'captcha', 'captchaAction' => '/person/captcha'],
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'verifyCode' => 'Проверочный код',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new Person();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->status = Person::STATUS_WAIT;
            $user->generateAuthKey();
            $user->generateEmailConfirmToken();
 
            if ($user->save()) {
                // Yii::$app->mailer->compose('confirmEmail', ['user' => $user])
                //     ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                //     ->setTo($this->email)
                //     ->setSubject('Подтвердите регистрацию на сайте ' . Yii::$app->name)
                //     ->send();

                $confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['person/confirm-email', 'token' => $user->email_confirm_token]);
                $mailBody = '
Здравствуйте, ' .Html::encode($user->username) .'!
 
Для подтверждения адреса пройдите по ссылке:
' .Html::a(Html::encode($confirmLink), $confirmLink) .'
 
Если Вы не регистрировались на нашем сайте, то просто удалите это письмо.
';

                return Yii::$app->mailer->compose()
                    ->setTo($this->email)
                    ->setFrom([$this->email => $this->username])
                    ->setSubject('Подтвердите регистрацию на сайте "АвтоЭкспертиза"')
                    ->setTextBody($mailBody)
                    ->send();
            }
 
            return $user;
        }
 
        return null;
    }
}