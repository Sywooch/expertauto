<?php
$this->title = 'АвтоЭкспертиза';
?>

    <div id="mainpage-content">

        <!-- MAINPAGE MAIN -->
        <div id="mainpage-main">
            <?= $this->render('_column_left', ['items' => $items]); ?>

            <div style="display: none;">
                <?php // echo yii\authclient\widgets\AuthChoice::widget(['baseAuthUrl' => ['site/auth'], 'popupMode' => true,]) ?>
                <li class="auth-client">
                    <!-- <a href="/site/auth?authclient=vkontakte" class="auth-link vkontakte"> -->
                    <a href="/site/auth/?authclient=vkontakte" class="auth-link vkontakte"><span class="auth-icon vkontakte"></span><span class="auth-title">VKontakte</span></a>
                </li>
            </div>
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