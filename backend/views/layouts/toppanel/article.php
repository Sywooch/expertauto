<?php
use yii\helpers\Html;
use common\models\Utilities;

$actionName = Yii::$app->controller->action->id;
$articleId =  Yii::$app->request->get('id');
$editUrl = ($articleId) ? ['article/update', 'id' => $articleId] : '#';
?>

                <header class="panel-heading custom-tab ">
                    <ul class="nav nav-tabs">
                        <li class="">
                            <?= Html::a('Назад', Utilities::backUrl(), ['data-toggle' => '']) ?>
                        </li>
                        <li class="<?= (in_array($actionName, ['update', 'create']))? 'active' : '' ?>">
                            <?= Html::a('Текст', $editUrl, ['data-toggle' => '']) ?>
                        </li>
                        <?php if($articleId) : ?>
                        <li class="<?= ($actionName == 'media') ? 'active' : '' ?>">
                            <?= Html::a('Фото', ['article/media', 'id' => $articleId], ['data-toggle' => '']) ?>
                        </li>
                        <?php endif  ?>
                    </ul>
                </header>

       