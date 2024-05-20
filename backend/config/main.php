<?php

$params = array_merge(
        require __DIR__ . '/../../common/config/params.php',
        require __DIR__ . '/../../common/config/params-local.php',
        require __DIR__ . '/params.php',
        require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'language' => 'pt_br', //definimos a lingua da nossa App
    'sourceLanguage' => 'en', //definimos a fonte 
    'name' => 'SGI FRESAN Camões, I.P.',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' => [
            'class' => 'kartik\grid\Module',
        // outras configurações específicas do módulo aqui
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        
        'session' => [
// this is the name of the session cookie used for login on the backend
            'name' => 'advancedfrontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        // uncomment if you want to cache RBAC items hierarchy
// 'cache' => 'cache',
        ],
        
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/traducao', //definimos a pasta onde estarão as mensagens para traduzir o Aplicativo
                    'sourceLanguage' => 'pt',
                    'fileMap' => [
                        'app' => 'app.php',
                        'app/error' => 'error.php',
                    ],
                ],
                'yii2mod.rbac' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2mod/rbac/messages',
                ],
//                'yii' => [
//                    'class' => 'yii\i18n\PhpMessageSource',
//                    'basePath' => '@common/traducao',//mensagem padrao do Yii no ficheiro yii.php na pasta de traducao
//                    'sourceLanguage' => 'pt_br',
//                ],
            ],
        ],
    /* 'view' => [
      'theme' => [
      'pathMap' => [
      '@app/views' => '@vendor/hail812/yii2-adminlte3/src/views'
      ],
      ],
      ], */
    ],
//    'as access' => [
//        'class' => yii2mod\rbac\filters\AccessControl::class,
//        'allowActions' => [
//            'site/*',
//            'admin/*',
//        // The actions listed here will be allowed to everyone including guests.
//        // So, 'admin/*' should not appear here in the production, of course.
//        // But in the earlier stages of your development, you may probably want to
//        // add a lot of actions here until you finally completed setting up rbac,
//        // otherwise you may not even take a first step.
//        ]
//    ],
    'params' => $params,
];
