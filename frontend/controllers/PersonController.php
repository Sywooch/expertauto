<?php
namespace frontend\controllers;

use Yii;
use common\models\Person;
use common\models\DummyPerson;
use common\models\Image;
use common\models\Utilities;

use frontend\models\ConfirmEmailForm;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\base\InvalidParamException;

use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\UploadedFile;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;


class PersonController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'signup' => ['post'],
                ],
            ],
        ];
    }
 
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                // 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    
    public function actionUpdate($id)
    {
        $model =  $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if($avatar_src = $this->createAvatar($model)) {
                $model->avatar_src = $avatar_src;
            }
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Сохранено');
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }
    
    // ...............................
    public function actionDummy()
    {   
        $dummy = new DummyPerson;
        $dummy->createManyPersons();
        
    }
    // ...............................

    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function createAvatar($model)
    {
        $avatarPattern = ['crop' => true, 'width' => 100, 'height' => 100, 'sharpen'   => 4];

        $model->file = UploadedFile::getInstance($model, 'file');
        if(!is_null($model->file) && $model->validate()) {

            $sourceFile = $model->file->tempName;
            $targetDir = Yii::getAlias('@img/avatar/');
            $model->avatar_src = Utilities::createRandomName() .'.' .$model->file->extension;

            Image::createImageByPattern($sourceFile, $targetDir, $model->avatar_src, $avatarPattern);
            return $model->avatar_src;
        }
        return null;
    }

    public function actionImageDelete($id)
    {   
        $model = $this->findModel($id);
        if(!empty($model->avatar_src)) {
            Image::deleteInDirs($model->avatar_src, Yii::getAlias('@img/avatar/'));
            $model->avatar_src = null;
            $model->save();
        }
        return $this->redirect(['update', 'id' => $model->id]);
    }

    //........................................................
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
 
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // return $this->goBack();
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
 
    public function actionLogout()
    {
        Yii::$app->user->logout();
 
        // return $this->goHome();
        return $this->redirect(Yii::$app->request->referrer);
    }
 
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {

            if ($user = $model->signup()) {
                Yii::$app->getSession()->setFlash('success', 'Подтвердите ваш электронный адрес.');
                return $this->goHome();
            }
        }
 
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
 
    public function actionConfirmEmail($token)
    {
        try {
            $model = new ConfirmEmailForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->confirmEmail()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Ошибка подтверждения Email.');
        }
 
        return $this->goHome();
    }
 
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Спасибо! На ваш Email было отправлено письмо со ссылкой на восстановление пароля.');
 
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Извините. У нас возникли проблемы с отправкой.');
            }
        }
 
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
 
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Пароль успешно изменён.');
 
            return $this->goHome();
        }
 
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    //.........................................

    public function actionSendTestEmail()
    {
        $mail_body = "Добрый день\n
            Вы получили тестовое письмо.";

        $email = 'ol3012@yandex.ru';

        $this->send_mime_mail(
        'Сервер DigitalOcean"', // имя отправителя
        'test@crocusbit.ru',    // email отправителя
        'Покупателю товара',    // имя получателя
        $email,                 // email получателя
        'UTF-8',                // исходная кодировка
        // 'KOI8-R',            // кодировка отправки письма
        'UTF-8',                // кодировка отправки письма
        'Пробное письмо', //тема письма
        $mail_body);

        echo 'Letter sent'; exit;

    }


    private function send_mime_mail(
                $name_from,                // имя отправителя
                $email_from,               // email отправителя
                $name_to,                  // имя получателя
                $email_to,                 // email получателя
                $data_charset,             // кодировка переданных данных
                $send_charset,             // кодировка письма
                $subject,                  // тема письма
                $body                      // текст письма
                ) 
    {
        $to = $this->mime_header_encode($name_to, $data_charset, $send_charset)
                     . '<' . $email_to . '>';
        $subject = $this->mime_header_encode($subject, $data_charset, $send_charset);
        $from =  $this->mime_header_encode($name_from, $data_charset, $send_charset)
                         .'<' . $email_from . '>';
        if($data_charset != $send_charset) {
        $body = iconv($data_charset, $send_charset, $body);
        }
        $headers = "From: $from\r\n";
        $headers .= "Content-type: text/plain; charset=$send_charset\r\n";
        $headers .= "Mime-Version: 1.0\r\n";

        return mail($to, $subject, $body, $headers);
    }


    private function mime_header_encode($str, $data_charset, $send_charset) {
        if($data_charset != $send_charset) {
            $str = iconv($data_charset, $send_charset, $str);
        }
        return '=?' . $send_charset . '?B?' . base64_encode($str) . '?=';
    }


}
