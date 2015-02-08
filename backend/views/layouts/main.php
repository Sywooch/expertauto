<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
   <!--  <link href='http://fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'></link> -->
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="sticky-header">
    <?php $this->beginBody() ?>

    <section>
        <!-- left side start-->
        <div class="left-side sticky-left-side">
            <?= $this->render('_sidebar'); ?>
        </div>
        <!-- left side end-->
        
        <!-- main content start-->
        <div class="main-content" >

            <!-- header section start-->
            <div class="header-section">
                 <?= $this->render('_header'); ?>
            </div>
            <!-- header section end-->

            <!--body wrapper start-->
            <div class="wrapper">
                <?= $content ?>
            </div>
            <!--body wrapper end-->

            <!--footer section start-->
            <footer class="sticky-footer">
                2014 &copy; AdminExpert
            </footer>
            <!--footer section end-->

        </div>
        <!-- main content end-->
    </section>

    <script type="text/javascript">
        var activeMenuItem = "li-<?= Yii::$app->controller->id .'-' .Yii::$app->controller->action->id ?>";
    </script>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
