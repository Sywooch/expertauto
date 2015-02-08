<?php
use yii\helpers\Html;
use yii\helpers\CommonHelper;
use backend\assets\AppAsset;


$this->title = $this->title .' Редактировать статью';
$this->registerJsFile('js/core/jquery.synctranslit.js', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('js/author.js', ['depends' => [AppAsset::className()]]);
?>

<section class="wrapper top-minimize">
    <div class="row">
        <div class="col-md-12">
        
            <section class="panel">
                <?= $this->render('/layouts/toppanel/common', ['title' => 'Автор']) ?>
                <div class="panel-body panel-common">
                    <?= $this->render('_form', ['model' => $model]) ?>
                </div>
            </section>

        </div>    
    </div>
</section>