<?php

use yii\helpers\Html;
use common\models\Meta;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;

if(!Yii::$app->user->isGuest) {
    $this->registerJsFile('js/jquery.formstyler.js', ['depends' => [AppAsset::className()]]);
    $this->registerJsFile('js/opinion.js', ['depends' => [AppAsset::className()]]);
}

$this->title = 'Рейтинг' .Meta::$titleSuffix;
?>

<div class="container-fluid">
<div class="row">
    <div class="column column-left">
        <div id="article_content">

            <section id="breadcrumb-list">
                <?= Breadcrumbs::widget([
                      'homeLink' => ['label' => 'Главная', 'url' => Yii::$app->homeUrl],
                      'links' => [['label' => 'Рейтинг']]]);  ?>
            </section>

            <section id="opinion" style="margin: 40px 50px 40px 50px;">
            <?php
            if(Yii::$app->user->isGuest) {
                echo 'Чтобы оставить отзыв, вы должны '
                .Html::a('войти', ['#modal-login'], ['data-toggle' => 'modal']) .' / ' 
                .Html::a('зарегистрироваться', ['#modal-signup'], ['data-toggle' => 'modal']);
            }  else {
                echo Html::a('Оставьте отзыв', ['#modal-opinion'], ['data-toggle' => 'modal', 'class' => 'btn btn-primary']);
            }
            ?>
            </section>
        </div><!-- #article_content -->
    </div><!-- .column-left -->

    <div class="column column-right">
        <div class="sidebar sidebar-article">
            <?= $this->render('/layouts/_sidebar_b'); ?>
        </div>
    </div>    
</div><!-- .row -->
</div><!-- .container-fluid -->
    
    <?php
    if(!Yii::$app->user->isGuest) {
        echo $this->render('_modal_form');
    }
    ?>