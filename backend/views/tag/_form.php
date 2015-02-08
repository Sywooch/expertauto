<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
  
  <div class="toggle-form">
        <?php 
        $form = ActiveForm::begin([
                        'options' => ['class' => 'form-inline help-block-compact'],
                        'action' => '/tag/create',
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => false
                    ]); 
  
            echo $form->field($model, 'name')->textInput(['style' => 'width: 350px; margin: 6px 10px 6px 0px;']);
            echo Html::submitButton('Добавить', ['class' => 'btn btn-primary']);

        ActiveForm::end();
        ?>
  </div>