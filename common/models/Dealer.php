<?php

namespace common\models;

use Yii;
// use common\models\Opinion;

/**
 * This is the model class for table "dealer".
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $name
 * @property double $rate_1
 * @property double $rate_2
 * @property double $rate_3
 * @property double $rate_sum
 * @property integer $vote
 */
class Dealer extends \yii\db\ActiveRecord
{

    public $city_name;

    public static function tableName()
    {
        return 'dealer';
    }


    public function rules()
    {
        return [
            [['city_id', 'name'], 'required'],
            [['city_id', 'vote'], 'integer'],
            [['rate_1', 'rate_2', 'rate_3', 'rate_sum'], 'number'],
            [['name'], 'string', 'max' => 255]
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'city_id' => 'Город',
            'name' => 'Название',
            'vote' => 'Кол-во голосов',
            'rate_1' => 'Rate 1',
            'rate_2' => 'Rate 2',
            'rate_3' => 'Rate 3',
            'rate_sum' => 'Rate Sum',
        ];
    }

    public static function updateRate($dealer_id, $rate_1, $rate_2, $rate_3, $rate_sum)
    {

        $command = Yii::$app->db->createCommand(
            "SELECT
                COUNT(id) as vote,
                SUM(rate_1) as sum_1, 
                SUM(rate_2) as sum_2, 
                SUM(rate_3) as sum_3, 
                SUM(rate_sum) as sum_sum
            FROM opinion
            WHERE dealer_id = $dealer_id ");
        $row = $command->queryOne();

        if($row) {
            $dealer = self::findOne($dealer_id);
            if($dealer) {
                $vote = $row['vote'] + 1;
                $dealer->rate_1 = round(($row['sum_1'] + $rate_1) / $vote, 3);
                $dealer->rate_2 = round(($row['sum_2'] + $rate_2) / $vote, 3);
                $dealer->rate_3 = round(($row['sum_3'] + $rate_3) / $vote, 3);
                $dealer->rate_sum = round(($row['sum_sum'] + $rate_sum) / $vote, 3);
                $dealer->vote = $vote;
                $dealer->save();
            }
        }


    }


}
