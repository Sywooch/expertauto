<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use common\models\Opinion;
use common\models\City;
use common\models\Dealer;

// use yii\captcha\Captcha;



Modal::begin([]);       
Modal::end();
?>
<!-- Modal -->
<div  id="modal-opinion" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body" style="padding: 40px;">
                <button type="button" class="close" data-dismiss="modal" style="margin: -30px -20px 0 0; font-size: 28px;">&times;</button>
                <div class="opinion-form">
                    <div class="row">
                        <div class="col-md-11">
                            <?php
                            $model = new Opinion();
                            $form = ActiveForm::begin([
                                // 'id' => 'opinion-form',
                                'action' => Url::toRoute(['opinion/create']),
                                // 'enableAjaxValidation' => false,
                                // 'enableClientValidation' => false,
                                ]); 
                                ?>
                            <div class="row cascade-city-dealer" style="margin-bottom: 40px;">

                                <div class="col-md-6">
                                    <label>Город:</label>
                                    <?php
                                    $cityList = ArrayHelper::map(City::find()->orderBy('pos')->all(), 'id', 'name');
                                    echo Html::dropDownList('city_id', 0, $cityList, ['prompt'=>'--Город--', 'id' => 'city_id', 'class' => 'stylerize']);
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <label>Дилер:</label>
                                    <select name="Opinion[dealer_id]" id="select-dealer_id" class="stylerize"></select>
                               </div>
                            </div><!-- /.crow cascade -->

                            <?php
                            $arStars = ['Качество обслуживания', 'Цена/качество', 'Профессионализм'];
                            foreach($arStars as $k => $val) {
                                ++$k; ?>
                                <label><?= $val ?>:</label>
                                <input type="hidden" name="Opinion[rate_<?= $k ?>]" id="rate_<?= $k ?>" value="0" />
                                <div class="rating-stars" data-rate-input="rate_<?= $k ?>">
                                <?php
                                $i = 1;
                                while($i < 11) {
                                    echo '<span class="star"></span>' ."\n";
                                    ++$i;
                                } ?>
                                </div>
                     <?php  } ?>
                                
                                <?= $form->field($model, 'content')->textArea(['style' => 'height: 120px;']) ?>
                                <?= $form->field($model, 'pro')->textArea(['style' => 'height: 50px;']) ?>
                                <?= $form->field($model, 'contra')->textArea(['style' => 'height: 50px;']) ?>
                                <?= $form->field($model, 'person_id')->hiddenInput(['value' => Yii::$app->user->id])  ?>

                                <div class="form-group">
                                    <?= Html::submitButton('Отправить отзыв', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div><!-- .modal-body -->
        </div>
    </div>
</div><!-- modal -->