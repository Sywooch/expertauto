<?php

use yii\helpers\Html;
use common\models\MainpageItem;
?>

<div class="box-common">
    <div class="box-title"><span><?= $title ?></span></div>
    <?php
    $i = 0;
    foreach($items as $k => $item) {
        if($item['type'] == $type && $i < $num) {

            $link = ['article/view', 'category_slug' => $item['category_slug'], 'slug' => $item['slug']];
            $img = Html::img('/photo/article/100x100/' .$item['image_src']); ?>

            <div class="news_box">
                <div class="row">
                    <div class="column img-compact col-xs-3">
                        <?= Html::a($img, $link); ?>
                    </div>
                    <div class="col-xs-9">
                        <h4 class="title title-d"><?= Html::a($item['title'], $link); ?></h4>
                    </div>
                </div>
            </div><!-- .news_box -->
            <?php
            ++$i;
        }
    }  ?>
</div>