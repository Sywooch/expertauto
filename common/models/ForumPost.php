<?php

namespace common\models;

use Yii;
use common\models\Person;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "forum_post".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $topic_id
 * @property integer $person_id
 * @property integer $status
 * @property string $content
 * @property integer $quote_id
 * @property string $quote_text
 * @property string $quote_author
 */
class ForumPost extends \yii\db\ActiveRecord
{

    const STATUS_NEW    = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_BANNED = 3;

     public static $pages;
     
    public static function tableName()
    {
        return 'forum_post';
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
            [['created_at', 'updated_at', 'quote_id'], 'safe'],
            [['topic_id', 'content', 'person_id', 'status'], 'required'],
            [['topic_id', 'person_id', 'status'], 'integer'],
            [['content', 'quote_text', 'quote_author'], 'string']
        ];
    }

    
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'topic_id' => '',
            'person_id' => '',
            'quote_id' => '',
            'content' => 'Сообщение',
            'quote_text' => 'Цитата',
        ];
    }

    // .......
    private static function createPaginator($query) 
    {
        static::$pages = new \yii\data\Pagination([
                'defaultPageSize' => 16,
                'totalCount' => $query->count(),
            ]);
    }

    public static function queryFull()
    {   
        return static::find()
            ->select('forum_post.*,  person.username, person.nickname, person.avatar_src')
            // ->leftJoin('forum_topic', 'forum_topic.id = forum_post.topic_id')
            ->leftJoin('person', 'person.id = forum_post.person_id')
            ->orderBy('forum_post.created_at');
    }

    public static function listByTopicId($id)
    {
       $query = static::queryFull()
            ->andWhere(['topic_id' => $id]);

        $paginator = static::createPaginator($query);
        return  $query->offset(static::$pages->offset)->limit(static::$pages->limit)
            ->asArray()
            ->all();
    }  


    //..................

    public function beforeValidate() 
    {

        if(parent::beforeValidate()) {
            $this->person_id = Yii::$app->user->identity->id;
            $this->status = self::STATUS_ACTIVE;

            if($this->quote_id) {
                $quote_post = self::findOne((int)$this->quote_id);
                if($quote_post) {
                    $quote_person = Person::findOne($quote_post['person_id']);
                    $this->quote_author = Person::getPublicName($quote_person); 
                }
            }

            return true;
        }
        return false;
    }

}
