<?php

use yii\helpers\Html;
use common\models\MainpageItem;

$out = [];
$i = 0;
foreach ($items as  $item) {
    if ($item['type'] == $type) {
        if ($i > $num) {
            break;
        }
        $out[] = $item;
    $i += 1;
    }
}
?>                
    
<div class="box-common">
    <div class="box-header">
        <span><?= $title ?></span>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php
            $item = array_shift($out);
            $link = ['article/view', 'category_slug' => $item['category_slug'], 'slug' => $item['slug']];
            $img = Html::img('/photo/article/300x170/' .$item['image_src']); 
            ?>
            <div class="box-slim">
                <div class="images">
                    <?= Html::a($img, $link, ['class' => 'inner-shadow']); ?>
                </div>
                <h3 class="title title-c"><?= Html::a($item['title'], $link) ?></h3>
                <div class="brief"><?= Html::a(MainpageItem::briefText($item, 120), $link); ?></div>
            </div>
        </div>
            

        <div class="col-md-6" style="padding-left: 30px;">
        <?php
        $i = 0;
        foreach($out as $item) {

            $link = ['article/view', 'category_slug' => $item['category_slug'], 'slug' => $item['slug']];
            $img = Html::img('/photo/article/300x170/' .$item['image_src']); ?>

            <div class="news_box">
                <div class="row">
                    <div class="col-xs-4 img-compact">
                        <?= Html::a($img, $link); ?>
                    </div>
                    <div class="col-xs-8">
                        <h4 class="title title-e"><?= Html::a($item['title'], $link); ?></h4>
                    </div>
                </div>
            </div><!-- .news_box -->
        <?php }  ?>
        </div>
    </div>
</div>
