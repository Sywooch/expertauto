<?php

namespace backend\controllers;

use backend\controllers\AdminController;  
use Yii;
// use yii\caching\FileCache;


class ConfigController extends AdminController
{


    public function actionClearCache()
    { 
        // Yii::$app->cache->flush();
        // yii\caching\Cache::flush();

        $cacheManager = new yii\caching\FileCache;
        $cacheManager->flush();

        
        $conn = \Yii::$app->db;
        $schema = $conn->getSchema();
        $schema->refresh();

        return $this->redirect(Yii::$app->request->referrer);
    }


  
}
