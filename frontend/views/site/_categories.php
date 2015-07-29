<?php

use yii\helpers\Html;
use common\models\Tag;

$tags = Tag::find()
    ->innerJoin('tagging', 'tagging.tag_id = tag.id')
    ->innerJoin('article', 'article.id = tagging.article_id AND article.state = 1')
    ->orderBy('tag.name')->all();
?>                

<div class="box-common">
    <div class="box-header"><span>Разделы</span></div>
    <ul class="category-list">
    <?php
    foreach ($tags as $tag) { ?>
        <li><?= Html::a($tag->name, ['article/index', 'tag' => $tag->slug]) ?></li>
    <?php } ?>
    </ul>
</div> 