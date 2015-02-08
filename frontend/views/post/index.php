<?php
use yii\helpers\Html;
use common\models\Person;
use common\models\Image;
use yii\widgets\Breadcrumbs;
use backend\assets\AppAsset;

$this->registerJsFile('js/posts.js', ['depends' => [AppAsset::className()]]);
$this->title = $this->title .' Форумы :: Сообщения';

$links = [
    // ['label' => 'Форумы', 'url' => ['topic/index', 'id' => 0]]
];
if(count($chainOfTopics) > 0) {
    foreach($chainOfTopics as $chain) {
        $links[] = ['label' => $chain['title'], 'url' => ['topic/index', 'id' => $chain['id']]];
    }
}
?>

<div class="container-fluid">
<div class="row">
    <div class="column column-left">
        <div id="article_content" style="background: #fafafa;">

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

                <div style="background: #fff;">
                    <div class="posts-heading">
                        <div class="topic-name">
                            Тема:&nbsp;&nbsp;&nbsp;&nbsp;<?= $topic['title'] ?>
                        </div>
                    </div>

                    <?php 
                    if(Person::isHasRightToCreateForumPost()) {
                        echo $this->render('_form');
                    }    
                    
                    if(isset($items)) {   ?>
                    <ul class="post-list">
                        <?php
                        foreach($items as $item) { ?>
                            <li class="post-box">
                                <div class="post-head">
                                    <?= Html::img(
                                    Image::getImageSrc('/photo/avatar/100x100/' .$item['avatar_src'], '/images/icon-avatar.png'), ['class' => 'avatar']); ?>

                                    <span class="username">
                                        <a href="#"> 
                                            <?= Person::getPublicName($item) ?> 
                                        </a>
                                    </span>
                                    <span class="datetime">
                                        <?= date('d.m.Y', strtotime($item['created_at'])); ?>
                                    </span>
                                </div>
                                <div class="post-content">
                                    <?php 
                                    if($item['quote_text']) {
                                        echo '<quote>
                                                <span class="quote_author">' .$item['quote_author'] .':</span>
                                                &ldquo;' 
                                                .trim($item['quote_text']) .'&rdquo;
                                             </quote>';
                                    }
                                    ?>
                                    <?= $item['content'] ?>
                                </div>
                                <div class="post-btns">
                                    <button class="btn btn-default btn-xs btn-quote" type="button" data-id ="<?= $item['id'] ?>" title="Цитировать выделенное">Цитата</button>
                                </div>

                            </li>
                <?php  } ?> 
                    </ul>
                        <?php
                        if($pages->pageCount > 1) {
                            echo \yii\widgets\LinkPager::widget([
                                'pagination' => $pages,
                                'options' => ['class' => 'pagination pagination-sm']
                                ]);
                        } 
                    } ?> 
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