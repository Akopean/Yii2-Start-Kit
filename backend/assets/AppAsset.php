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
        'themes/css/propeller-admin.css',
        'themes/css/propeller-theme.css',
        'css/site.css',
    ];
    public $js = [
        'themes/js/circles.min.js',
        'themes/js/highcharts.js',
        'themes/js/highcharts-more.js',
    ];
    public $depends = [
        'backend\assets\Html5ShivAsset',
        'backend\assets\GoogleMaterialconAsset',
        'backend\assets\RespondAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
