<?php
namespace common\models;
use Yii;
use yii\db\Query;


class Utilities extends \yii\db\ActiveRecord
{
    public static function backUrl()
    {
        if(empty(Yii::$app->session['back_url'])) {
            Yii::$app->session['back_url'] = \Yii::$app->urlManager->createUrl(['product/index']);
        }
        return Yii::$app->session['back_url'];
    }


    public static function setBackUrl($url)
    {
        Yii::$app->session['back_url'] = $url;
    }


    public static function retroGoBack()
    {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }

    public static function linkBack()
    {
        return $_SERVER['HTTP_REFERER'];
    }



    public static function findMaxFrom($table, $params = [])
    {
        $where  = (isset($params['where'])) ? $params['where'] : [];
        $field      = (isset($params['field'])) ? $params['field'] : 'pos';

        $q = new \yii\db\Query();
        if(!$field) { $field = 'pos'; }
        return $q->from($table)->where($where)->max($field);
    }    


    public static function createRandomName($length = 12) 
    {
        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $allchar = 'abcdefghijklmnopqrstuvwxyz123456789';
        mt_srand (( double) microtime() * 1000000 );        
        $str = substr( $letters, mt_rand (0,26), 1);
        
        for ($i = 0; $i<$length-1 ; $i++) {    
            $str .= substr( $allchar, mt_rand (0,34), 1);
        }
        return $str;
    }



    public static function shiftItem($modelObject, $id, $direction, $params = null)   
    {
        // \yii\helpers\VarDumper::dump($params); exit;

        if(!in_array($direction, array('up', 'down')))  return false; 
        $fieldPosition = (isset($params['fieldPosition'])) ? $params['fieldPosition'] : 'pos';
       
        if(isset($params['beforeNormalize']) && $params['beforeNormalize'] === true) {
            static::normalizePositions($modelObject, $params);
        }

        $item = $modelObject::findOne($id);
        $posCurent = intval($item->{$fieldPosition});
        $posFound  = ($direction == 'up') ? $posCurent - 1 : $posCurent + 1;

        $query = $modelObject::find()->andWhere("$fieldPosition = $posFound");

        if(isset($params['where'])) {
            $query->andWhere($params['where']);
        }
        $shiftedItem = $query->one();

        if($shiftedItem !== null)    {
            $shiftedItem->{$fieldPosition} = $posCurent; 
            $shiftedItem->save();
            $item->{$fieldPosition} = $posFound;
            $item->save(); 
        }  
    }


    public static function normalizePositions($modelObject, $params = null)   
    {
        $fieldPosition = (isset($params['fieldPosition'])) ? $params['fieldPosition'] : 'pos';
        $query = $modelObject::find();
        if(isset($params['where'])) {
            $query->where($params['where']);
        }
        $result = $query->orderBy($fieldPosition)->all();
        if($result) {
            foreach($result as $k => $v) {
                if((int)$v['pos'] != ($k + 1)) {
                    $item = $modelObject::findOne((int)$v['id']);
                    $item->{$fieldPosition} = $k + 1;
                    $item->save();
                }
            }
        }

    }




}
