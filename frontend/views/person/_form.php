<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Person;

?>

<div class="row" style="margin-top: 20px; max-width: 800px;">

    <div class="col-lg-10 col-lg-offset-1">
        <h2 style="margin: 20px 0 60px 0; background: #f0f0f0; padding: 10px 10px 10px 20px; font: bold 19px 'roboto slab',sans-serif; text-transform: uppercase;">Изменить личные данные</h2>

        <?php $form = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data'],
            // 'enableAjaxValidation' => false,
            // 'enableClientValidation' => false,
        ]); ?>

        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'nickname')->textInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>

        <?php
        if(!empty($model->avatar_src)) {
        echo '
            <div class="form-group">
                <label>Аватар</label>
                <div id="file-avatar-image">' .
                 Html::img('/photo/avatar/'.$model->avatar_src) .
                 HTML::a('', ['person/image-delete', 'id' => $model->id], ['class' => 'btn-image-delete confirm-delete']) .
                '</div>
            </div>';
        } else {
            echo $form->field($model, 'file')->fileInput();
        }
        ?>

        <div class="form-group" style="margin-top: 40px;">
            <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
