<?php

namespace backend\controllers;

use backend\controllers\AdminController;  
use Yii;
use common\models\Image;
use common\models\ImageArticle;
use common\models\Utilities;

use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


class ImageArticleController extends AdminController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['post'],
                    'delete' => ['get'],
                ],
            ],
        ];
    }


    public function actionCreate()
    {   
        $model = new ImageArticle;
        $model->load(Yii::$app->request->post()); 

        $model->file = UploadedFile::getInstance($model, 'file');

        // if(!is_null($model->file) && $model->validate()) {
        if(!is_null($model->file)) {

            $sourceFile = $model->file->tempName;
            $targetDir = Yii::getAlias('@img/article/');
            $model->src = Utilities::createRandomName() .'.' .$model->file->extension;

            if($model->save()) {
                Image::createImageByPattern($sourceFile, $targetDir, $model->src, ImageArticle::getStandardPattern());

                return $this->redirect(['article/media', 'id' => $model->article_id, '#'=> 'image-' .$model->id]);
            } 
        }
        return $this->redirect(['article/media', 'id' => $model->article_id]);
    }

    
    

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $article_id = $model->article_id;
        $pos = $model->pos;
        
        if($model->delete()) {
            Image::deleteByPattern($model->src, Yii::getAlias('@img/article/'), ImageArticle::getStandardPattern());
        }
        return $this->redirect(['article/media', 'id' => $article_id, '#'=>$pos]);
    }


    protected function findModel($id)
    {
        if (($model = ImageArticle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }




}
