<?php

use yii\helpers\Html;
use common\models\Meta;
use common\models\Image;
?>

                <ul class="articles-list">
                <?php           
                foreach($items as $item) {

                    $link = ['article/view',
                        'category_slug' => $item['category_slug'],
                        'slug' => $item['slug']
                        ];
                    
                    $img = Html::img(Image::getImageSrc('/photo/article/300x170/' .$item['image_src'], '/images/blank-image.png'));
                    ?>
                    <li>
                    <div class="row">
                        <div class="col-md-3">
                            <?= Html::a($img, $link); ?>
                        </div>
                        <div class="col-md-8 title">
                            <span><?= $item['maincategory_name'] .' / '.$item['category_name'] ?></span>
                            <?= Html::a($item['title'], $link); ?>
                        </div>
                    </div>
                    </li>
                <?php } ?>
                
                </ul>
                <?php
                if($pagination->pageCount > 1) {
                    echo \yii\widgets\LinkPager::widget(['pagination' => $pagination]);
                } 
