<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * NestableAsset asset bundle.
 */
class NestableAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/nestable.css'
    ];
    public $js = [
        'js/jquery.nestable.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
