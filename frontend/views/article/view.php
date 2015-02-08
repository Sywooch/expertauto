<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\models\Article;
use common\models\Meta;
use common\models\ImageArticle;
use common\models\Helper;
// use frontend\assets\AppAsset;

// $this->registerJsFile('js/article.js', ['depends' => [AppAsset::className()]]);

$this->title = $article['title'] .Meta::$titleSuffix;
$this->registerMetaTag(['name' =>'description','content' => Meta::getDescriptionForArticle($article)]);
$this->registerMetaTag(['name' =>'keywords','content' => Meta::getKeywordsForArticle($article)]);
?>

<div class="container-fluid">
<div class="row">
    <div class="column column-left">

        <div id="article_content">
            <section id="breadcrumbs">
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'Главная', 'url' => Yii::$app->homeUrl],
                'links' => [
                    ['label' => $article['maincategory_name']],
                    ['label' => $article['category_name'], 'url' => ['article/index', 'category' => $article['category_slug']]],
                    // ['label' => $article['title']],
                ],
            ]); ?>
            </section>

        <article class="article">
            <h1><?= $article['title'] ?></h1>

        <?php
        if(!empty($article['image_src']))  {
            $src = '/photo/article/800/' .$article['image_src'];
            echo '
            <figure class="main-image full-width">'
                    .Html::img($src, ['alt' => $article['title']]) ."
            </figure>\n";
        }
            
            $paragraphs = explode("\n", $article['content']); 
            foreach($paragraphs as $k => $parag)   
            {
                $hasImage = false;

                if (isset($images[$k])) { 
                    $hasImage = true;
                    $layout = ($images[$k][0]['layout'] == ImageArticle::LAYOUT_BOTTOM) ? 'bottom' : 'float';
                }

                if( $hasImage && $layout == 'float' )  {
                    echo $this->render('_image_float', ['image' => $images[$k][0] ]);
                }
                echo (Article::checkIsParagraph($parag)) ? "<p>$parag</p>" : $parag;
                
                if( $hasImage && $layout == 'bottom' ) {
                    echo $this->render('_image_bottom', ['images' => $images[$k] ]);
                }

            }

        if(!empty($article['lastname'])) { ?>        
            <div class="author">
                <?= Helper::getAuthorFullName($article) ?>
            </div>
        <?php } 

        if(!empty($article['source_name'])) { ?>  
            <div class="author">
                <span style="margin-right: 10px;">Источник:</span>
                <?= Helper::getSourseArticle($article) ?>
            </div>
        <?php } 

        if(count($tags) > 0) { ?>
            <div class="tags_area row">
                <div class="tags-icon glyphicon glyphicon-tags"></div>
                <div class="tags-items">
                <?php 
                foreach($tags as $tag)  { ?>
                    <span><?= Html::a($tag['name'], ['article/index', 'tag' => $tag['slug']]) ?></span>
                <?php } ?>
                </div>
            </div>
        <?php } ?>

            </article>
        </div><!-- #article_content -->
    </div><!-- .column-left -->

    <div class="column column-right">
        <div class="sidebar sidebar-article">
            <?= $this->render('/layouts/_sidebar_b'); ?>
        </div>
    </div>    
</div><!-- .row -->
</div><!-- .container-fluid -->