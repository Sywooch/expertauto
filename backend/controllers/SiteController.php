<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use backend\controllers\AdminController;
use common\models\AdminLoginForm;
use yii\filters\VerbFilter;



class SiteController extends AdminController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['login', 'error'],
            'roles' => ['?'],
        ];
        return $behaviors;
    }


    public function actions()
    {
        return [
            // 'error' => ['class' => 'yii\web\ErrorAction'],
        ];
    }



    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();

        } else {
            // $this->layout = false;
            $this->layout = 'login'; 
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['site/login']);
    }

    public function actionError()
    {
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            // return $this->render('error', ['exception' => $exception]);
            return $this->redirect(['site/login']);
        }
    }


}
