<?php

use yii\helpers\Html;
?>

<div class="row">
    <div class="topmenu">
        <div class="wrapped">
            <ul class="ul-nav clearfix">
                <li class="nav-item"><a href="/">Главная</a></li>
                <li class="nav-item"><?= Html::a('Кузов', ['article/index', 'category' => 'car-body']) ?></li>
                <li class="nav-item"><?= Html::a('Двигатель', ['article/index', 'category' => 'engine']) ?></li>
                <li class="nav-item"><?= Html::a('АКП', ['article/index', 'category' => 'automatic-gearbox']) ?></li>

                <li class="nav-item root">
                    <a href="#">Эксперты<span></span></a>
                    <ul>
                        <li><?= Html::a('Владимир Дроздовский', ['expert/view', 'slug' => 'drozdovskiy']) ?></li>
                        <li><?= Html::a('Сергей Лосавио', ['expert/view', 'slug' => 'losavio']) ?></li>
                        <li><?= Html::a('Александр Хрулев', ['expert/view', 'slug' => 'hrulev']) ?></li>
                    </ul>
                </li>
                <li class="nav-item"><?= Html::a('Форумы', ['topic/index']) ?></li>
            </ul>
        </div>
    </div>
</div>