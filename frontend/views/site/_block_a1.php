<?php
    use yii\helpers\Html;
    use common\models\MainpageItem;
?>                
    
    <div class="box-common">
        <div class="box-header">
            <div class="title"><?= $title ?></div>
        </div>

        <?php
        $i = 0;
        $f = 0;
        foreach($items as $k => $item) {
            if($item['type'] == $type && $i < $num) {

                $link = ['article/view', 'category_slug' => $item['category_slug'], 'slug' => $item['slug']];
                $img = Html::img('/photo/article/300x170/' .$item['image_src']); 

                if($f % 2 == 0) {
                    echo '<div class="row">';
                }
                ?>
                <div class="col-xs-6">
                <div class="box-slim">
                    <h3 class="block-heading"><?= Html::a($item['title'], $link) ?></h3>
                    <div class="images">
                        <?= Html::a($img, $link, ['class' => 'inner-shadow']); ?>
                    </div>
                    <div class="brief"><?= Html::a(MainpageItem::briefText($item, 120), $link); ?></div>
                </div>
                </div>
                <?php
                if($f % 2 != 0) {
                    echo '</div>';
                }
                ++$i;
                ++$f;
            }
        } ?> 
     </div>
