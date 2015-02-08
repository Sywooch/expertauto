<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tagging".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $tag_id
 */
class Tagging extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'tagging';
    }


    public function rules()
    {
        return [
            [['article_id', 'tag_id'], 'required'],
            [['article_id', 'tag_id'], 'integer']
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => '',
            'article_id' => '',
            'tag_id' => '',
        ];
    }

    public static function listForArticle($article_id)
    {
        return  static::find()
            ->select(static::tableName() .'.id, tag.id AS tag_id, tag.name, tag.slug')
            ->where(['article_id' => $article_id])
            ->leftJoin('tag', 'tag.id = ' .static::tableName() .'.tag_id')
            ->orderBy('tag.name')
            ->asArray()
            ->all();
    }

    public static function addTagsForArticle($article_id)
    {
        if(isset($_POST['Tagging'])) {
            foreach($_POST['Tagging']['tag_id'] as $k => $tag_id) {
                if(!$tag_id) continue;
                $tagging = new self;
                $tagging->tag_id = (int)$k;
                $tagging->article_id = $article_id;
                $tagging->save();
            }  
        } 
    }

}
