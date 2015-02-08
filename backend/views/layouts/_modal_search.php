<?php
use yii\bootstrap\Modal;

Modal::begin([]);       
Modal::end();
?>
<!-- Modal -->
<div  id="modal-search" class="modal">
    <div class="modal-dialog search">
        <div class="modal-content">
            <div class="modal-header" style="position: relative;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Найти статью</span></h4>
            </div>

            <div class="modal-body">
    
                <?= $this->render('/layouts/_form_search') ?>           
                <div class="line" style="margin: 40px 0 30px;"></div>
                <div id="found-list"></div>

            </div><!-- .modal-body -->
        </div>
    </div>
</div><!-- modal -->
