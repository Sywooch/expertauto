            
        <!-- SLIDER -->
        <div id="slider_box">
            <?= $this->render('_slider', ['items' => $items]); ?>
        </div><!-- #slider_box -->

        <div>
            <div class="block">
                <?= $this->render('_block_a1', [
                        'items' => $items, 
                        'title' => 'Кузов', 
                        'type'  => 'car-body', 
                        'num'   => 2
                    ]); ?>
            </div><!-- .block -->  

            <div class="block">
                <?= $this->render('_block_a1', [
                        'items' => $items, 
                        'title' => 'АКП', 
                        'type'  => 'gearbox', 
                        'num'   => 2
                    ]); ?>
            </div><!-- .block -->  

            <div class="block">
                <?= $this->render('_experts') ?>
            </div><!-- .block -->


            <!-- <div class="block"> -->
                <?php // echo $this->render('_block_a1', [
                      //  'items' => $items, 
                      //  'title' => 'Двигатель', 
                      //  'type'  => 'engine', 
                      //  'num'   => 4
                   // ]); 
                    ?>
            <!-- </div> -->
        </div>
