<?php
namespace backend\controllers;

use Yii;
use backend\controllers\AdminController;
use yii\data\ActiveDataProvider;  
use common\models\Tag;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


class TagController extends AdminController
{
    
    public function actionIndex()
    {   
        // \common\models\Utilities::setBackUrl(Yii::$app->request->url);
        $dataProvider = new ActiveDataProvider([
            'query' => Tag::find(),
            'sort'=> ['defaultOrder' => 'name'],
            'pagination' => ['pageSize' => 16],
        ]);
        return $this->render('index', [
                            'model' => new Tag(),
                            'items' => $dataProvider->getModels(),
                            'pagination'=> $dataProvider->pagination
                         ]);
    }


    public function actionCreate()
    {   
        $model = new Tag();
        if ($model->load(Yii::$app->request->post())) {

            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = 'json';
                return $model->save() ?  $model : [];
            
            } else {
                if($model->save()) {
                    // Yii::$app->session->setFlash('success', 'Сохранено');
                    return $this->redirect(['index']);
                }  
            }
        }
        // return $this->render('update', ['model' => $model]);
        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        $model =  $this->findModel($id);

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
        if (($model = Tag::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
