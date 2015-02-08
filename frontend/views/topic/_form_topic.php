<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ForumTopic;


$parentId = (Yii::$app->request->get('id')) ? Yii::$app->request->get('id') : 0;

$isCategoryList = [0 => 'тема', 1 => 'раздел' ];
?>
  
  <div style="margin: 20px 0 20px 10px;">
      <a href="#" class="activate-toggle-form decoration-none">Добавить тему / раздел</a>
  </div>  

  <div class="toggle-form" style="margin: 20px 20px 40px 0; padding: 20px; background: #eee;">
        <?php 
        $model = new ForumTopic();
        $form = ActiveForm::begin([
                        'options' => ['class' => ''],
                        'action' => '/topic/create',
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => false
                    ]); 
  
            echo $form->field($model, 'title')->textInput(['style' => 'width: 450px; margin: 6px 10px 6px 0px;']);

            echo $form->field($model, 'is_category')->dropDownList($isCategoryList, ['class' => 'stylerize']); 
            // echo $form->field($model, 'is_category')->checkbox(['style' => '']);
            echo $form->field($model, 'parent_id')->hiddenInput(['value' => $parentId]);

            echo Html::submitButton('Добавить', ['class' => 'btn btn-primary']);

        ActiveForm::end();
        ?>

  </div>