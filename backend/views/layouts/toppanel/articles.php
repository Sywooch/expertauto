<?php
use yii\helpers\Html;

$isSearch =  Yii::$app->request->get('search');
?>

                <header class="panel-heading custom-tab ">
                    <ul class="nav nav-tabs">
                        <li style="width: 30px;">&nbsp;</li>
                        <li class="<?= $isSearch ? '' : 'active' ?>" id="tab-article-index">
                            <?= Html::a('Список статей', 'article/index', ['data-toggle' => '']) ?>
                        </li>
                        <li class="<?= $isSearch ? 'active' : '' ?>">
                            <?= Html::a('Поиск', '#', ['class' => 'activate-toggle-form']) ?>
                        </li>
                        <li>
                            <?= Html::a('Добавить', 'article/update') ?>
                        </li>
                    </ul>
                </header>

