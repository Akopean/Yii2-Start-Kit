<?php
use yii\di\Instance;

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => [
        'common\bootstrap\Bootstrap',
    ],
    'language' => 'en-EN',
    'sourceLanguage' => 'en-EN',
    'container' => [
        'definitions' => [
        ],
        'singletons' => [
        ],
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ],
    'components' => [
        'static_page' => [ // для удобства мы задали псевдоним
            'class' =>  'common\components\StaticPage',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
            // List all supported languages here
            // Make sure, you include your app's default language.
            'languages' => ['en' => 'en-EN', 'ru' => 'ru-RU'],// ['en' => 'en-EN', 'ru' => 'ru-RU', 'ua' => 'ua-UA']
          // 'class' => 'common\components\LangUrlManager',
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
        'i18n' => [
            'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                //    'on missingTranslation' => ['common\components\TranslationEventHandler', 'handleMissingTranslation']
                ],
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],
    ],
];
