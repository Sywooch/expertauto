<?php

namespace backend\controllers;


class AdminController extends \yii\web\Controller
{   

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => \yii\filters\AccessControl::className(),
            'denyCallback' => function ($rule, $action) {
               return $this->redirect(['site/login']); },
            'rules' => [
                [   
                    'allow' => true, 
                    'roles' => ['@']
                ],
            ],
        ];
        return $behaviors;
    }
    


}
