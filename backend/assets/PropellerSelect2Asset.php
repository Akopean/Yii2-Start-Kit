<?php

namespace backend\assets;

use yii\web\AssetBundle;

class PropellerSelect2Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/css/pmd-select2.css',
    ];
    public $js = [
        'themes/js/pmd-select2.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'backend\assets\Select2Asset',
        'backend\assets\Select2BootstrapAsset',
    ];
}
