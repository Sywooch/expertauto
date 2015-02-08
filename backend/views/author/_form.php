<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Author;

/* @var $this yii\web\View */
/* @var $model common\models\Author */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row" style="margin-top: 20px; max-width: 800px;">

    <?= (Yii::$app->session->hasFlash('success')) ? '<div id="notice" class="btn btn-primary">' .Yii::$app->session->getFlash('success') .'</div>' : ''; ?>
    
    <div class="col-lg-10 col-lg-offset-1">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'firstname')->textInput() ?>
    <?= $form->field($model, 'lastname')->textInput(['id' => 'input-lastname', 'maxlength' => 255]) ?>
    <?= $form->field($model, 'job')->textInput() ?>
    <?php
    $typeList = [];
    foreach(Author::getTypeName() as $k => $val) { $typeList[$k] = $val; }
    echo $form->field($model, 'type')->dropDownList($typeList);   
    ?>

    <?= $form->field($model, 'slug')->textInput(['id' => 'input-slug']) ?>
    <?= $form->field($model, 'about')->textArea(['style' => 'height: 300px;']) ?>
    <?php // echo $form->field($model, 'image_src')->textInput() ?>

    <div class="form-group" style="margin-top: 40px;">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>
