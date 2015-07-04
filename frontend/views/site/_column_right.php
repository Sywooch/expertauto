<?php
use yii\helpers\Html;
?>

<div class="block" style="margin-top: 0;">
    <?= $this->render('/layouts/_block_c1', [
            'items' => $items,
            'title' => 'Лента новостей',
            'type'  => 'news',
            'num'   => 8
        ]); ?>
</div>

<div class="block">
    <?= $this->render('/layouts/_block_adv') ?>
</div>

<div class="block">
    <?= $this->render('/layouts/_block_c2', [
            'items' => $items,
            'title' => 'Популярное',
            'type'  => 'popular',
            'num'   => 10
        ]); ?>
</div>

<div class="block">
    <?= $this->render('/layouts/_block_dilers') ?>
    <?= Html::a('Весь рейтинг', ['opinion/index']) ?>
</div>

<div class="block">
    <?= $this->render('/layouts/_block_forums') ?>
</div>


<div class="block">
    <?= $this->render('/layouts/_block_c3', [
            'items' => $items,
            'title' => 'Норматив',
            'type'  => 'law',
            'num'   => 1
        ]); ?>
</div>