<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>

<!-- <h2 class="columntitle">Наши эксперты</h2> -->
<h2 class="thematic main-background" style="margin: 10px 0 20px 2px;">
    <span class="title">Наши эксперты</span>
    <span class="arrow  main-background"></span>
</h2>
<div class="clearfix"></div>

<div class="row">
    <div class="col-xs-3">
            <!-- <div class="main_thumb_box"> -->
        <div class="thumb_expert">
            <a href="<?= Url::toRoute(['expert/view', 'slug' => 'drozdovskiy']) ?>"><img src="/photo/author/100x100/drozdovsky-1.jpg"  class="circle"></a>
        </div>
    </div>
    <div class="col-xs-8">
        <div class="titles">
            <a href="<?= Url::toRoute(['expert/view', 'slug' => 'drozdovskiy']) ?>">Владимир Дроздовский, директор ООО «АТГ»</a>
        </div>
        <div class="desc expert"><a href="<?= Url::toRoute(['expert/view', 'slug' => 'drozdovskiy']) ?>">С 2007 года в МАДИ по договору с лабораторией по анализу разрушений и отказов деталей машин и механизмов в транспортно-дорожном комплексе занимается экспертной оценкой проблем связанных с работой автоматических трансмиссий.</a>
        </div>
    </div><!-- .col-md-8 -->
</div><!-- .row -->

<div class="row">
    <div class="col-xs-3">
            <!-- <div class="main_thumb_box"> -->
        <div class="thumb_expert">
            <a href="<?= Url::toRoute(['expert/view', 'slug' => 'losavio']) ?>"><img src="/photo/author/100x100/losavio-1.jpg"  class="circle"></a>
        </div>
    </div>
    <div class="col-xs-8">
        <div class="titles">
            <a href="<?= Url::toRoute(['expert/view', 'slug' => 'losavio']) ?>">Сергей Лосавио, Московский автомобильно-дорожный государственный технический университет</a>
        </div>
        <div class="desc expert"><a href="<?= Url::toRoute(['expert/view', 'slug' => 'losavio']) ?>">Экспертные специальности: "Автотехническая экспертиза", "Транспортно-трасологическая экспертиза", "Исследование технического состояния автотранспортных средств и строительной техники", "Исследование лакокрасочных материалов и покрытий транспортных средств".</a>
        </div>
    </div><!-- .col-md-8 -->
</div><!-- .row -->
    
<div class="row">
    <div class="col-xs-3">
            <!-- <div class="main_thumb_box"> -->
        <div class="thumb_expert">
            <a href="<?= Url::toRoute(['expert/view', 'slug' => 'hrulev']) ?>"><img src="/photo/author/100x100/hrulev-3.jpg" class="circle"></a>
        </div>
    </div>
    <div class="col-xs-8">
        <div class="titles">
            <a href="<?= Url::toRoute(['expert/view', 'slug' => 'hrulev']) ?>">Александр Хрулев, канд. техн. наук, директор фирмы «АБ-Инжиниринг»</a>
        </div>
        <div class="desc expert" style="border-bottom: 0px;"><a href="<?= Url::toRoute(['expert/view', 'slug' => 'hrulev']) ?>">Стаж работы по специальности "Двигатели внутреннего сгорания" – 29 лет, из них экспертом – 11 лет. Руководит цехом механической обработки деталей автомобильных двигателей Специализированного моторного центра "АБ-Инжиниринг", является начальником Бюро моторной экспертизы и гендиректором ООО «АБ-Эксперт».</a>
        </div>
    </div><!-- .col-md-8 -->
</div><!-- .row -->
                