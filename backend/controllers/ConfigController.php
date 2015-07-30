<?php

namespace backend\controllers;

use backend\controllers\AdminController;  
use Yii;


class ConfigController extends AdminController
{


    private function deleteFiles($target, $removeDir = true) 
    {
        if(is_dir($target)) {
            // $files = glob( $target . '*', GLOB_MARK ); 
            $files = glob($target . '*'); 
            foreach($files as $file) {
                $this->deleteFiles($file);      
            }

            if ($removeDir) {
               rmdir($target);
            }

        } elseif (is_file($target)) {
            @unlink($target);  
        }
    }

    public function actionClearCache()
    { 

        $cache = new yii\caching\FileCache();
        $cache->flush();

         // $files = glob(Yii::getAlias('@frontend/runtime/cache/*')); 
        // foreach($files as $file) {
        //     // if(is_file($file))
        //     @unlink($file); 
        // }

        $target = Yii::getAlias('@backend/runtime/cache/96/');
        $this->deleteFiles($target, false);


        // $conn = \Yii::$app->db;
        // $schema = $conn->getSchema();
        // $schema->refresh();

        return $this->redirect(Yii::$app->request->referrer);
    }


  
}
