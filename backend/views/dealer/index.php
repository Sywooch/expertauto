<?php
use yii\helpers\Html;
use common\models\Dealer;
use backend\assets\AppAsset;

$this->title = $this->title .' Дилеры';
// $this->registerJsFile('js/articles.js', ['depends' => [AppAsset::className()]]);
?>

<section class="wrapper top-minimize">
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('/layouts/toppanel/common_add', ['title' => 'Дилеры', 'modelName' => 'dealer']) ?>
            <div class="panel panel-common clearfix">

            <table class="table table-striped" style=" width: 600px;">
                <thead>
                    <tr>
                        <th style="width: 320px;">Название</th>
                        <th style="width: 240px;">Город</th>
                        <th style="width: 70px;">Удал.</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
             if($items) {                   
                foreach($items as $item) {
                ?>
                    <tr>
                        <td class="bigger" style="padding: 4px 6px;"><?= Html::a($item['name'], ['dealer/update', 'id'=>$item['id']], ['class' => 'hovered']) ?></td>
                        <td><?= $item['city_name']  ?></td>
                        <td><?= HTML::a('<div class="icon_delete"></div>', ['dealer/delete', 'id' => $item['id']], ['class' => 'confirm-delete']); ?></td>  
                    </tr>
            <?php } ?> 
                </tbody>       
            </table>

            <?php
            if($pagination->pageCount > 1) {
                echo \yii\widgets\LinkPager::widget(['pagination' => $pagination]);
            } 
        }
        ?>

            </div><!-- row -->
        </div><!-- col-md-12 -->
    </div><!-- panel -->

</section>