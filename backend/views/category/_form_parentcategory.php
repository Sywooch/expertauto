<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;

?>
  
  <tr class="raw-subcategory">
    <td colspan="5">

        <?php 
        $form = ActiveForm::begin([
                        'options' => ['class' => 'form-inline help-block-compact'],
                        'action' => '/category/create',
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => false
                    ]); 
  
            echo $form->field($model, 'name')->textInput(['placeholder' => '', 'style' => 'width: 350px; margin: 6px 10px 6px 0px;']);
            echo $form->field($model, 'parent_id')->hiddenInput(['value' => 0]);

            echo Html::submitButton('Добавить раздел', ['class' => 'btn btn-primary']);

        ActiveForm::end();
        ?>
    </td>
  </tr>