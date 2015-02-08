<?php
use yii\helpers\Html;
use common\models\Author;
use yii\helpers\CommonHelper;
use backend\assets\AppAsset;

$this->title = $this->title .' Авторы';
// $this->registerJsFile('js/articles.js', ['depends' => [AppAsset::className()]]);
?>

<section class="wrapper top-minimize">
    <div class="row">
        <div class="col-md-12">
             <?= $this->render('/layouts/toppanel/common_add', ['title' => 'Авторы', 'modelName' => 'author']) ?>
            <div class="panel panel-common clearfix">

            <table class="table table-striped" style=" width: 900px;">
                <thead>
                    <tr>
                        <th style="width: 200px;">Фамилия</th>
                        <th style="width: 240px;">Должность</th>
                        <th style="width: 70px;">Тип</th>
                        <th style="width: 70px;">Удал.</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                
             if($items) {                   
                foreach($items as $item) {
                    $fullname = $item['lastname'] .' ' .$item['firstname'];
                ?>
                    <tr>
                        <td class="bigger" style="padding: 4px 6px;"><?= Html::a($fullname, ['author/update', 'id'=>$item['id']], ['class' => 'hovered']) ?></td>
                        <td><?= $item['job']  ?></td>
                        <td><?= Author::getTypeName()[$item['type']] ?></td>
                        <td><?= HTML::a('<div class="icon_delete"></div>', ['article/delete', 'id' => $item['id']], ['class' => 'confirm-delete']); ?></td>  
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