<?php

namespace backend\controllers;

use Yii;
use common\models\Author;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class AuthorController extends AdminController
{
    
    public function behaviors()
    {
        return [
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => ['delete' => ['post']],
            // ],
        ];
    }


    public function actionIndex()
    {
        \common\models\Utilities::setBackUrl(Yii::$app->request->url);

        $dataProvider = new ActiveDataProvider([
            'query' => Author::find(),
            'sort'=> ['defaultOrder' => 'lastname']
        ]);
        return $this->render('index', [
                            'items' => $dataProvider->getModels(),
                            'pagination'=> $dataProvider->pagination
                         ]);
    }

    
    public function actionUpdate($id = null)
    {
        $model =  $id ? $this->findModel($id) : new Author();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Сохранено');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }



    protected function findModel($id)
    {
        if (($model = Author::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
