<?php
    use yii\helpers\Html;
    use common\models\MainpageItem;
?>                

            <h2 class="columntitle" style="margin-bottom: 20px;"><?= $title ?></h2>
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
                                <h4><?= Html::a($item['title'], $link); ?></h4>
                                <div class="date">
                                <!-- <span>Срд, 21.10.2014 - 14:27</span> -->
                                </div>
                            </div>
                        </div>
                    </div><!-- .news_box -->
                    <?php
                    ++$i;
                }
            }
            ?> 