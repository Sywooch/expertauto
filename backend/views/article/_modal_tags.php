<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Tag;
use common\models\Tagging;
use yii\bootstrap\Modal;

Modal::begin([]);       
Modal::end();
?>

<!-- Modal -->
<div  id="myModal" class="modal fade">
    <div class="modal-dialog tags">
        <div class="modal-content">
            <div class="modal-header" style="position: relative;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Тэги<span id="toggle-form-tag-create" class="fa fa-plus-circle"></span></h4>

                 <div id="wrap-form-tag-create" style="display: none;">
                    <div id="tag_add_form" class="form-inline">
                        <input name="Tag[name]" id="input-tag-name">
                        <span id="tag_add_submit">Добавить</span>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                <?php
                if(isset($taggings)) {
                    echo '<div id="taggings" class="clearfix">';

                    foreach($taggings as $tag) {
                        echo '<div>' .$tag['name'] .
                        HTML::a('<span>×</span>', ['#'], 
                            [
                                'class' => 'tagging-delete', 
                                'data-id' => $tag['id'], 
                                'data-name' => $tag['name'], 
                            ]) .' 
                        </div>';
                    }
                    echo '
                    </div>';
                }
                
                ?>
                <div class="line"></div>
                <div id="tagging-list">
                <?php
                foreach($unusedTags as $tag) { ?>
                    <div>
                        <input type="checkbox" name="Tagging[tag_id][<?= $tag['id'] ?>]"><label><?= $tag['name'] ?></label>
                    </div>
                <?php } ?>
                </div><!-- #tagging-list -->

            </div><!-- .modal-body -->
        </div>
    </div>
</div>
<!-- modal -->
