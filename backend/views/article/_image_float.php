<?php

use yii\helpers\Html;
use common\models\ImageArticle;

$src = Yii::$app->params['baseFrontendUrl'] .'/photo/article/800/' .$image['src'];

$class  = ($image['layout'] == ImageArticle::LAYOUT_LEFT) ? 'float-left' : 'float-right';

echo '
<a name="image-' .$image['id'] .'"></a>
<figure class="' .$class .'">' .
    Html::img($src) .
    HTML::a('', ['image-article/delete', 'id' => $image['id']], ['class' => 'btn-image-delete confirm-delete']) .' 
   <figcaption><span data-id="' .$image['id'] .'">' .$image['caption'] ."</span></figcaption>
</figure>\n"; 



