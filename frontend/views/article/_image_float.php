<?php

use yii\helpers\Html;
use common\models\ImageArticle;

// $src  = '/photo/article/300x170/' .$image['src'];
$src  = '/photo/article/800/' .$image['src'];

$class  = ($image['layout'] == ImageArticle::LAYOUT_LEFT) ? 'float-left' : 'float-right';

echo '
<figure class="' .$class .'">'
        .Html::img($src, ['alt' => $image['caption']]);

if(!empty($image['caption'])) {
    echo '
    <figcaption>' .$image['caption'] .'</figcaption>';
}
echo "</figure>\n"; 



