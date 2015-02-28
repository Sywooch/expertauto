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
                    $img = Html::img('/photo/article/300x170/' .$item['image_src']); ?>
                    <div class="column_headline grey">
                        <div class="box">
                            <div class="images">
                                <?= Html::a($img, $link, ['class' => 'inner-shadow']); ?>
                            </div>
                            <div class="titles padding">
                                <?= Html::a($item['title'], $link); ?>
                            </div>
                            <div class="desc"><?= Html::a(MainpageItem::briefText($item, 120), $link); ?></div>
                        </div>
                    </div>
                    <?php
                    ++$i;
                    ++$f;
                }
            }
            ?>         
            
                