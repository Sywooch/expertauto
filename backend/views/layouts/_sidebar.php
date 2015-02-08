<?php
use yii\helpers\Html;
use common\models\Mainpage;


$liClass = 'li-' .Yii::$app->controller->id .'-' .Yii::$app->controller->action->id;
?>
        
        <div id="alt-toggle-btn" class="fa"></div>

        <!--logo and iconic logo start-->
        <div class="logo">
            <a href="index.html"><img src="/images/logo.png" alt=""></a>
        </div>

        <div class="logo-icon text-center">
            <a href="index.html"><img src="/images/logo_icon.png" alt=""></a>
        </div>
        <!--logo and iconic logo end-->


        <div class="left-side-inner">

            <!-- visible to small devices only -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media logged-user">
                    <img alt="" src="" class="media-object">
                    <div class="media-body">
                        <h4><a href="#">Админ</a></h4>
                        <span>Приветствие</span>
                    </div>
                </div>

                <h5 class="left-nav-title">Аккаунт</h5>
                <ul class="nav nav-pills nav-stacked custom-nav">
                    <li><a href="#"><i class="fa fa-user"></i> <span>Профиль</span></a></li>
                    <li><a href="#"><i class="fa fa-cog"></i> <span>Настройки</span></a></li>
                    <li><a href="#"><i class="fa fa-sign-out"></i> <span>Выход</span></a></li>
                </ul>
            </div>

            <!--sidebar nav start-->
            <ul class="nav nav-pills nav-stacked custom-nav">
                
                <li style="margin-top: 40px;"><?= HTML::a('<i class="fa fa-home"></i> <span>Главная</span>', ['article/index']) ?></li>

                <li class="menu-list"><a href=""><i class="fa fa-book"></i><span>Статьи</span></a>
                    <ul class="sub-menu-list">
                        <li class="li-article-index"><?= HTML::a(' Список', ['article/index']) ?></li>
                        <li class="li-article-update li-article-create li-article-media"><?= HTML::a(' Добавить',  ['article/update']) ?></li>
                    </ul>
                </li>

                <li class="li-category-index"><?= HTML::a('<i class="fa fa-tasks"></i><span>Рубрики</span>', array('category/index')) ?></li>
                
                <li class="li-tag-index"><?= HTML::a('<i class="fa fa-tag"></i><span>Тэги</span>', array('tag/index')) ?></li>

                <li class="li-author-index"><?= HTML::a('<i class="fa fa-user"></i><span>Авторы</span>', array('author/index')) ?></li>
                <li class="li-dealer-index"><?= HTML::a('<i class="fa fa-truck"></i><span>Дилеры</span>', array('dealer/index')) ?></li>


                <li class="menu-list"><a href=""><i class="fa fa-file-text"></i> <span>Первая стр.</span></a>
                    <ul class="sub-menu-list">
                    <?php 
                    $items = Mainpage::find()->orderBy('name')->all();
                    foreach($items as $item) { 
                        echo '
                        <li class="li-mainpage-item-index">' .
                            HTML::a($item->name, ['mainpage-item/index', 'slug' => $item->slug]) ."
                        </li>\n";
                    }
                    ?>
                    </ul>
                </li>

                <li class="menu-list"><a href=""><i class="fa fa-cog"></i> <span>Настройки</span></a>
                    <ul class="sub-menu-list">
                        <li><a href="#">Общие</a></li>
                    </ul>
                </li>

                <li style="margin-top: 30px;"><?= HTML::a('<i class="fa fa-sign-in"></i><span>Выход</span>', array('site/logout')) ?></li>

            </ul>
            <!--sidebar nav end-->

        </div>
  