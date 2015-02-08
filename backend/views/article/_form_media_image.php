<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\ImageArticle;
use common\models\Article;
?>

<div id="wrap-image-form" class="media-form bigsize_file_input">
  <div class="nosik"></div>

<?php 
$model = new ImageArticle;
$form = ActiveForm::begin([
                'action' => '/image-article/create',
                'enableAjaxValidation'   => false,
                'enableClientValidation' => false,
                'options' => [
                                'enctype'=>  'multipart/form-data',
                                'name'   =>  'form_photo',  
                              ],  
                ]); 
?>
    
    <input type="file" name="ImageArticle[file]">

    <textarea name="ImageArticle[caption]" id="'photo-textarea-subscribe'" placeholder="подпись"><?= $model->caption ?></textarea>
    
    <div style="margin: 9px 0 10px 0;">
        <input type="radio" name="ImageArticle[layout]" checked value="<?= ImageArticle::LAYOUT_BOTTOM ?>" style="margin: 0 2px 0 6px;" />
        <label>внизу</label> 
        <input type="radio" name="ImageArticle[layout]" value="<?= ImageArticle::LAYOUT_LEFT ?>" style="margin: 0 2px 0 0;" />
        <label>слева</label>
        <input type="radio" name="ImageArticle[layout]" value="<?= ImageArticle::LAYOUT_RIGHT ?>" />
        <label>справа</label>
    </div>

    <input type="hidden" name="ImageArticle[article_id]" value="<?= $article->id ?>" />
    <input type="hidden" name="ImageArticle[pos]" id="image-input-pos" value="0" />

    <div style="margin: 4px 0 0 0;">
        <a class="btn btn-primary  btn-sm btn-cancel">Отмена</a>
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-primary  btn-sm', 'id' => 'image-btn-submit'] ) ?>
    </div> 
<?php ActiveForm::end(); ?>       

</div><!-- divFormPhoto -->