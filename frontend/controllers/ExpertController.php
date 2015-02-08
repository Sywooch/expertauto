<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Author;
use common\models\Meta;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ExpertController extends Controller
{

    public function actionView($slug)
    {   
        $item = Author::find()->where(['slug' => $slug])->one();
        return $this->render('view', compact('item'));
    }

    
    


    

}
