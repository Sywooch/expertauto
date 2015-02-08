<?php
use yii\helpers\Html;
use common\models\Article;
use yii\helpers\CommonHelper;
use backend\assets\AppAsset;

$this->title = $this->title .' Cтатьи';
$this->registerJsFile('js/core/jquery.phantomDot.js', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('js/_select_category.js', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('js/articles.js', ['depends' => [AppAsset::className()]]);
?>

<section class="wrapper top-minimize">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('/layouts/toppanel/articles') ?>
            <div class="panel panel-common clearfix">
            
            <div class="toggle-form">
                <?= $this->render('/layouts/_form_search') ?>   
            </div>    
            <!-- <header class="panel-heading">Статьи</header> -->

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 360px;">Заголовок</th>
                        <th style="width: 200px;">Рубрика</th>
                        <th style="width: 70px;">Статус</th>
                        <th style="width: 70px;">Удалить</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
             if($items) {                   
                foreach($items as $item) {
                ?>
                    <tr>
                        <td class="bigger" style="padding: 4px 6px;"><?= Html::a($item['title'], ['article/update', 'id'=>$item['id']], ['class' => 'hovered']) ?></td>
                        <td style="font: italic 14px Arial,sans-serif;"><?= $item['maincategory_name'] .' : ' .$item['category_name'] ?></td>
                        <td class="place-state">
                            <span id="article-state-<?= $item['id'] ?>-<?= $item['state'] ?>" class="dot <?= ($item['state'] ==1) ? 'active' : 'no-active'; ?>"></span>
                        </td>
                        <td><?= HTML::a('<div class="icon_delete"></div>', ['article/delete', 'id' => $item['id']], ['class' => 'confirm-delete']); ?></td>  
                    </tr>
            <?php } ?> 
                </tbody>       
            </table>

            <?php
            if($pages->pageCount > 1) {
                echo \yii\widgets\LinkPager::widget(['pagination' => $pages]);
            } 
        }
        ?>

            </div><!-- row -->
        </div><!-- col-md-12 -->
    </div><!-- panel -->

</section>