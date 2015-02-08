<?php
namespace frontend\controllers;

use Yii;
use common\models\MainpageItem;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use yii\authclient\OAuth2;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use common\models\Auth;
use common\models\Person;


class SiteController extends Controller
{

    public function actions()
    {
        return [
           
            // 'error' => [
            //     'class' => 'yii\web\ErrorAction',
            // ],
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            'static' => [
                'class' => '\yii\web\ViewAction',
            ],
            
            // 'auth' => [
            //     'class' => 'yii\authclient\AuthAction',
            //     'successCallback' => [$this, 'onAuthSuccess'],
            // ],
            // 'auth' => [
            //     'class' => 'yii\authclient\AuthAction',
            //     'successCallback' => [$this, 'successCallback'],
            // ],
        ];
    }

    public function onAuthSuccess($client)
    {

       $attributes = $client->getUserAttributes();

        /** @var Auth $auth */
        $auth = Auth::find()->where([
            'source' => $client->getId(),
            'source_id' => $attributes['id'],
        ])->one();

        if (Yii::$app->user->isGuest) {
            if ($auth) { // login
                $user = $auth->user;
                Yii::$app->user->login($user);
            } else { // signup
                if (Person::find()->where(['email' => $attributes['email']])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new Person([
                        'username' => $attributes['login'],
                        'email' => $attributes['email'],
                        'password' => $password,
                    ]);
                    $user->generateAuthKey();
                    $user->generatePasswordResetToken();
                    $transaction = $user->getDb()->beginTransaction();
                    if ($user->save()) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);
                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                        } else {
                            print_r($auth->getErrors());
                        }
                    } else {
                        print_r($user->getErrors());
                    }
                }
            }
        } else { // user already logged in
            if (!$auth) { // add auth provider
                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $client->getId(),
                    'source_id' => $attributes['id'],
                ]);
                $auth->save();
            }
        }
    }

    // public function successCallback($client)
    // {
    //     $attributes = $client->getUserAttributes();
    //     // user login or signup comes here
    // }



    public function actionIndex()
    {   
        $items = MainpageItem::listToMainpage();
        return $this->render('index', ['items' => $items]);
    }


    public function actionError() 
    {   
        return $this->goHome();
    }    


}
