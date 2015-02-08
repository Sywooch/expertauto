<?php
namespace common\models;

use Yii;

class Meta 
{
    public static $titleSuffix = ' - АвтоЭкспертиза.ру';

    public static function getDescriptionForArticle($article)
    {   
        return (!empty($article['metadesc'])) ? $article['metadesc'] : $article['title'] .static::$titleSuffix;
    } 

    public static function getKeywordsForArticle($article)
    {   
        return (!empty($article['metakey'])) ? $article['metakey'] : 'автоэкспертиза';
    } 




}
