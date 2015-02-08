<?php
namespace common\models;

use Yii;
use yii\helpers\Html;

class Helper 
{

    public static function getAuthorFullName($article) 
    {
        $author = $article['firstname'] .' ' .$article['lastname'];
        if(!empty($article['job'])) {
            $author .= ', ' .$article['job'];
        }
        return $author;
    }

    public static function getSourseArticle($article)
    {   
        if(empty($article['source_name'])) {
            return false;
        }
        if(!empty($article['source_link'])) {
            return Html::a($article['source_name'], $article['source_link'], ['target' => '_blank']);
        }   else {
            return $article['source_name'];
        }
    } 


}
