<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ForumPost;

$topicId = (Yii::$app->request->get('id')) ? Yii::$app->request->get('id') : 0;
?>
  
  <div style="margin: 20px 0 20px 40px;">
      <a href="#" class="activate-toggle-form btn btn-primary btn-xs">Ответить</a>
  </div>  


  <div class="toggle-form" style="margin: 20px 20px 40px 40px; padding: 20px; background: #eee;">
        <?php 
        $model = new ForumPost();
        $form = ActiveForm::begin([
                        'options' => ['id' => 'forum-post-create'],
                        'action' => '/post/create',
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => false
                    ]); 
       ?>     
            <div id="wrap-input-quote">
              <?= $form->field($model, 'quote_text')->textArea(['style' => 'height: 90px;']); ?>
            </div>
            
            <?= $form->field($model, 'content')->textArea(); ?>
            <input type="hidden" value="<?= $topicId ?>" name="ForumPost[topic_id]">
            <input type="hidden" id="forumpost-quote_id"  value="0" name="ForumPost[quote_id]">

            
            <?= Html::a('Отмена', '#', ['class' => 'btn btn-default activate-toggle-form', 'style' => 'margin-right: 14px;']) ?>
            <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary']);
        ActiveForm::end(); ?>

  </div>