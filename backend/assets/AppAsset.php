<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
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
        'css/site.css',
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

    public function init()
    {
        parent::init();

        // Add version query string to each CSS file
        $version = time();
        foreach ($this->css as &$cssFile) {
            $cssFile .= "?v={$version}";
        }
    }
}
