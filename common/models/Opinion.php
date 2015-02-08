<?php

namespace common\models;

use Yii;
use common\models\Dealer;

/**
 * This is the model class for table "opinion".
 *
 * @property integer $id
 * @property integer $dealer_id
 * @property integer $person_id
 * @property string $content
 * @property string $pro
 * @property string $contra
 * @property integer $rate_1
 * @property integer $rate_2
 * @property integer $rate_3
 * @property double $rate_sum
 */
class Opinion extends \yii\db\ActiveRecord
{
    
    public static function tableName()
    {
        return 'opinion';
    }

    
    public function rules()
    {
        return [
            [['dealer_id', 'person_id', 'content', 'rate_1', 'rate_2', 'rate_3'], 'required'],
            [['dealer_id', 'person_id', 'rate_1', 'rate_2', 'rate_3'], 'integer'],
            [['content'], 'string'],
            [['rate_sum'], 'number'],
            [['pro', 'contra'], 'string', 'max' => 255]
        ];
    }

   
    public function attributeLabels()
    {
        return [
           'id' => '',
            'dealer_id' => 'Dealer ID',
            'person_id' => '',
            'content' => 'Текст отзыва',
            'pro' => 'Что понравилось',
            'contra' => 'Что не понравилось',
            'rate_1' => 'Качество обслуживания',
            'rate_2' => 'Цена/качество',
            'rate_3' => 'Профессионализм',
            'rate_sum' => 'Общая оценка',
        ];
    }

    //.....................................
    
    public function beforeSave($insert) 
    {
        if(parent::beforeSave($insert)) {
            if($this->isNewRecord) {
                $rate_sum = ($this->rate_1 + $this->rate_2 + $this->rate_3) / 3;
                $this->rate_sum = round($rate_sum, 3);
            }
            return true;
        }
        return false;
    }

   
    public function afterSave($insert = true, $changedAttributes)
    {   
        Dealer::updateRate($this->dealer_id, $this->rate_1, $this->rate_2, $this->rate_3, $this->rate_sum);

        parent::afterSave($insert, $changedAttributes);
    }


}