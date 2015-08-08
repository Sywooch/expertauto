<?php

use yii\helpers\Html;
use common\models\Meta;


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
            if(count($items) > 0 ) { 
                echo $this->render('_list', ['items' => $items, 'pagination' => $pagination]);
            } 
            ?>
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