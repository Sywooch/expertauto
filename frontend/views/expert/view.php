<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\models\Meta;

$this->title = $item['lastname'] .Meta::$titleSuffix;
$fullName = $item['firstname'] .' ' .$item['lastname'];
?>

<div class="container-fluid">
<div class="row">
    <div class="column column-left">
        <div id="article_content">

            <section id="breadcrumbs">
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'Главная', 'url' => Yii::$app->homeUrl],
                'links' => [
                    ['label' => 'Эксперты'],
                    ['label' => $fullName],
                ],
            ]); ?>
            </section>

            <article class="article" style="padding-bottom: 30px;">
                <div style="margin: 30px 50px 0 30px;">
                
                    <h1 style="margin-bottom: 50px;">Резюме эксперта: <?= $fullName ?></h1>
                    <?php
                    $paragraphs = explode("\n", $item['about']); 
                              
                    foreach($paragraphs as $k => $parag)   
                    {   
                        if($k == 0) {
                            echo '<figure style="width: 38%; margin: 4px 20px 4px 0; float: left;">'
                            .Html::img('/photo/author/300/' .$item['image_src'], ['alt' => $fullName])
                            .'</figure>';
                        } 
                        echo "<p>$parag</p>";
                    }
                    ?>     
                </div>
            </article>

            <section>
                <div class="row" style="margin: 30px 0 0 20px;">
                <div class="col-md-11">
                <?php
                if(count($articles) > 0 ) { ?>

                    <div class="box-header" style="margin-left: 24px;">
                        <span>Публикации эксперта</span>
                    </div>

                    <?= $this->render('/article/_list', ['items' => $articles, 'pagination' => $pagination]) ?>
                <?php } ?>
                </div>
                </div>
            </section>


        </div><!-- #article_content -->
    </div><!-- .column-left -->

    <div class="column column-right">
        <div class="sidebar sidebar-article">
            <?= $this->render('/layouts/_sidebar_b'); ?>
        </div>
    </div>    
</div><!-- .row -->
</div><!-- .container-fluid -->