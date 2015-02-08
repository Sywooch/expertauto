<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\ForumTopic;
use common\models\Utilities;
// use common\models\ForumPerson;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class TopicController extends Controller
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


    public function actionIndex($id = 0)
    {   
        $items = ForumTopic::listByParentId($id);
        $chainOfTopics = ForumTopic::getChainOfTopics($id);

        return $this->render('index',compact('items', 'chainOfTopics'));
    }

    
    public function actionCreate()
    {   
        $model = new ForumTopic();
        if( $model->load(Yii::$app->request->post())) {
            
            if($model->save()) {

                $message = ($model->is_category == 1) ? 'Раздел форумов создан' : 'Тема форума создана';
                Yii::$app->session->setFlash('success', $message);
            }
        }
        Utilities::retroGoBack();
        // return $this->render('index');
    }
       


    

}
