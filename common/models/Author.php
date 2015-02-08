<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\behaviors\TransliterateBehavior;

/**
 * This is the model class for table "author".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $job
 * @property integer $type
 * @property string $image_src
 * @property string $about
 */
class Author extends \yii\db\ActiveRecord
{

    const TYPE_EXPERT   = 1;
    const TYPE_AUTHOR   = 2;


    public static function getTypeName()
    {
        return [
            1 => 'Эксперт',
            2 => 'Автор',
        ];
    }


    public static function tableName()
    {
        return 'author';
    }

    public function behaviors()
    {
        return [
            'transliterate' => [
                'class' => TransliterateBehavior::className(),
                'attributes' => [
                      ActiveRecord::EVENT_BEFORE_VALIDATE => ['firstname' => 'slug'],
                ],
            ],
        ];    
     }

    public function rules()
    {
        return [
            [['firstname', 'lastname', 'type'], 'required'],
            [['type'], 'integer'],
            [['firstname', 'lastname', 'job', 'slug'], 'string', 'max' => 255],
            [['image_src'], 'string', 'max' => 50],
            [['about'], 'string'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'job' => 'Должность',
            'type' => 'Type',
            'slug' => 'ЧПУ',
            'image_src' => 'Image Src',
            'about' => 'Резюме',
        ];
    }
}
