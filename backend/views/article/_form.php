<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use common\models\Article;
use common\models\Author;
use common\models\Category;
use common\models\Image;


$attributesArray = ['category_id', 'author_id', 'state'];
foreach($attributesArray as $variable) {
  ${$variable} = (!empty($model->{$variable})) ? $model->{$variable} : 0;
}

$stateList = [1 => 'активный', 0 => 'не активный' ];
$mainCategoryId = ($model->isNewRecord) ? 0 : Category::findOne($model->category_id)['parent_id'];
$mainCategoryList = ArrayHelper::map(Category::find()->where(['parent_id' => 0])->all(), 'id', 'name');
$categoryList = ($mainCategoryId) ? 
    ArrayHelper::map(Category::find()->where(['parent_id' => $mainCategoryId])->all(), 'id', 'name') : [];
$authorList =  ArrayHelper::map(Author::find()->all(), 'id', 'lastname');
?>

<div class="row" style="max-width: 860px;">

    <?= (Yii::$app->session->hasFlash('success')) ? '<div id="notice" class="btn btn-primary">' .Yii::$app->session->getFlash('success') .'</div>' : ''; ?>
    
    <div class="col-lg-12">
        <?php $form = ActiveForm::begin([
                    'options' => ['enctype' => 'multipart/form-data'],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => false,
                ]); ?>

            <div class="row">
                <div class="col-md-8">
                    
                    <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                                <label>Раздел</label>
                            <?= Html::dropDownList('main_category_id', $mainCategoryId, $mainCategoryList, ['prompt'=>'--Выберите--', 'id' => 'select-main_category_id', 'class' => 'stylerize']);  ?>
                            </div>
                            <div id="wrap-select-category_id" style="margin-top: -10px;">
                                <?= $form->field($model, 'category_id')->dropDownList($categoryList, ['id' => 'select-category_id', 'class' => 'stylerize']); ?> 
                            </div>
                        </div>

                        <div class="col-md-6">
                            <?= $form->field($model, 'author_id')->dropDownList($authorList, ['prompt'=>'--Выберите--', 'class' => 'stylerize']); ?>
                            <div style="margin-top: -10px;">
                                <?= $form->field($model, 'state')->dropDownList($stateList, ['class' => 'stylerize']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'title')->textInput(['id' => 'input-title', 'style' => 'font: bold 16px Arial,sans-serif; color: #555;']) ?>
                        </div>
                    </div>
                </div><!-- end col-md-8 -->

                <div class="col-md-4">
                    <?= $form->field($model, 'slug')->textInput(['placeholder' => 'Псевдоним', 'id' => 'input-slug']) ?>
                    <div class="clearfix"></div>
                    <?php
                    if(!empty($model->image_src)) {
                         echo '
                    <div class="form-group" style="margin-top: -10px; margin-bottom: 0;">
                        <label>Фото</label>
                        <div id="single-image">' .
                         Html::img(Yii::$app->params['baseFrontendUrl'] .'/photo/article/300x170/'.$model->image_src) .
                         HTML::a('', ['article/image-delete', 'id' => $model->id], ['class' => 'btn-image-delete confirm-delete']) .
                        '</div>
                    </div>';
                    } else {
                        echo
                        '<div style="margin-top: -10px;">' .
                         $form->field($model, 'file')->fileInput(['class' => 'stylerize'])
                         .'</div>';
                    }
                    ?>
                </div>
            </div><!-- row -->


            <label id="toggle-brief" class="label-dotted">Кратко</label>
            <label id="toggle-tags" class="label-dotted" data-toggle="modal" href="#myModal">Тэги</label>           
            <label id="toggle-meta" class="label-dotted">Мета</label>
            <label id="toggle-source" class="label-dotted">Источник</label>

            <div id="wrap-brief" class="label-hidden-zz" style="display: none; padding: 20px 0;">
                <?= $form->field($model, 'brief')->textArea(['style' => 'height: 100px;']); ?>
            </div>

            <div id="wrap-meta" style="display: none; padding: 20px 0;">
                <?= $form->field($model, 'metakey')->textArea(['style' => 'height: 50px;']); ?>
                <?= $form->field($model, 'metadesc')->textArea(['style' => 'height: 60px;']); ?>
            </div>

            <div id="wrap-source" style="display: none; padding: 20px 0;">
                <?= $form->field($model, 'source_name'); ?>
                <?= $form->field($model, 'source_link'); ?>
            </div>

            <div class="wrap-input-content label-hidden" style="margin: 8px 0 0 0;">
            <?= $form->field($model, 'content')->textArea()->widget(yii\imperavi\Widget::className(), [
                    'plugins' => ['table'],
                    'options' => [
                        'minHeight' =>  480,
                        'maxHeight' =>  480,
                        'linebreaks' => true,
                        // 'removeEmptyTags' => true,
                        // 'allowedTags' => array('p', 'h2', 'h3', 'h4', 'div', 'strong', 'br'),
                        'buttons' => ['html','formatting',  'bold', 'italic', 'h4', 'unorderedlist', 'orderedlist', 'link', 'alignment', 'horizontalrule', 'table', 'html'],
                        'formatting' => ['p', 'h3'],
                    ],
                ]);
            ?>
            </div>

            <?= $this->render('_modal_tags', [
                    'taggings' => $taggings,
                    'unusedTags'  => $unusedTags,
            ]); ?>

            <div class="form-group" style="margin: 20px 0 0 0;">
                <?= Html::a('Отмена', \common\models\Utilities::backUrl(), ['class' => 'btn btn-default', 'style' => 'margin-right: 14px;']) ?>
                <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
            </div>
            
        <?php ActiveForm::end(); ?>
    </div><!-- /col-lg-10 -->
</div><!-- /row -->



