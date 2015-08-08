<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\Author;
use common\models\Article;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ExpertController extends Controller
{

    public function actionView($slug)
    {   
        $item = Author::find()->where(['slug' => $slug])->one();
        
        $q = [];
        $q['author'] = $slug;
        $query = Article::getListQuery($q);
        $dataProvider = new ActiveDataProvider(['query' => $query]);

        return $this->render('view', [
                'item' => $item,
                'articles' => $dataProvider->getModels(),
                'pagination' => $dataProvider->pagination,

            ]);
    }

    
    


    

}
