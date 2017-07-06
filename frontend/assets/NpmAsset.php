<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class NpmAsset extends AssetBundle
{
    public $sourcePath = '@npm/react/dist';
    public $js = [
       // 'react.min.js',
    ];
}
