<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "image_article".
 *
 * @property integer $id
 * @property integer $article_id
 * @property string $src
 * @property string $caption
 * @property integer $pos
 * @property integer $subpos
 * @property integer $layout
 */
class ImageArticle extends \yii\db\ActiveRecord
{
    const LAYOUT_BOTTOM   = 1;
    const LAYOUT_LEFT     = 2;
    const LAYOUT_RIGHT    = 3;

    public $file;


    public static function tableName()
    {
        return 'image_article';
    }

    // optional: subdir, crop, sharpen, watermark
    public static function getStandardPattern() {
        return   [
            [
                'subdir'    => '800',
                'width'     => 800,
                'height'    => 800,
                'quality'   => 86,
                'sharpen'   => 4
            ],
            [
                'subdir'    => '300x170',
                'crop'      => true,
                'width'     => 300,
                'height'    => 170,
                'sharpen'   => 2
            ],
            [
                'subdir'    => '100x100',
                'crop'      => true,
                'width'     => 100,
                'height'    => 100,
                'sharpen'   => 2
            ]
        ];
    }

    public function rules()
    {
        return [
            [['article_id', 'src'], 'required'],
            [['article_id', 'pos', 'subpos', 'layout'], 'integer'],
            [['src'], 'string', 'max' => 40],
            [['caption'], 'string', 'max' => 700],
            [['file'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => '',
            'article_id' => '',
            'src' => '',
            'caption' => '',
            'pos' => '',
            'subpos' => '',
            'layout' => '',
            'file' => '',
        ];
    }

    //.....................................
    
    public function beforeSave($insert) 
    {
        if(parent::beforeSave($insert)) {
            if($this->isNewRecord) {
                $max = \common\models\Utilities::findMaxFrom(\common\models\ImageArticle::tableName(), [
                        'field'     => 'subpos',
                        'condition' => [
                            'article_id' => $this->article_id,
                            'pos' => $this->pos
                        ]
                    ]);
                $subpos = ($max) ? $max + 1 : 1;
                $this->subpos = $subpos;
            }
            return true;
        }
        return false;
    }

}
