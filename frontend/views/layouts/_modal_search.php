<?php
use yii\bootstrap\Modal;

Modal::begin([]);       
Modal::end();
?>
<!-- Modal -->
<div  id="modal-search" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding: 6px 15px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 style="margin-left: 30px;">Поиск по сайту</h4>
            </div>

            <div class="modal-body" style="padding: 40px 40px 80px;">
                <div class="row">
                    <div class="col-lg-10">
                        <form method="get" action="/search" class="form-inline">
                            <div class="form-group">
                                <input type="text" name="search" class="form-control" placeholder="введите слово для поиска" style="width: 320px;" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-danger" style="background: #999; border: 1px solid #aaa; margin-left: 10px;" value="Найти" />
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- .modal-body -->
        </div>
    </div>
</div>
<!-- modal -->
