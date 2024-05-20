<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'plugins/bootstrap/bootstrap.min.css',
        'plugins/fontawesome/css/all.css',
        'plugins/fontawesome/css/all.min.css',
        'plugins/animate-css/animate.css',
        'plugins/slick/slick.css',
        'plugins/slick/slick-theme.css',
        'plugins/colorbox/colorbox.css',
        'css/style.css',
        'css/translate.css',
    ];
    public $js = [
        'plugins/jQuery/jquery.min.js',
        'plugins/bootstrap/bootstrap.min.js',
        'plugins/slick/slick.min.js',
        'plugins/slick/slick-animation.min.js',
        'plugins/colorbox/jquery.colorbox.js',
        'plugins/shuffle/shuffle.min.js',
        'plugins/google-map/map.js',
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
