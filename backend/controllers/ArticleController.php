<?php

namespace backend\controllers;

use backend\controllers\AdminController;  
use Yii;
use yii\data\ActiveDataProvider;
use common\models\Article;
use common\models\Tag;
use common\models\Tagging;
use common\models\Image;
use common\models\ImageArticle;
use common\models\Utilities;

use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;


class ArticleController extends AdminController
{
    // public function behaviors()
    // {
    //     return [
    //         'verbs' => [
    //             'class' => VerbFilter::className(),
    //             'actions' => [
    //                 'update' => ['post'],
    //                 'delete' => ['post', 'get'],
    //             ],
    //         ],
    //     ];
    // }


    public function actionIndex()
    {
        $query = Article::getListQuery(Yii::$app->request->get());
        $dataProvider = new ActiveDataProvider(['query' => $query]);
        $items = $dataProvider->getModels();

        if(Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            return $items;
        }  else {
            \common\models\Utilities::setBackUrl(Yii::$app->request->url);
            $pagination = $dataProvider->pagination;
            return $this->render('index', compact('items', 'pagination'));
        }
    }


    public function actionMedia($id)
    {
        $article = $this->findModel($id);
        $images = Article::getImageArrayByArticleId($id);
        return $this->render('media', compact('article', 'images'));
    }


    public function actionUpdate($id = null)
    {
        if($id) {
            $model = $this->findModel($id);
            $taggings = Tagging::listForArticle($id);
        }   else  {
            $model = new Article();
            $taggings = [];
        }

        if ($model->load(Yii::$app->request->post())) {

            if($image_src = $this->createMainImage($model)) {
                $model->image_src = $image_src;
            }
            if($model->save()) {
                Tagging::addTagsForArticle($model->id);
                Yii::$app->session->setFlash('success', 'Статья сохранена');
                return $this->redirect(['update', 'id' => $model->id]);
                // return $this->refresh();
            }
        }

        $model->content = Article::contentPrepareToTextAreaFormat($model->content);
        $unusedTags = Tag::findUnusedTags($taggings);
        return $this->render('update', compact('model', 'taggings','unusedTags'));
    }


    private function createMainImage($model)
    { 
        $model->file = UploadedFile::getInstance($model, 'file');
        if(!is_null($model->file) && $model->validate()) {
            $sourceFile = $model->file->tempName;
            $targetDir = Yii::getAlias('@img/article/');
            $model->image_src = Utilities::createRandomName() .'.' .$model->file->extension;
            Image::createImageByPattern($sourceFile, $targetDir, $model->image_src, ImageArticle::getStandardPattern());
            return $model->image_src;
        }
        return null;
    }

    public function actionImageDelete($id)
    {   
        $model = $this->findModel($id);
        if(!empty($model->image_src)) {
            Image::deleteByPattern($model->image_src, Yii::getAlias('@img/article/'), ImageArticle::getStandardPattern());
            
            $command = \Yii::$app->db
                ->createCommand(
                    "UPDATE article SET image_src = NULL WHERE id = $id")
                ->execute();
        }
        return $this->redirect(['update', 'id' => $model->id]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
