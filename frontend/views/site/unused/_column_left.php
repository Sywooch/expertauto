            
        <!-- SLIDER -->
        <div id="slider_box">
            <?= $this->render('_slider', ['items' => $items]); ?>
        </div><!-- #slider_box -->

        <div>
            <?= $this->render('_block_a1', [
                   'items' => $items, 
                   'title' => 'Двигатель', 
                   'type'  => 'engine', 
                   'num'   => 2
               ]); ?>
            
            <?= $this->render('_block_a1', [
                    'items' => $items, 
                    'title' => 'АКП', 
                    'type'  => 'gearbox', 
                    'num'   => 2
                ]); ?>

            <?= $this->render('_block_a1', [
                    'items' => $items, 
                    'title' => 'Кузов', 
                    'type'  => 'car-body', 
                    'num'   => 2
                ]); ?>
            
            <div class="block">
                <?= $this->render('_experts') ?>
            </div><!-- .block -->

        </div>
