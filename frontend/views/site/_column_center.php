            <div class="block">
                <?= $this->render('_block_b1', [
                        'items' => $items, 
                        'title' => 'Тема дня', 
                        'type'  => 'topic-day', 
                        'num'   => 4
                    ]); ?>
            </div><!-- .block -->  

            <div class="block">
                <?= $this->render('_block_b1', [
                        'items' => $items, 
                        'title' => 'Тяжелый случай', 
                        'type'  => 'hard-case', 
                        'num'   => 3
                    ]); ?>
            </div><!-- .block --> 
       
