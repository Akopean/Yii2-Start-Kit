<?php

namespace backend\assets;

use yii\web\AssetBundle;

class Select2BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@bower/select2-bootstrap-theme/dist';
    public $css = [
        'select2-bootstrap.min.css',
    ];
}
