<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

?>
  
  <tr class="row-category">
    <td></td>
    <td colspan="4">
        <?php 
        $form = ActiveForm::begin([
                        'options' => ['class' => 'form-inline help-block-compact'],
                        'action' => '/category/create',
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => false
                    ]); 
  
            echo $form->field($model, 'name')->textInput(['placeholder' => '', 'style' => 'width: 350px; margin: 6px 10px 6px 0px;']);
            echo $form->field($model, 'parent_id')->hiddenInput(['value' => $item['parent_id']]);

            echo Html::submitButton('Добавить рубрику', ['class' => 'btn btn-primary btn-smd']);

        ActiveForm::end();
        ?>
    </td>
  </tr>