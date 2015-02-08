<?php
use yii\helpers\Html;
use common\models\Tag;
use yii\helpers\CommonHelper;
use backend\assets\AppAsset;

$this->title = $this->title .' Тэги';
$this->registerJsFile('js/core/jquery.phantomInput.js', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('js/tags.js', ['depends' => [AppAsset::className()]]);
?>

<section class="wrapper">
    <div class="row">
        <div class="col-md-12">
        <?= $this->render('/layouts/toppanel/tags') ?>
            <div class="panel panel-common clearfix bgr-grey">
            
            <?= $this->render('_form', ['model' => $model]) ?> 
            <table class="table table-striped" style="width: 500px;">
                <thead>
                    <tr>
                        <th style="width: 300px;">Название</th>
                        <th style="width: 70px;">Удал.</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
             if($items) {                   
                foreach($items as $item) {
                ?>
                    <tr>
                        <td><div class="cursor-pointer place-for-phantom" id="tag-name-<?= $item['id'] ?>"><?= $item['name'] ?></div></td>
                        <td><?= HTML::a('<div class="icon_delete"></div>', ['tag/delete', 'id' => $item['id']], ['class' => 'confirm-delete']); ?></td>  
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