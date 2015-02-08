<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use common\models\Image;

$this->title = $this->title .' Главная страница - ' .$mainpage['name'];
$this->registerJsFile('js/_select_category.js', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('js/_search_articles.js', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('js/mainpage-item.js', ['depends' => [AppAsset::className()]]);
?>

<section class="wrapper top-minimize">
    <div class="row">
        <div class="col-md-12">
        
            <section class="panel">
                <?= $this->render('/layouts/toppanel/common', ['title' => $mainpage['name']]) ?>
                <div class="panel-body panel-common">
                    <!-- ......................... -->
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-lg-10 col-lg-offset-1">

                            <article class="article">

                <div class="mainpage-items">
                            
                <?php
                if(count($items) == 0) {
                    echo '
                    <span class="icon-plus first" data-toggle="modal" href="#modal-search" data-mainpage_id="' .$mainpage['id'] . '" data-pos="1"></span>';
                }

                foreach ($items as $k => $item)  { 
                ?>    
                    <span class="icon-plus" data-toggle="modal" href="#modal-search" data-mainpage_id="<?= $item['mainpage_id'] ?>"  data-pos="<?= $item['pos'] ?>"></span>

                    <div class="box">
                    <?php
                    if($item['pos'] > 1) {
                        echo Html::a('<span class="arrows up"></span>', ['mainpage-item/shift', 'direction' => 'up', 'id' => $item['id'], 'mainpage_id' => $item['mainpage_id']]);
                    } 
                        echo Html::a('<span class="icon_delete"></span>', ['mainpage-item/delete', 'id' => $item['id']], ['class' => 'confirm-delete']);
                        ?>

                        <div class="item-image">
                            <?= Html::img( Yii::$app->params['baseFrontendUrl'] .'/photo/article/100x100/' .$item['article_image']); ?>
                        </div>
                        <div class="item-title">
                            <?= Html::a($item['title'], ['article/update', 'id' => $item['article_id']]); ?>
                        </div>

                    <div class="clearfix"></div>
                    </div>
            <?php  }  ?>
                </div><!-- /.mainpage-items -->


                            </article>
                        </div><!-- /col-lg-10 -->
                    </div><!-- /row -->      
                    <!-- ......................... -->
                </div>
            </section>

        </div>    
    </div>
</section>

<?= $this->render('/layouts/_modal_search'); ?>



            
