<?php
use yii\helpers\Html;
?>               
            <a href="/"><div id="logo"></div></a>
            <div id="header-title">
                <nav id="menu_desktop">
                    <ul>
                        <li class="root">
                            <a href="/">Главная</a>
                        </li>
                        <li class="root">
                            <a href="#">Экспертиза<span></span></a>
                            <ul>
                                <li><?= Html::a('Кузов', ['article/index', 'category' => 'car-body']) ?></li>
                                <li><?= Html::a('Двигатель', ['article/index', 'category' => 'engine']) ?></li>
                                <li><?= Html::a('АКП', ['article/index', 'category' => 'automatic-gearbox']) ?></li>
                                <li><?= Html::a('Электрика', ['article/index', 'category' => 'electric']) ?></li>
                            </ul>
                        </li>
                        <li class="root">
                            <a href="#">Нормативы</a>
                        </li>
                        <li class="root">
                            <a href="#">Эксперты<span></span></a>
                            <ul>
                                <li><?= Html::a('Владимир Дроздовский', ['expert/view', 'slug' => 'drozdovskiy']) ?></li>
                                <li><?= Html::a('Сергей Лосавио', ['expert/view', 'slug' => 'losavio']) ?></li>
                                <li><?= Html::a('Александр Хрулев', ['expert/view', 'slug' => 'hrulev']) ?></li>
                            </ul>
                        </li>
                        <li class="root">
                            <?= Html::a('Форумы', ['topic/index']) ?>
                        </li>
                        <li class="root">
                            <?= Html::a('Рейтинг', ['opinion/index']) ?>
                        </li>

                        <li class="root">
                            <a href="#">Профиль<span></span></a>
                            <ul>

                                <?php 
                                if(Yii::$app->user->isGuest) {
                                    echo '<li>' .Html::a('Войти', ['#modal-login'], ['data-toggle' => 'modal']) .'</li>';
                                    echo '<li>' .Html::a('Регистрация', ['#modal-signup'], ['data-toggle' => 'modal']) .'</li>';
                                }   else {
                                    echo '<li>' .Html::a( Yii::$app->user->identity->username , ['person/update', 'id' => Yii::$app->user->id]) .'</li>
                                    <li>' .Html::a('выход' , ['person/logout'], ['data-method' => 'post']) .'</li>';
                                }
                                ?>
                            </ul>
                        </li>

                    </ul>
                </nav>

                
            </div>
