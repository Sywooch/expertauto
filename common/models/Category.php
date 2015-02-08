<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Utilities;
use common\behaviors\TransliterateBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $slug
 * @property integer $pos
 */
class Category extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'category';
    }

    public function behaviors()
    {
        return [
            'transliterate' => [
                'class' => TransliterateBehavior::className(),
                'attributes' => [
                      ActiveRecord::EVENT_BEFORE_VALIDATE => ['name' => 'slug'],
                ],
            ],
        ];    
     }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['parent_id', 'pos'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255]
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => '',
            'parent_id' => '',
            'name' => '',
            'slug' => '',
            'pos' => '',
        ];
    }


    public static function listWithParents()
    {
       // return static::find()
       //      ->select('category.*,
       //          parent.name as parent_name, 
       //          parent.pos as parent_pos, parent.slug as parent_slug')
       //      ->leftJoin('category AS parent', 
       //          'parent.id = category.parent_id')
       //      ->where('category.parent_id > 0')
       //      ->orderBy('parent.pos, category.pos')
       //      ->asArray()
       //      ->all();

        return static::find()
            ->select('
                sub.id as id, category.id  as parent_id, 
                sub.name as name, category.name as parent_name, 
                sub.pos as pos, category.pos as parent_pos, 
                sub.slug as slug, category.slug as parent_slug')
            ->leftJoin('category AS sub', 
                'sub.parent_id = category.id and sub.parent_id > 0')
            ->where('category.parent_id = 0')
            ->orderBy('category.pos, sub.pos')
            ->groupBy('sub.id')
            ->asArray()
            ->all();
    }


    // .......

    public function beforeSave($insert) 
    {
        if(parent::beforeSave($insert)) {
            if($this->isNewRecord) {
                $max = Utilities::findMaxFrom( static::tableName(), ['where' => ['parent_id' => $this->parent_id]]);
                $pos = ($max) ? $max + 1 : 1;
                $this->pos = $pos;
            }
            return true;
        }
        return false;
    }


    public function afterDelete()
    {   
        parent::afterDelete();
        // echo $this->parent_id; exit;
        $params = ['where' => ['parent_id' => $this->parent_id]];
        Utilities::normalizePositions(new Category, $params);   
    }


}
