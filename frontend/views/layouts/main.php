<?php
use yii\helpers\Html;
use frontend\widgets\Alert;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,400italic&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic-ext' rel='stylesheet' type='text/css'>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="header">
        <?= $this->render('_header') ?>
    </div>
    <div class="topmenu">
        <?= $this->render('_topmenu') ?>
    </div>

    <div class="wrapped">
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

    <footer id="footer">
        <div class="wrapped">
            <?= $this->render('_footer'); ?>
        </div>
    </footer>
    <?= $this->render('/layouts/_modal_login'); ?>
    <?= $this->render('/layouts/_modal_signup'); ?>
    <?= $this->render('/layouts/_modal_search'); ?>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>