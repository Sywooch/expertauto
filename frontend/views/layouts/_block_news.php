<?php
    use yii\helpers\Html;
    use common\models\MainpageItem;
?>  

<div class="box-common">
    <div class="box-title" style="margin-bottom: 20px;"><span><?= $title ?></span></div>
    <ul class="news-list">
    <?php
        foreach($items as $item) {
            $link = ['article/view', 'category_slug' => $item['category_slug'], 'slug' => $item['slug']]; ?>
            <li><?= Html::a($item['title'], $link); ?></li>
            <?php
        }
        ?>
    </ul>
</div>