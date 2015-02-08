<?php
use yii\helpers\Html;
use common\models\Person;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;

// $this->registerJsFile('js/topics.js', ['depends' => [AppAsset::className()]]);
$this->title = $this->title .' Форумы :: Темы';
$links = [
    // ['label' => 'Форумы', 'url' => ['topic/index', 'id' => 0]]
];
if(count($chainOfTopics) > 0) {
    foreach($chainOfTopics as $topic) {
        $links[] = ['label' => $topic['title'], 'url' => ['topic/index', 'id' => $topic['id']]];
    }
}
?>
<div class="container-fluid">
<div class="row">
    <div class="column column-left">
        <div id="article_content">

            <section id="breadcrumb-list">
                <?= Breadcrumbs::widget([
                        'homeLink' => ['label' => 'Главная', 'url' => Yii::$app->homeUrl],
                        // 'links' => $links
                         'links' => ['label' => 'Форумы']
                    ]); ?>
            </section>

            <article class="article">
         
            <section id="breadcrumbs-title">
                <?= Breadcrumbs::widget([
                        'homeLink' => ['label' => ''],
                        'links' => $links
                    ]); ?>
            </section>

            <div class="row" style="margin-left: 10px;">
                <div class="col-md-12">

                    <?php 
                    if(Person::isHasRightToCreateForumTopic()) {
                        echo $this->render('_form_topic');
                    }    
                    
                    if(isset($items)) {                   
                    ?>
                    <table class="table topics-table table-striped topic-list" style="width: 700px;">
                        <tbody>
                        <?php
                        foreach($items as $item) { ?>
                            <tr>
                            <?php 
                            if($item['is_category'] == 1) {
                                echo '<td class="category"><span class="fa fa-bars icon"></span>' 
                                .Html::a($item['title'], ['topic/index', 'id' => $item['id']]) .'
                                </td>';
                            }   else {
                                 echo '<td>' 
                                .Html::a($item['title'], ['post/index', 'id' => $item['id']]) .'
                                </td>';
                            }
                            ?>
                                <td></td>  
                            </tr>
                <?php  } ?> 
                        </tbody>       
                    </table>
             <?php } ?> 
                    </div><!-- col-md-12 -->
                </div><!-- row -->
            </article>
        </div><!-- #article_content -->
    </div><!-- .column-left -->

    <div class="column column-right">
        <div class="sidebar sidebar-article">
            <?= $this->render('/layouts/_sidebar_b'); ?>
        </div>
    </div>    
</div><!-- .row -->
</div><!-- .container-fluid -->