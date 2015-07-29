<?php
use yii\helpers\Html;
?>



<?= $this->render('/layouts/_block_c1', [
        'items' => $items,
        'title' => 'Лента новостей',
        'type'  => 'news',
        'num'   => 4
    ]); 
?>

<?= $this->render('/layouts/_block_adv') ?>

<?= $this->render('/layouts/_block_c2', [
        'items' => $items,
        'title' => 'Популярное',
        'type'  => 'popular',
        'num'   => 10
    ]); 
?>

<?= $this->render('/layouts/_block_dilers') ?>
    
<?= $this->render('/layouts/_block_forums') ?>

