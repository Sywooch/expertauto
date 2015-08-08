<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

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


    public function actionIndex()
    {  
        $query = Article::getListQuery(Yii::$app->request->get())
            ->andWhere(['article.state' => 1]);
        $dataProvider = new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);

        return $this->render('index', [
                'items' => $dataProvider->getModels(),
                'pagination' => $dataProvider->pagination,
            ]);

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


}
