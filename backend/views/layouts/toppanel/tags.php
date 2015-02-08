<?php
use yii\helpers\Html;

$actionName = Yii::$app->controller->action->id;
?>

                <header class="panel-heading custom-tab ">
                    <ul class="nav nav-tabs">
                        <li style="width: 30px;">&nbsp;</li>
                        <li class="active" id="tab-tags-index">
                            <?= Html::a('Тэги', 'tag/index') ?>
                        </li>
                        <li>
                            <?= Html::a('Добавить', '#', ['class' => 'activate-toggle-form']) ?>
                        </li>
                    </ul>
                </header>

