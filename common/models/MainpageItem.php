<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use common\models\Utilities;

/**
 * This is the model class for table "mainpage_item".
 *
 * @property integer $id
 * @property integer $mainpage_id
 * @property integer $article_id
 * @property string $url
 * @property integer $pos
 * @property string $image_src
 */
class MainpageItem extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'mainpage_item';
    }


    public function rules()
    {
        return [
            [['mainpage_id', 'pos'], 'required'],
            [['article_id', 'mainpage_id', 'pos'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['image_src'], 'string', 'max' => 50]
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mainpage_id' => '',
            'article_id' => 'Article ID',
            'url' => 'Url',
            'pos' => 'Pos',
            'image_src' => 'Image Src',
        ];
    }


    public static function listBySlug($slug)
    {
        return self::find()
            ->select('mainpage_item.*, article.title, article.image_src as article_image')
            ->leftJoin('mainpage', 'mainpage.id = mainpage_item.mainpage_id')
            ->leftJoin('article', 'article.id = mainpage_item.article_id')
            ->where(['mainpage.slug' => $slug])
            ->orderBy('pos')
            ->asArray()
            ->all();
    }


    public static function listToMainpage($cached = false, $expired = 86400)
    {
        $conn = \Yii::$app->db;
        $orderBy = $cached ? 'RAND()' : 'mainpage_item.mainpage_id, mainpage_item.pos';
        $q = 'SELECT  a.title, a.brief, a.slug, a.image_src,
                    SUBSTRING(a.content, 1, 300) as content,
                    m.slug as type, c.slug as category_slug
           FROM mainpage_item 
           LEFT JOIN mainpage m ON m.id = mainpage_item.mainpage_id
           LEFT JOIN article a ON a.id = mainpage_item.article_id
           LEFT JOIN category c ON c.id = a.category_id
           ORDER BY ' .$orderBy;

        if ($cached) {
            return $conn->createCommand($q)->cache($expired)->queryAll();
        } else {
            return $conn->createCommand($q)->queryAll();
        }
    }

    public static function clearCache()
    {
        $cacheManager = new yii\caching\FileCache;
        $cacheManager->flush();
    }

    public static function briefText($item, $max)
    {   
        $outText = '';
        $sourceText = !empty($item['brief']) ? $item['brief'] :  $item['content'];
        // $punctuations = ['.', '!', '?'];    

        $arr = explode('.', $sourceText);

        while(mb_strlen($outText, 'utf-8') < $max) {
            $outText .= array_shift($arr) .'.';
        }
        return strip_tags($outText);
    }


    // ................

    public function afterDelete()
    {   
        parent::afterDelete();
        $params = ['where' => ['mainpage_id' => $this->mainpage_id]];
        Utilities::normalizePositions(new MainpageItem, $params);   
    }

}
