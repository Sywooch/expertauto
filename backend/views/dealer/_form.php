<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\City;
?>

<div class="row" style="margin-top: 20px; max-width: 800px;">

    <?= (Yii::$app->session->hasFlash('success')) ? '<div id="notice" class="btn btn-primary">' .Yii::$app->session->getFlash('success') .'</div>' : ''; ?>
    
    <div class="col-lg-6">

    <?php $form = ActiveForm::begin([
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ]); ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?php
    $cityList = ArrayHelper::map(City::find()->orderBy('pos')->all(), 'id', 'name');
    ?>
    <?= $form->field($model, 'city_id')->dropDownList($cityList); ?> 

    <div class="form-group" style="margin-top: 40px;">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>
