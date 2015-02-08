<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use frontend\models\SignupForm;
use yii\captcha\Captcha;

Modal::begin([]);       
Modal::end();
?>

<!-- Modal -->
<div  id="modal-signup" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="position: relative;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 style="margin-left: 20px;">Регистрация</h4>
            </div>

            <div class="modal-body" style="padding: 40px;">
                <div class="site-login">

                    <div class="row">
                        <div class="col-lg-10">
                            <?php 
                            $model = new SignupForm();
                            $form = ActiveForm::begin([
                                'id' => 'signup-form',
                                'action' => Url::toRoute(['person/signup']),
                                // 'enableAjaxValidation' => false,
                                // 'enableClientValidation' => false,
                                ]); ?>
                                <?= $form->field($model, 'username') ?>
                                <?= $form->field($model, 'email') ?>
                                <?= $form->field($model, 'password')->passwordInput() ?>
                                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                    'captchaAction' => '/person/captcha',
                                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                                ]) ?>
                                <div class="form-group">
                                    <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>


            </div><!-- .modal-body -->
        </div>
    </div>
</div>
<!-- modal -->
