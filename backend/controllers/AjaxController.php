<?php

namespace backend\controllers;

use Yii;
use yii\db\Query;
use backend\controllers\AdminController;    


class AjaxController extends AdminController
{

    public $enableCsrfValidation = false;
    
    
    public function actionUniversal()
    { 
        if (Yii::$app->request->isAjax) {

            $arguments = ['model', 'id', 'field', 'newvalue'];
            foreach($arguments as $arg) {
                ${$arg} = Yii::$app->request->post($arg);
            }
            $connection = \Yii::$app->db;
            $command = $connection->createCommand()->update($model, [$field => $newvalue], 'id = :id');
            $command->bindValue(':id', $id)->execute();

            $response = [];
            $response['state'] = ($command) ? 'success' : 'fail';
            $response['newvalue'] = $newvalue;

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $response;
        }   
    }


    public function actionUniversalObjectVariant()
    { 
        if (Yii::$app->request->isAjax) {

            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

            $model      = Yii::$app->request->post('model');
            $id         = Yii::$app->request->post('id');
            $field      = Yii::$app->request->post('field');
            $newValue   = Yii::$app->request->post('newValue');

            $class      = '\\common\\models\\' . ucfirst($model);
            $instance   = new $class();
            $element    = $instance->findOne($id);

            $element->{$field} = $newValue;    
            if($element->save())    { 
                return ['state' => 'success'];
            }  else {
                return ['state' => 'fail'];
            }
        }   
    }


}
