<?php

namespace backend\controllers;

use backend\controllers\AdminController;  
use Yii;
use common\models\Tagging;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;


class TaggingController extends AdminController
{   

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionCreate()
    {   
        $model = new Tagging();
         
        if ($model->load(Yii::$app->request->post())) {

            if (Yii::$app->request->isAjax) {
                 Yii::$app->response->format = 'json';
                return $model->save() ?  $model : [];
                
            } else {
                // ....
            }
        }    
    }

    public function actionDelete()
    {   
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            
            $id = Yii::$app->request->post('id');
            $tagging = Tagging::findOne($id);
            if($tagging && $tagging->delete()) {
                return $tagging;
            }  else {
                return [];
            }
        }
    }


  
}
