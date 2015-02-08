<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "auth".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $source
 * @property string $source_id
 *
 * @property Person $user
 */

class Auth extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'auth';
    }


    public function rules()
    {
        return [
            [['user_id', 'source', 'source_id'], 'required'],
            [['user_id'], 'integer'],
            [['source', 'source_id'], 'string', 'max' => 255]
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'source' => 'Source',
            'source_id' => 'Source ID',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Person::className(), ['id' => 'user_id']);
    }
}
