<?php
use yii\helpers\Html;
use backend\assets\AppAsset;
use common\models\ImageArticle;
use common\models\Article;

$this->title = $this->title .' Добавить фото';
$this->registerJsFile('js/article.media.js', ['depends' => [AppAsset::className()]]);
?>

<section class="wrapper top-minimize">
    <div class="row">
        <div class="col-md-12">
        
            <section class="panel">
                <?= $this->render('/layouts/toppanel/article') ?>
                <div class="panel-body panel-common">
                    <!-- ......................... -->
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-lg-10 col-lg-offset-1">

                            <article class="article media-content" id="media-content">

                                <div id="icon_photo"></div>
                                <?= $this->render('_form_media_image', ['article' => $article]); ?>
                                 
                                <h1><?= $article->title ?></h1>

                                <?php
                                $paragraphs = explode("\n", $article['content']); 
                                  
                                foreach($paragraphs as $k => $parag)   
                                {
                                    $hasImage = false;

                                    if (isset($images[$k])) { 
                                        $hasImage = true;
                                        $layout = ($images[$k][0]['layout'] == ImageArticle::LAYOUT_BOTTOM) ? 'bottom' : 'float';
                                    }

                                    if( $hasImage && $layout == 'float' )  {
                                        echo $this->render('_image_float', ['image' => $images[$k][0] ]);
                                    }

                                    echo "<a name=\"$k\" data-parag-index=\"$k\"></a>";
                                    echo (Article::checkIsParagraph($parag)) ? "<p>$parag</p>" : $parag;
                                    
                                    if( $hasImage && $layout == 'bottom' ) {
                                        echo $this->render('_image_bottom', ['images' => $images[$k] ]);
                                    }
                                }
                                ?>   
                            </article>
                        </div><!-- /col-lg-10 -->
                    </div><!-- /row -->      
                    <!-- ......................... -->
                </div>
            </section>

        </div>    
    </div>
</section>




            
