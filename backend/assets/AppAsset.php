<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\View;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        'css/bootstrap-reset.css',
        'css/font-awesome.css',
        // 'css/jquery-ui-1.10.4.min.css',
        'css/style.css',
        'css/style-responsive.css',
    ];
    public $js = [
        // 'js/core/jquery-ui-1.10.4.min.js',
        'js/core/modernizr.min.js',
        'js/core/jquery.nicescroll.js',
        'js/core/jquery.cookie.js',
        'js/core/jquery.formstyler.js',
        'js/_common.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];
    
}
