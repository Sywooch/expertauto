<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\Author;
use common\models\Category;
?>
        
    <form method="get" id="form-search" action="/article/index">
       
        <div class="col-md-6">
            <div class="form-group">
                <?php
                $mainCategoryList = ArrayHelper::map(Category::find()->where(['parent_id' => 0])->all(), 'id', 'name');
                echo Html::dropDownList('main_category_id', 0, $mainCategoryList, ['prompt'=>'--Раздел--', 'id' => 'select-main_category_id', 'class' => 'stylerize']);
                ?> 
                <div id="wrap-select-category_id" style="margin-top: 6px;">
                    <select name="category_id" id="select-category_id" class="stylerize"></select>
                </div>
            </div>
        </div><!-- /.col-md-6 -->
        <div class="col-md-6">
            <?php
            $authorList = ArrayHelper::map(Author::find()->all(), 'id', 'lastname');
            echo Html::dropDownList('author_id', 0, $authorList, ['prompt'=>'--Автор--', 'class' => 'stylerize']);
            ?> 
        </div><!-- /.col-md-6 -->

        <div class="form-inline">
            <input class="form-control" type="text" name="search" style="width: 80%; margin-left: 14px; margin-right: 10px;">
            <button class="btn btn-primary" type="submit" id="submit-modal-search">Найти</button>
        </div>

    </form>

                