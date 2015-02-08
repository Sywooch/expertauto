<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
     'aliases' => [
        '@img' => dirname(dirname(__DIR__)) . '/frontend/web/photo',
    ],
    'language'=>'ru-RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager'=> [
            'class'=>'yii\web\UrlManager',
            'enablePrettyUrl'=>true,
            'showScriptName' => false,
            'rules'=> [
            ],
        ],
    ],
];
