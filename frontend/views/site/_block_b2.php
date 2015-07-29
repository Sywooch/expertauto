<?php

use yii\helpers\Html;
use common\models\MainpageItem;
?>                

<div class="box-common">
    <div class="box-header">
    <div class="title"><?= $title ?></div>

    <div class="row">
    

        <div class="col-md-6">
            <?php
            $item = array_shift($items);
            $link = ['article/view', 'category_slug' => $item['category_slug'], 'slug' => $item['slug']];
            $img = Html::img('/photo/article/300x170/' .$item['image_src']);
            ?>

            <div class="column_headline">
                <div class="box">
                    <div class="images">
                        <?= Html::a($img, $link); ?>
                    </div>
                    <div class="titles">
                        <?= Html::a($item['title'], $link); ?>
                    </div>
                    <div class="desc"><?= Html::a(MainpageItem::briefText($item, 120), $link); ?></div>
                </div>
            </div>
        </div>
        


    <div class="col-md-6">
    </div>    
</div>



<div class="box-common">
    <div class="box-header">
        <div class="title"><?= $title ?></div>
    </div>
    <?php
    $i = 0;
    foreach($items as $k => $item) {
        if($item['type'] == $type && $i < $num) {

            $link = ['article/view', 'category_slug' => $item['category_slug'], 'slug' => $item['slug']];
            $img = Html::img('/photo/article/300x170/' .$item['image_src']); ?>
            <div class="column_headline">
                <div class="box">
                    <div class="images">
                        <?= Html::a($img, $link); ?>
                    </div>
                    <div class="titles">
                        <?= Html::a($item['title'], $link); ?>
                    </div>
                    <div class="desc"><?= Html::a(MainpageItem::briefText($item, 120), $link); ?></div>
                </div>
            </div>
            <?php
            ++$i;
        }
    } ?>         
</div>
            
                