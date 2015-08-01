<?php
use common\models\MainpageItem;

if($this->beginCache('sidebar_b', ['duration' => 10]))  { 

    $items = MainpageItem::listToMainpage();
    
    echo $this->render('/layouts/_block_c2', [
            'items' => $items,
            'title' => 'Популярное',
            'type'  => 'popular',
            'num'   => 6
        ]);

    echo  $this->render('/layouts/_block_dilers') ?>

    <?= $this->render('/layouts/_block_c1', [
            'items' => $items,
            'title' => 'Лента новостей',
            'type'  => 'news',
            'num'   => 4
        ]); ?>
<?php
    $this->endCache();
}
?>





               

          