<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;



$form = ActiveForm::begin([
                'options' => ['class' => 'form-signin'],
                'id' => 'login-form', 
                'enableAjaxValidation' => false,
                'enableClientValidation' => false,
                ]); ?>

    <div class="form-signin-heading text-center">
        <h1 class="sign-title">Вход</h1>
        <!-- <img src="images/login-logo.png" alt=""/> -->
    </div>

    <div class="login-wrap">

        <?= $form->field($model, 'username')->textInput(['placeholder' => 'логин', 'class' => 'form-control'])->label('') ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'пароль', 'class' => 'form-control'])->label('') ?>
        <div class="form-group">
            <?= Html::submitButton('<i class="fa fa-check"></i>', ['class' => 'btn btn-lg btn-login btn-block', 'name' => 'login-button']) ?>
        </div>

    </div>
<?php ActiveForm::end();
