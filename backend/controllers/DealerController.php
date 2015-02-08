<?php

namespace backend\controllers;

use Yii;
use common\models\Dealer;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class DealerController extends AdminController
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
            'query' => Dealer::find()
                ->select('dealer.*, city.name as city_name')
                ->leftJoin('city', 'city.id = dealer.city_id'),
            'sort'=> ['defaultOrder' => 'name']
        ]);
        return $this->render('index', [
                            'items' => $dataProvider->getModels(),
                            'pagination'=> $dataProvider->pagination
                         ]);
    }

    
    public function actionUpdate($id = null)
    {
        $model =  $id ? $this->findModel($id) : new Dealer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Сохранено');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', ['model' => $model]);
        }
    }


    // dealer/fromarray?city_id=59
    public function actionFromarray()
    {   
        $city_id = $_GET['city_id'];
        $sourceFile = Yii::getAlias('@public/dealers/') ."city_" .$city_id .".php";
        require($sourceFile);
        foreach($dealers as $name) {
            $dealer = new Dealer;
            $dealer->name = $name;
            $dealer->city_id = $city_id;
            $dealer->save();
            echo "create dealer " .$dealer->name . '<br>';
        }
        echo 'READY';
        exit;
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }



    protected function findModel($id)
    {
        if (($model = Dealer::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
