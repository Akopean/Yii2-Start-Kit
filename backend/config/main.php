<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
//var_dump('<pre>',$_SERVER['DOCUMENT_ROOT']);exit;
return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/index',
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        // Маршруты, открытые по умолчанию всегда.
        // Открываем только для начальной разработки.
        // Как только основные данные о ролях заполнены,
        // убираем отсюда всё лишнее.
        'allowActions' => [
            // Маршруты модуля пользователей.
            // Логин и так разрешён, но разлогиниться
            // без этой настройки и без настроенных ролей не получится.
           // 'user/*',
           // 'admin/*',
           // 'site/*',
            //'users-admin/*',
            //'debug/*',
        ]
    ],
    'components' => [
        'request' => [
            'baseUrl'=>'',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        'cache' => [
            'class' => 'yii\caching\FileCache',
            'cachePath' => '@backend/runtime/cache'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<alias:index|login|logout>' => 'site/<alias>',
            ],
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => 'http://yii2-start-kit',
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'mdm\admin\Module',
            'layout' => null,
        ],
        'filemanager' => [
            'class' => 'pendalf89\filemanager\Module',
            // Upload routes
            //Rename files if the name is already in use
            'rename' => true,
            'routes' => [
                // Base absolute path to web directory
                'baseUrl' => '',
                // Base web directory url
                'basePath' => '@frontend/web',
                // Path for uploaded files in web directory
                'uploadPath' => 'uploads',
            ],
            // Thumbnails info
            'thumbs' => [
                'small' => [
                    'name' => 'Мелкий',
                    'size' => [100, 100],
                ],
                'medium' => [
                    'name' => 'Средний',
                    'size' => [300, 200],
                ],
                'large' => [
                    'name' => 'Большой',
                    'size' => [500, 400],
                ],
            ],
        ],
    ],
    'aliases' => [
        '@fronted_web' =>  Yii::getAlias('@frontend/web'),
    ],
    'params' => $params,
];
