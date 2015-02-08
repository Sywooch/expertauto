<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Person',
            'enableAutoLogin' => true,
        ],

        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => 'facebook_client_id',
                    'clientSecret' => 'facebook_client_secret',
                ],
                'vkontakte' => [
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => '4759650',
                    'clientSecret' => 'r6Zxas7t3SowGwGnkGA0',
                ],
            ],
        ],

        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // '/'=>'site/index',
                '<_a:(login|logout|signup|update|captcha|confirm-email|request-password-reset|reset-password|dummy)>' => 'person/<_a>',
                '<view:(about|contact)>' => 'site/static',  
                'page/<view>' => 'site/static',                 
                'list/category/<category:>' => 'article/index',
                'list/tag/<tag:>' => 'article/index',
                'list/author/<author:>' => 'article/index',
                'search/' => 'article/index',
                'articles/<slug:>' => 'article/index',
                'expert/<slug:>' => 'expert/view',
                'topic' => 'topic/index',
                'post' => 'post/index',
                'opinion/<_a:(index|view|create|dealerlist)>' => 'opinion/<_a>',
                '<category_slug:>/<slug:>' => 'article/view',
                'article/<slug:>' => 'article/view',
                'sitemap.xml' => 'site/sitemap',

                // '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                // 'post/<id:\d+>'=>'post/read',
                // 'post/<year:\d{4}>/<title>'=>'post/read',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
