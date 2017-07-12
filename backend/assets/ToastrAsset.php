<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class ToastrAsset extends AssetBundle
{
    public $sourcePath = '@bower/toastr';
    public $css = [
        'toastr.min.css',
    ];
    public $js = [
        'toastr.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];
}
