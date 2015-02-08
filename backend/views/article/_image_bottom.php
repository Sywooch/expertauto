<?php
use yii\helpers\Html;
use common\models\ImageArticle;

$dir = Yii::$app->params['baseFrontendUrl'] .'/photo/article/800/'; 

foreach($images as $image) {
    
    echo '
    <a name="image-' .$image['id'] .'"></a>
    <figure class="full-width">' .
        Html::img($dir .$image['src']) .
        HTML::a('', ['image-article/delete', 'id' => $image['id']], ['class' => 'btn-image-delete confirm-delete']) .' 
        <figcaption><span data-id="' .$image['id'] .'">' .$image['caption'] ."</span></figcaption>
    </figure>\n"; 
}  
?>
               

