<?php

namespace backend\assets;

use yii\web\AssetBundle;

class PropellerAsset extends AssetBundle
{
    public $sourcePath = '@bower/propeller/dist';
    public $css = [
        'css/propeller.css',
    ];
    public $js = [
        'js/propeller.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
