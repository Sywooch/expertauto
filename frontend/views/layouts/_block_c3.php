<?php
    use yii\helpers\Html;
    use common\models\MainpageItem;
?>                

            <h2 class="columntitle"><?= $title ?></h2>
            <?php
            $i = 0;
            foreach($items as $k => $item) {
                if($item['type'] == $type && $i < $num) {

                    $link = ['article/view', 'category_slug' => $item['category_slug'], 'slug' => $item['slug']];
                    $img = Html::img('/photo/article/300x170/' .$item['image_src']); ?>
                    <div class="images">
                        <?= Html::a($img, $link); ?>
                    </div>
                    <div class="titles">
                        <?= Html::a($item['title'], $link); ?>
                    </div>
                    <div class="desc"><?= Html::a(MainpageItem::briefText($item, 120), $link); ?></div>
                    <?php
                    ++$i;
                }
            } 
            ?>         
            
                