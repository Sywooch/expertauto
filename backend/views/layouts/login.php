<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);

$this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
     
    <?= Html::csrfMetaTags() ?>
    <title>Вход в админку</title>
    <?php $this->head() ?>
</head>
<body class="login-body">
<?php $this->beginBody() ?>

    <div class="container">
            <?= $content; ?>        
    </div><!-- /container  -->        

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
