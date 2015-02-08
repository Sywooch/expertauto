<?php

namespace app\models;

use Yii;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opinion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dealer_id', 'person_id', 'content', 'rate_1', 'rate_2', 'rate_3', 'rate_sum'], 'required'],
            [['dealer_id', 'person_id', 'rate_1', 'rate_2', 'rate_3'], 'integer'],
            [['content'], 'string'],
            [['rate_sum'], 'number'],
            [['pro', 'contra'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dealer_id' => 'Dealer ID',
            'person_id' => 'Person ID',
            'content' => 'Content',
            'pro' => 'Pro',
            'contra' => 'Contra',
            'rate_1' => 'Rate 1',
            'rate_2' => 'Rate 2',
            'rate_3' => 'Rate 3',
            'rate_sum' => 'Rate Sum',
        ];
    }
}
