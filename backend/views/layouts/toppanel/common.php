<?php
use yii\helpers\Html;
use common\models\Utilities;
?>
                <header class="panel-heading custom-tab ">
                    <ul class="nav nav-tabs">
                        <li class="">
                            <?= Html::a('Назад', Utilities::backUrl()) ?>
                        </li>
                        <li class="active">
                            <a href="#"><?= $title ?></a>
                        </li>
                    </ul>
                </header>

       