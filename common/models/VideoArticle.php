<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "video_article".
 *
 * @property integer $id
 * @property integer $article_id
 * @property string $src
 * @property string $caption
 * @property integer $pos
 * @property integer $subpos
 * @property integer $layout
 */
class VideoArticle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'src'], 'required'],
            [['article_id', 'pos', 'subpos', 'layout'], 'integer'],
            [['src'], 'string', 'max' => 40],
            [['caption'], 'string', 'max' => 700]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'src' => 'Src',
            'caption' => 'Caption',
            'pos' => 'Pos',
            'subpos' => 'Subpos',
            'layout' => 'Layout',
        ];
    }
}
