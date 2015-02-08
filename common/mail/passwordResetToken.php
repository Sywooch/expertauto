<?php
use yii\helpers\Html;
 

 
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['person/reset-password', 'token' => $user->password_reset_token]);
?>
 
Здравствуйте, <?= Html::encode($user->username) ?>!
 
Пройдите по ссылке, чтобы сменить пароль:
 
<?= Html::a(Html::encode($resetLink), $resetLink) ?>