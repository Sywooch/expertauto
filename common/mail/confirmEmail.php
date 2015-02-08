<?php
use yii\helpers\Html;
 
 
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['person/confirm-email', 'token' => $user->email_confirm_token]);
?>
 
Здравствуйте, <?= Html::encode($user->username) ?>!
 
Для подтверждения адреса пройдите по ссылке:
 
<?= Html::a(Html::encode($confirmLink), $confirmLink) ?>
 
Если Вы не регистрировались на нашем сайте, то просто удалите это письмо.