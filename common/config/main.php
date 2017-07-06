<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'language' => 'en-EN',
    'container' => [
        'definitions' => [

        ],
        'singletons' => [
        ],
    ],
  //  'bootstrap' => ['common\components\ThemeBootstrap'],
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
        'request' => [
     //       'class' => 'common\components\LangRequest',
        ],
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
            'languages' => ['en', 'ru', 'ua'],


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
                ],
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ]
            ],
            'on missingTranslation' => ['common\components\TranslationEventHandler', 'handleMissingTranslation']
        ],
    ],
];
