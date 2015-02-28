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
            foreach($items as $k => $item) {
                if($item['type'] == $type && $i < $num) {

                    $link = ['article/view', 'category_slug' => $item['category_slug'], 'slug' => $item['slug']]; ?>
                    <div class="titles">
                        <?= Html::a($item['title'], $link); ?>
                    </div>
                    <?php
                    ++$i;
                }
            }
            ?>