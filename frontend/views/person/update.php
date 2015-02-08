<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
// use frontend\assets\AppAsset;

// $this->registerJsFile('js/article.js', [AppAsset::className()]);

$this->title = 'Изменить данные пользователя';
?>

<div id="article_content">
    <?= $this->render('_form', ['model' => $model]); ?>
</div><!-- #article_content -->

<!-- SIDEBAR -->
<div class="sidebar sidebar-article">
    <?= $this->render('/layouts/_sidebar_b'); ?>
</div>
<div class="clearfix"></div>