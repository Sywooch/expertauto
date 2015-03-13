            <h2 class="thematic main-background" style="margin: 10px 0 10px 2px;">
                <span class="title">Тема дня</span>
                <span class="arrow  main-background"></span>
            </h2>
            <div class="clearfix"></div>

            <div class="block">
                <?= $this->render('_block_b1', [
                        'items' => $items, 
                        // 'title' => 'Тема дня', 
                        'type'  => 'topic-day', 
                        'num'   => 4
                    ]); ?>
            </div><!-- .block -->  

            <h2 class="thematic main-background" style="margin: 20px 0 10px 2px;">
                <span class="title">Тяжелый случай</span>
                <span class="arrow  main-background"></span>
            </h2>
            <div class="clearfix"></div>

            <div class="block">
                <?= $this->render('_block_b1', [
                        'items' => $items, 
                        // 'title' => 'Тяжелый случай', 
                        'type'  => 'hard-case', 
                        'num'   => 3
                    ]); ?>
            </div><!-- .block --> 
       
