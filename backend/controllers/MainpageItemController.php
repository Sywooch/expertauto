<?php
namespace backend\controllers;

use Yii;
use backend\controllers\AdminController;
use common\models\Mainpage;
use common\models\MainpageItem;
use common\models\Utilities;

use yii\web\NotFoundHttpException;


class MainpageItemController extends AdminController
{
    
    public function actionIndex($slug)
    {   
        $mainpage = Mainpage::findOne(['slug' => $slug]);
        $items = MainpageItem::listBySlug($slug);
        return $this->render('index', compact('mainpage', 'items'));
    }


    public function actionCreate()
    {   
        $model = new MainpageItem();

        $model->mainpage_id = $_POST['mainpage_id'];
        $model->article_id  = $_POST['article_id'];
        $model->pos         = $_POST['pos'];

        $conditionPos = $model->pos - 1;
        MainpageItem::updateAllCounters(['pos' => 1], "mainpage_id = $model->mainpage_id AND pos > $conditionPos");

        $model->save();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = 'json';
            return [];
        } else {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->redirect(Yii::$app->request->referrer);
    }



    // ready
    public function actionShift($id, $direction, $mainpage_id)
    {
        $params = [
                     'where' => ['mainpage_id' => $mainpage_id], 
                     'beforeNormalize' => true
                  ];
        Utilities::shiftItem(new MainpageItem, $id, $direction, $params);
        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }



    protected function findModel($id)
    {
        if (($model = MainpageItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
