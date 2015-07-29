<?php
$this->title = 'АвтоЭкспертиза';
?>

    <div id="mainpage-content">

        <!-- MAINPAGE MAIN -->
        <div id="mainpage-main">
            <?= $this->render('_column_left', ['items' => $items]); ?>
        </div><!-- end #mainpage-main -->

        <!-- MAINPAGE RIGHT -->
        <div id="mainpage-right">
            <?= $this->render('_column_center', ['items' => $items]); ?>
        </div><!-- end #mainpage-right -->

        <!-- SIDEBAR -->
        <div class="sidebar sidebar-mainpage">
            <?= $this->render('_column_right', ['items' => $items]); ?>
        </div><!-- end #sidebar -->

    <div class="clearfix"></div>
    </div><!-- end #mainpage-content -->