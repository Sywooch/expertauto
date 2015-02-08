<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\ForumPost;
use common\models\ForumTopic;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class PostController extends Controller
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


    public function actionIndex($id)
    {   
        $items = ForumPost::listByTopicId($id);
        $pages = ForumPost::$pages;
        $topic = ForumTopic::findOne($id);
        $chainOfTopics = ForumTopic::getChainOfTopics($topic['parent_id']);

        return $this->render('index', compact('items', 'pages', 'topic', 'chainOfTopics'));
    }

    
    public function actionCreate()
    {   
        $model = new ForumPost();
        if( $model->load(Yii::$app->request->post())) {
            
            if($model->save()) {
                $message = 'Сообщение создано';
                Yii::$app->session->setFlash('success', $message);
            }
        }
        // return $this->render('index');
        return $this->redirect(Yii::$app->request->referrer);
    }
       

    

}
