<?php

use yii\helpers\Html;
use common\models\Meta;
use common\models\Image;


// TODO for tag, authors and search list
$category_name      =  $items[0]['category_name'];
$maincategory_name  =  $items[0]['maincategory_name'];
$this->title = $maincategory_name  .Meta::$titleSuffix;
?>

<div class="container-fluid">
<div class="row">
    <div class="column column-left">

        <div id="article_content">
            <section id="breadcrumb-list">
                <?= $this->render('_breadcrumbs_list', ['first' => $items[0]]); ?>
            </section>

            <section id="articles-list">
            <?php
            if(count($items) > 0 ) { ?>
                <ul class="articles-list">
                <?php
                foreach($items as $item) {

                    $link = ['article/view',
                        'category_slug' => $item['category_slug'],
                        'slug' => $item['slug']
                        ];
                    
                    $img = Html::img(Image::getImageSrc('/photo/article/300x170/' .$item['image_src'], '/images/blank-image.png'));
                    ?>
                    <li>
                    <div class="row">
                        <div class="col-md-3">
                        <!-- <div class="thumb"> -->
                            <?= Html::a($img, $link); ?>
                        </div>

                        <div class="col-md-8 title">
                        <!-- <div class="title"> -->
                            <span><?= $item['maincategory_name'] .' / ' .$item['category_name'] ?></span>
                            <?= Html::a($item['title'], $link); ?>
                        </div>
                        <!-- <div class="clearfix"></div> -->
                    </div>
                    </li>
                <?php  
                } ?>

                </ul>
                <?php
                if($pages->pageCount > 1) {
                    echo \yii\widgets\LinkPager::widget(['pagination' => $pages]);
                } ?>
            <?php }  ?>   
            </section>
        </div><!-- #article_content -->
    </div><!-- .column-left -->

    <div class="column column-right">
        <div class="sidebar sidebar-article">
            <?= $this->render('/layouts/_sidebar_b'); ?>
        </div>
    </div>    
</div><!-- .row -->
</div><!-- .container-fluid -->