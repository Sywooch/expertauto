<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use common\behaviors\TransliterateBehavior;

use yii\web\UploadedFile;
use common\models\Image;
use common\models\ImageArticle;
use common\models\Tag;
use common\models\Tagging;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $updated_at
 * @property integer $author_id
 * @property integer $category_id
 * @property string $title
 * @property string $content
 * @property string $brief
 * @property integer $state
 * @property string $image_src
 * @property string $slug
 * @property string $metakey
 * @property string $metadesc
 * @property string $source_name
 * @property string $source_link
 */
class Article extends \yii\db\ActiveRecord
{

    const STATE_INACTIVE = 0;
    const STATE_ACTIVE   = 1;

    public $file;
    public $category_name;
    public $category_slug;
    public $maincategory_name;
    public $maincategory_slug;

    public static $isActiveOnly = false; 
    public static $pages; 
    public static $itemsPerPage = 20; 
    
    private static $splitTags = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'table', 'ul'];    
    
    
    public static function tableName()
    {
        return 'article';
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
            'transliterate' => [
                'class' => TransliterateBehavior::className(),
                'attributes' => [
                      ActiveRecord::EVENT_BEFORE_VALIDATE => ['title' => 'slug'],
                      // ActiveRecord::EVENT_BEFORE_INSERT => ['title' => 'slug'],
                      // ActiveRecord::EVENT_BEFORE_UPDATE => ['title' => 'slug'],
                ],
            ],
        ];    
     }


    public function rules()
    {
        return [
            [['title', 'content', 'state', 'slug', 'category_id'], 'required', 'message' => 'Заполните поле'],
            [['created_at', 'updated_at'], 'safe'],
            [['category_id', 'author_id', 'state'], 'integer'],
            [['content', 'brief', 'source_name', 'source_link'], 'string'],
            [['title', 'image_src', 'slug', 'metakey', 'metadesc'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => '',
            'created_at' => '',
            'updated_at' => '',
            'author_id' => 'Автор',
            'category_id' => 'Рубрика',
            'title' => 'Заголовок',
            'content' => 'Текст',
            'brief' => 'Кратко',
            'state' => 'Статус',
            'image_src' => 'Фото',
            'slug' => 'ЧПУ',
            'metakey' => 'Meta Keys (через запятую)',
            'metadesc' => 'Meta Description',
            'source_name' => 'Название источника',
            'source_link' => 'Ссылка на источник',
            'file' => 'Фото',
        ];
    }


    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
                    ->viaTable(Tagging::tableName(), ['article_id' => 'id'])
                    ->orderBy('name');
    }


    public function getImageArrayByArticleId($id)
    {   
        $photos = ImageArticle::find()
            ->where(['article_id'=> (int)$id])
            ->orderBy('pos, subpos')
            ->asArray()->all();
       
        $arPhotos = [];
        foreach ($photos as  $photo) {
            $arPhotos[$photo['pos']][] = $photo;
        }
        return $arPhotos;
    }
    

    private static function createPaginator($query) 
    {
        static::$pages = new \yii\data\Pagination([
                'defaultPageSize' => self::$itemsPerPage,
                'totalCount' => $query->count(),
            ]);
    }

    public static function setItemsPerPage($k)
    {
        self::$itemsPerPage = $k;
    }
    

    public static function queryArticleFull($compact = false)
    {   
        $select =  $compact ? 'article.id, article.state, article.title, article.slug, article.brief, article.image_src' : 'article.*';

        $query = static::find()
            ->select($select .', author.firstname, author.lastname, author.job, author.slug as author_slug, category.name as category_name, maincategory.name as maincategory_name, category.slug as category_slug, maincategory.slug as maincategory_slug')
            ->leftJoin('category', 'category.id = article.category_id')
            ->leftJoin('category maincategory', 'maincategory.id = category.parent_id')
            ->leftJoin('author', 'author.id = article.author_id');

        // если выбрать только активные: 
        if(static::$isActiveOnly === true)  {
            $query->andWhere(['article.state' => static::STATE_ACTIVE ]);
        }
        return $query;
    }
    

    public static function findById($id)
    {   
        $article = static::queryArticleFull()
            ->andWhere(['article.id' => (int)$id])
            // ->asArray()
            ->one();
        return $article;
    }    

    public static function findBySlug($slug)
    {
        $article = static::queryArticleFull()
            ->andWhere(['article.slug' => $slug])
            ->asArray()
            ->one();
        return $article;
    }


    public static function listByAny($category, $tag, $author, $search, $order_by) {

        $query = static::queryArticleFull($compact = true);
            
        if($category) {
            $query->andWhere(['category.slug' => $category]);
        }
        if($author) {
            $query->andWhere(['author.slug' => $author]);
        }
        if($tag) {
            $query
                ->leftJoin('tagging', 'tagging.article_id = article.id')
                ->leftJoin('tag', 'tag.id = tagging.tag_id')
                ->andWhere(['tag.slug' => $tag]);
        }
        if(trim($search)) {
            $query->andWhere("article.title LIKE :search OR article.content LIKE :search", [':search' => "%$search%"]);
        }
        if(!$order_by) {
            $orderBy = 'created_at DESC';
        }     

        $query->orderBy($orderBy)->asArray();
        $paginator = static::createPaginator($query);
        return  $query->offset(static::$pages->offset)->limit(static::$pages->limit)->all();
    }


    public static function listAll()
    {
        $query = static::queryArticleFull($compact = true);

        if($category_id = Yii::$app->request->get('category_id')) {
            $query->andWhere(['category.id' => $category_id]);
        }

        if($category_id = Yii::$app->request->get('category_slug')) {
            $query->andWhere(['category.slug' => $category_slug]);
        }

        if($author_id = Yii::$app->request->get('author_id')) {
            $query->andWhere(['author_id' => $author_id]);
        }

        if(!$order_by = Yii::$app->request->get('order_by')) {
            $orderBy = 'created_at DESC';
        } 

        if($search = Yii::$app->request->get('search')) {
            $search =trim($search);
            $query->andWhere("article.title LIKE :search OR article.content LIKE :search", [':search' => "%$search%"]);
            // $query->andWhere(['like', 'title', trim($search)]);
        }
        $query
            ->orderBy($orderBy)
            ->asArray();
    
        $paginator = static::createPaginator($query);
        return  $query->offset(static::$pages->offset)->limit(static::$pages->limit)->all();
    } 


    public static function contentPrepareToTextAreaFormat($string)
    {
        $string = preg_replace("/\n/i", "<br>", $string);
        return $string;    
    }

    public static function contentPrepareToDbFormat($string)
    {   
        $string = preg_replace("/<\/li>\s*<br>\s*/i", "<\/li>", $string); // только для материалов Хрулева
        
        $string = preg_replace("/(\n)|(\r)/i", " ", $string);
        $string = preg_replace("/\s*<br>\s*/i", "\n", $string);

        $string = preg_replace("/\s*(<td>|<\/td>|<li>|<\/li>|<span>|<\/span>)\s*/i", "$1", $string); // только для материалов Хрулева

        $string = preg_replace(static::getClosedTagsForSplitPattern(), "$1\n", $string);
        $string = preg_replace("/\s*\n{2,}\s*/i", "\n", $string);
        return $string;
    }

    //.....................................
    
    public static function getClosedTagsForSplitPattern()
    {
        $tags = static::$splitTags;
        foreach ($tags as &$tag) {
            $tag = '\/' .$tag .'>';
        }
        $output = implode('|', $tags);
        $output = '/(' .$output .')\s*/i';
        return $output;
    }    

    public static function checkIsParagraph($string)
    {   
        $tags = static::$splitTags;
        foreach ($tags as &$tag) {
            $tag = '<' .$tag;
        }
        $pattern = implode('|', $tags);
        return (preg_match('/^('. $pattern .')/i', ltrim($string), $matches)) ? false : true;
    }


    //.....................................
    
    public function beforeSave($insert) 
    {
        if(parent::beforeSave($insert)) {
            $this->content = static::contentPrepareToDbFormat($this->content);
            return true;
        }
        return false;
    }


    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            
            Tagging::deleteAll(['article_id' => $this->id]);
            $images = ImageArticle::find()->where(['article_id'=> $this->id])->all();
            
            foreach($images as $image) {
                Image::deleteByPattern($image->src, Yii::getAlias('@img/article/'), ImageArticle::getStandardPattern());
                $image->delete();
            }
            // delete main photo:
            if(!empty($this->image_src)) {
                Image::deleteByPattern($image->image_src, Yii::getAlias('@img/article/'), ImageArticle::getStandardPattern());
            }
            return true;
        }
        return false;
    }




}
