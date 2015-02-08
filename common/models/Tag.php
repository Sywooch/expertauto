<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Tagging;
use common\behaviors\TransliterateBehavior;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 */

class Tag extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'tag';
    }

    public function behaviors()
    {
        return [
            'transliterate' => [
                'class' => TransliterateBehavior::className(),
                'attributes' => [
                      ActiveRecord::EVENT_BEFORE_VALIDATE => ['name' => 'slug'],
                      // ActiveRecord::EVENT_BEFORE_INSERT => ['name' => 'slug'],
                      // ActiveRecord::EVENT_BEFORE_UPDATE => ['name' => 'slug'],
                ],
            ],
        ];    
     }


    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name'], 'validateMustBeUnique'],
            [['name', 'slug'], 'string', 'max' => 255, 'min' => 2]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '',
            'name' => '',
            'slug' => '',
        ];
    }

    public function validateMustBeUnique($attribute, $params) {

        $name = trim($this->$attribute);
        $sql = $this->findOne(['name' => $name]);
        if($sql) {
            $this->addError($attribute, 'Такой тэг уже есть');
        }
    }


    public static function findUnusedTags($articleTags)
    {   
        $articleTagsIds = [];
        $unusedTags     = [];

        foreach ($articleTags as $tag) {
           $articleTagsIds[] = $tag['tag_id'];
        }
        $allTags = static::find()->orderBy('name')->asArray()->all();
        foreach($allTags as $tag) {
            if(!in_array($tag['id'], $articleTagsIds)) {
                $unusedTags[] = $tag;
            }
        }
        return $unusedTags;
    }


    // ..........

    public function afterDelete()
    {   
        parent::afterDelete();
        Tagging::deleteAll(['tag_id' => $this->id]);
    }


}
