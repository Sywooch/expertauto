<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Opinion;
use common\models\Dealer;
use yii\filters\VerbFilter;


class OpinionController extends Controller
{
    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'delete' => ['post'],
    //             ],
    //         ],
    //     ];
    // }


    public function actionIndex()
    {   
        
        $model = new Opinion;
        $opinions = [];

        return $this->render('index', compact('opinions', 'model'));
    }


    public function actionView($id)
    {   
        $opinion  = Opinion::findOne((int)$id);

        return $this->render('view', compact('opinion'));
    }


    public function actionCreate()
    {   
        $model = new Opinion();
        if( $model->load(Yii::$app->request->post())) {
            
            if($model->save()) {
                $message = 'Отзыв создан';
                Yii::$app->session->setFlash('success', $message);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionDealerlist($id)
    {   
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            return Dealer::find()->where(['city_id' => $id])->asArray()->all();
        }
    }

    protected function findModel($id)
    {
        if (($model = Opinion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
