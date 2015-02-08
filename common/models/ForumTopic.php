<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "forum_topic".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $person_id
 * @property integer $parent_id
 * @property integer $is_category
 * @property integer $title
 * @property integer $pos
 */
class ForumTopic extends \yii\db\ActiveRecord
{


    public static function tableName()
    {
        return 'forum_topic';
    }

    public function behaviors()
    {
        return [
            'timestampBehavior' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];    
     }

    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['person_id', 'parent_id', 'is_category', 'pos'], 'integer'],
            [['title'], 'required']
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'person_id' => 'Person ID',
            'parent_id' => '',
            'is_category' => '',
            'title' => 'Название',
            'pos' => '',
        ];
    }

    
    public static function queryFull()
    {   
        return static::find()
            ->select('forum_topic.*, parent_topic.title AS parent_title')
            ->leftJoin('forum_topic AS parent_topic', 'forum_topic.parent_id = parent_topic.id')
            ->orderBy('pos, created_at');
    }

    public static function listByParentId($parent_id)
    {
       return static::queryFull()
            ->andWhere(['forum_topic.parent_id' => $parent_id])
            ->asArray()
            ->all();
    }  

    public static function getChainOfTopics($parent_id)
    {
        $chain = [];
        while ( $parent_id != 0) {
            $topic = static::findOne($parent_id);
            if($topic !== null) {
                $chain[] = $topic;
                $parent_id = $topic['parent_id'];
            }
        }
        return array_reverse($chain);
    }




    public function beforeSave($insert) 
    {
        if(parent::beforeSave($insert)) {
            $this->person_id = Yii::$app->user->identity->id;
            return true;
        }
        return false;
    }

}
