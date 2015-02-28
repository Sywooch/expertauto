<?php
    use yii\helpers\Html;
    use common\models\MainpageItem;
?>                

        <!-- <h2 class="columntitle">$title</h2> -->
        <h2 class="thematic main-background">
            <span class="title"><?= $title ?></span>
            <span class="arrow  main-background"></span>
        </h2>
        <div class="clearfix"></div>
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
                    <div class="images">
                        <?= Html::a($img, $link, ['class' => 'inner-shadow']); ?>
                    </div>
                    <div class="titles center">
                        <?= Html::a($item['title'], $link); ?>
                    </div>
                    <div class="desc"><?= Html::a(MainpageItem::briefText($item, 120), $link); ?></div>
                </div>
                <?php
                if($f % 2 != 0) {
                    echo '</div>';
                }
                ++$i;
                ++$f;
            }
        }
        ?> 