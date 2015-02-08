<?php
use common\models\MainpageItem;

if($this->beginCache('sidebar_b', ['duration' => 300]))  { 

    $items = MainpageItem::listToMainpage();
    ?>

                <div class="block">
                    <?= $this->render('/layouts/_block_c2', [
                            'items' => $items, 
                            'title' => 'Популярное', 
                            'type'  => 'popular', 
                            'num'   => 6
                        ]); ?>
                </div><!-- .block -->  

                
                <div class="block">
                    <?= $this->render('/layouts/_block_dilers') ?>
                </div><!-- .block -->


                <div class="block">
                    <?= $this->render('/layouts/_block_forums') ?>
                </div><!-- .block -->

                
                <div class="block" style="margin-top: 0;">
                    <?= $this->render('/layouts/_block_c1', [
                            'items' => $items, 
                            'title' => 'Лента новостей', 
                            'type'  => 'news', 
                            'num'   => 4
                        ]); ?>
                </div><!-- .block -->  

<?php     
    $this->endCache(); 
} 
?>





               

          