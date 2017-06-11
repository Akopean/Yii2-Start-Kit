<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    //'language' => 'en-EN',
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'settings'=> [
            'class' => 'common\components\DbSettings',
            'cacheDuration' => 3600,
        ],
    ],
];
