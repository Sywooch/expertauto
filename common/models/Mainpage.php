<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mainpage".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
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
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255]
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
        ];
    }


    

}
