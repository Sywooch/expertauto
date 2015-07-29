<?php
$this->title = 'АвтоЭкспертиза';
?>
            <!-- main content -->
            <div class="col-md-7 col-md-push-2 col-xs-12 main-content">
                <!-- slider -->
                <!-- <div id="slider_box">
                    <?php // $this->render('_slider', ['items' => $items]); ?>
                </div> -->

                <div>
                    <?php
                    echo $this->render('_block_a2', [
                           'items' => $items, 
                           'title' => 'Двигатель', 
                           'type'  => 'engine', 
                           'num'   => 4
                       ]); 
                    echo $this->render('_block_a2', [
                            'items' => $items, 
                            'title' => 'АКП', 
                            'type'  => 'gearbox', 
                            'num'   => 4
                        ]);
                    echo $this->render('_block_a2', [
                            'items' => $items, 
                            'title' => 'Кузов', 
                            'type'  => 'car-body', 
                            'num'   => 4
                        ]); 
                    echo  $this->render('_experts');
                    ?>
                </div>
            </div><!-- /main content -->

            <!-- left sidebar -->
            <div class="col-md-2 col-md-pull-7 col-xs-6 sidebar">
                <?php
                echo $this->render('_categories');
                echo $this->render('_block_b1', [
                    'items' => $items, 
                    'title' => 'Тема дня', 
                    'type'  => 'topic-day', 
                    'num'   => 4
                ]); 
                ?>
            </div><!-- /left sidebar -->
            
            <!-- right sidebar -->
            <div class="col-md-3 col-xs-6 sidebar" style="margin-top: 14px;">
                <?php
                echo $this->render('/layouts/_block_c1', [
                    'items' => $items,
                    'title' => 'Лента новостей',
                    'type'  => 'news',
                    'num'   => 4
                ]);
                echo $this->render('/layouts/_block_adv');
                echo $this->render('/layouts/_block_c2', [
                    'items' => $items,
                    'title' => 'Популярное',
                    'type'  => 'popular',
                    'num'   => 10
                ]); 
                
                echo $this->render('/layouts/_block_dilers');
                echo $this->render('/layouts/_block_forums');
                ?>
            </div><!-- /right sidebar -->

