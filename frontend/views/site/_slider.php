<?php
    use yii\helpers\Html;
?>

<ul class="bxslider">
<?php
foreach($items as $k => $item) {
    if($item['type'] == 'slideshow') {

        $imageFile = Yii::getAlias('@public') .'/photo/article/800/' .$item['image_src'];

        if(is_file($imageFile)) {
            $sizes  = @getimagesize($imageFile);
            $w = $sizes[0];  
            $h = $sizes[1];
            $ratio = 545 / 800; 
            $newH = $h * $ratio;

            $link = ['article/view', 'slug' => $item['slug']];
            $img = Html::img('photo/article/800/' .$item['image_src'], ['title' => $item['title'], 'style' => 'height: ' .$newH .'px;'] ); ?>
            
            <li>
                <?= Html::a($img, $link); ?>
            </li>
<?php
        }
    }
} 
?>     
</ul>
