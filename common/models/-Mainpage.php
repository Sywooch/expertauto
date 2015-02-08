<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mainpage".
 *
 * @property integer $id
 * @property string $type
 * @property integer $article_id
 * @property string $url
 * @property integer $pos
 * @property string $image_src
 */
class Mainpage extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'mainpage';
    }


    public function rules()
    {
        return [
            [['type', 'pos'], 'required'],
            [['article_id', 'pos'], 'integer'],
            [['type'], 'string', 'max' => 32],
            [['url'], 'string', 'max' => 255],
            [['image_src'], 'string', 'max' => 50]
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'article_id' => 'Article ID',
            'url' => 'Url',
            'pos' => 'Pos',
            'image_src' => 'Image Src',
        ];
    }

   



}
