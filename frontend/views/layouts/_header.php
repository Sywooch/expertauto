<?php
use yii\helpers\Html;
?>
<div class="row">
    <div class="header">
        <div class="wrapped">
            <div class="menu-item user">
                <div class="menu-item-btn">
                    <b>
                    <?php
                    if(Yii::$app->user->isGuest) { ?>
                        <a href="#modal-login" data-toggle="modal">Войти / </a>
                        <a href="#modal-signup" data-toggle="modal">Регистрация</a>
                    <?php } else {
                        echo Html::a( Yii::$app->user->identity->username, ['person/update', 'id' => Yii::$app->user->id]);
                        echo Html::a(' / выход' , ['person/logout'], ['data-method' => 'post']);
                    } ?>
                    </b>
                    <span></span>
                </div>
            </div>
            <div class="menu-item search">
                <a href="#modal-search" class="menu-item-btn" data-toggle="modal">
                    <b>Поиск</b>
                    <span></span>
                </a>
            </div>
            <div class="logo">
                <a href="/">
                    <?= Html::img('/images/title-logo.png') ?>
                </a>
            </div>
        </div>
    </div>
</div>
