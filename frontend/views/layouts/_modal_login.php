<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use frontend\models\LoginForm;

Modal::begin([]);       
Modal::end();
?>

<!-- Modal -->
<div  id="modal-login" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="position: relative;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 style="margin-left: 20px;">Войти</h4>
            </div>

            <div class="modal-body" style="padding: 40px;">
                <div class="site-login">

                    <div class="row">
                        <div class="col-lg-10">
                            <?php 
                            $model = new LoginForm();
                            $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'action' => Url::toRoute(['person/login']),
                                ]); ?>
                                <?= $form->field($model, 'username') ?>
                                 <?= $form->field($model, 'password')->passwordInput() ?>
                                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                                <div style="color:#999;margin:1em 0">
                                    Если забыли пароль, <?= Html::a('обновите его', ['site/request-password-reset']) ?>.
                                </div>
                                <div class="form-group">
                                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
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
