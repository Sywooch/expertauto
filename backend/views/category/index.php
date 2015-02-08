<?php

use yii\helpers\Html;
use common\models\Category;
use backend\assets\AppAsset;

$this->title = $this->title .' Редактировать рубрики';
$this->registerJsFile('js/core/jquery.phantomInput.js', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('js/core/jquery.synctranslit.js', ['depends' => [AppAsset::className()]]);
$this->registerJsFile('js/categories.js', ['depends' => [AppAsset::className()]]);
?>

<section class="wrapper top-minimize">
    <div class="row">
        <div class="col-md-12">
        
            <section class="panel">
                <?= $this->render('/layouts/toppanel/categories') ?>
                <div class="panel panel-common clearfix bgr-grey">
                <!-- .................................. -->

                <div class="row">

                <div class="toggle-form">
                    <?= $this->render('_form_parentcategory', ['model' => $model]) ?>
                </div>
                    
                    <table class="table" style="width: 600px; border-collapse: separate; background: #f8f8f8;">
                        <thead>
                            <tr>
                                <th style="width: 50px;"></th>
                                <th style="width: 400px;">Название</th>
                                <th colspan="2" style="width: 40px;">Позиция</th>
                                <th style="width: 50px;">Удал.</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                        $prevParentId = null;
                        $parentMaxPos = \common\models\Utilities::findMaxFrom(Category::tableName(), ['where' => ['parent_id' => 0]]); 

                        foreach($items as $k => $item)    {  
                                
                            if($item['parent_id'] == $prevParentId) {
                            
                                echo $this->render('_row_category', ['k' => $k, 'items'=> $items, 'item' => $item, 'prevParentId' => $prevParentId]); 
                            
                            } else {
                                $prevParentId = (int)$item['parent_id'];

                                if($k != 0) { 
                                    echo "</tbody>\n"; 
                                }
                                echo '
                                <tbody class="accordionable">';
                                
                                echo $this->render('_row_parentcategory', ['item' => $item, 'parentMaxPos' => $parentMaxPos]); 

                                echo $this->render('_form_category', ['model' => $model, 'item' => $item]); 
                                
                                echo $this->render('_row_category', ['k' => $k, 'items' => $items, 'item' => $item, 'prevParentId' => $prevParentId]); 
                            }  

                        }
                        ?>
                        </tbody>
                        </table>
                    </div>
                <!-- .................................. -->
                </div>
            </section>

        </div>    
    </div>
</section>



    
    
   