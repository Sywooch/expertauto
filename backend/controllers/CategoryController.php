<?php

namespace backend\controllers;

use backend\controllers\AdminController;  
use Yii;
use common\models\Category;
use common\models\Utilities;


class CategoryController extends AdminController
{

    public function actionMainlist($id)
    {   
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            return Category::find()->where(['parent_id' => $id])->asArray()->all();
        }
    }


    public function actionIndex()
    {   
        $model = new Category;
        $items = Category::listWithParents();
        return $this->render('index', compact('model', 'items'));
    }


    public function actionCreate()
    {   
        $model = new Category;
        if($model->load(Yii::$app->request->post())) {
            $model->save();
        }
        return $this->redirect(['index']); 
    }


    public function actionShift($id, $direction, $parent_id)
    {
        $params = [
                     'where' => ['parent_id' => $parent_id], 
                     'beforeNormalize' => true
                  ];
        Utilities::shiftItem(new Category, $id, $direction, $params);
        Utilities::retroGoBack();
    }


    public function actionDelete($id)
    {
        $category = Category::findOne($id);

        if($category->parent_id == 0) {
            Category::deleteAll(['parent_id' => $category->id]);
        }

        $category->delete();
        Utilities::retroGoBack();
    }

  
}
