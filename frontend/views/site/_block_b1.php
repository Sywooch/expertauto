<?php
    
use yii\helpers\Html;
use common\models\MainpageItem;
?>                
<div class="box-common">
    <div class="box-header"><span><?= $title ?></span></div>
        <?php
        $i = 0;
        $f = 0; 
        foreach($items as $k => $item) {
            if($item['type'] == $type && $i < $num) {

                $link = ['article/view', 'category_slug' => $item['category_slug'], 'slug' => $item['slug']];
                $img = Html::img('/photo/article/300x170/' .$item['image_src']); ?>
                <div class="box-slim">
                    <div class="title title-a">
                        <?= Html::a($item['title'], $link); ?>
                    </div>
                    <div class="images">
                        <?= Html::a($img, $link, ['class' => 'inner-shadow']); ?>
                    </div>
                    <div class="brief"><?= Html::a(MainpageItem::briefText($item, 120), $link); ?></div>
                </div>
                <?php
                ++$i;
                ++$f;
            }
        } ?>
</div>

            
                