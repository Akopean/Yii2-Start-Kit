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
    'modules' => [
        // ID модуля должен обязательно быть "user", иначе модуль не загрузится.
        'user' => [
            'class' => 'dektrium\user\Module',
            'adminPermission' => 'admin',
        ],
        'users' => [
            'class' => 'mdm\admin\Module',
            'layout' => null,
       /*     'controllerMap' => [
                'user' => [
                    'class' => null,
                ],
                'other' => [
                    'class' => 'mdm\admin\controller',
                ],
            ],*/
        ]
    ],
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
            'user/*',
            'admin/*',
            'site/*',
            'users-admin/*',
            'debug/*',
        ]
    ],
    'components' => [
        'request' => [
            'baseUrl'=>'/admin',
            'csrfParam' => '_csrf-backend',
        ],
       /* 'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],/*
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
