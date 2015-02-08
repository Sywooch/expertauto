<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\Article;
use common\models\Tagging;
use yii\filters\VerbFilter;


class ArticleController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'index' => ['get'],
                ],
            ],
        ];
    }


    public function actionIndex($category = null, $tag = null, $author = null, $search = null, $order_by = null)
    {  
        Article::$isActiveOnly = true;
        Article::setItemsPerPage(10);
        $items = Article::listByAny($category, $tag, $author, $search, $order_by);
        $pages = Article::$pages;
        
        return $this->render('index', compact('items', 'pages'));
    }


    public function actionView($slug)
    {   
        Article::$isActiveOnly = true;
        $article = Article::findBySlug($slug);
        $images  = Article::getImageArrayByArticleId($article['id']);
        $tags    = Tagging::listForArticle($article['id']);

        if ($article) {
            return $this->render('view', compact('article', 'images', 'tags'));
        } else {
             throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    // protected function findModel($id)
    // {
    //     if (($model = Article::findOne($id)) !== null) {
    //         return $model;
    //     } else {
    //         throw new NotFoundHttpException('The requested page does not exist.');
    //     }
    // }

}
