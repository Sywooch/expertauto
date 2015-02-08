<?php
use yii\helpers\Html;
use common\models\ImageArticle;

$dir = '/photo/article';

foreach($images as $image) {
    
    $src = $dir .'/800/' .$image['src'];

    echo '
    <figure class="full-width">'
            .Html::img($src, ['alt' => $image['caption']]);

    if(!empty($image['caption'])) {
        echo '
        <figcaption>' .$image['caption'] .'</figcaption>';
    }
    echo "</figure>\n"; 

}  
?>
               

