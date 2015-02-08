<?php
use yii\helpers\Html;
?>

                <header class="panel-heading custom-tab ">
                    <ul class="nav nav-tabs">
                        <li style="width: 30px;">&nbsp;</li>
                        <li class="active">
                            <?= Html::a($title, "/$modelName/index") ?>
                        </li>
                        <li>
                            <?= Html::a('Добавить', "/$modelName/update") ?>
                        </li>
                    </ul>
                </header>

