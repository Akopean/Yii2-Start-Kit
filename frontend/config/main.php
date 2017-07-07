<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/index',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'page' => [
            'class' => 'frontend\modules\page\PageModule',
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //out static page
                // '<view:\w+>' => 'site/page',
                ['class' => 'common\components\PageUrlRule'],

                //add dynamic page for default controller
                '<alias:index|login|contact|signup|about>' => 'site/<alias>',



                '<controller:[\w-]+>' => '<controller>/index',
                '<controller:[\w-]>/<id:\d+>' => '<controller>/view',
                '<controller:[\w-]>/<id:\d+>/<action:[\w-]+>' => '<controller>/<action>',

/*
                '<modules:\w>/<controller:[\w-]+>' => '<modules>/</modules><controller>/index',
                '<modules:\w>/<controller:[\w-]>/<id:\d+>' => '<modules>/<controller>/view',
                '<modules:\w>/<controller:[\w-]>/<id:\d+>/<action:[\w-]+>' => '<modules>/<controller>/<action>',*/
            ],
        ],

    ],
    'params' => $params,
];
