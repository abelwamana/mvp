<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
    ],
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        
         'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=109.70.148.57;dbname=nvvtbjdo_dbmvp',
            'username' => 'nvvtbjdo_abel',
            'password' => 'FRESANfresan08',
            'charset' => 'utf8',
        ],
               
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.sgi-fresancamoes.com',
                'username' => 'geral@sgi-fresancamoes.com',
                'password' => 'paralelepipedoazul21',
                'port' => '465',
                'encryption' => 'ssl',
            ]
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        
  /* 'as access' => [
    'class' => yii2mod\rbac\filters\AccessControl::class,
    'allowActions' => [
        'site/*',
        'admin/*',
        // The actions listed here will be allowed to everyone including guests.
        // So, 'admin/*' should not appear here in the production, of course.
        // But in the earlier stages of your development, you may probably want to
        // add a lot of actions here until you finally completed setting up rbac,
        // otherwise you may not even take a first step.
    ]
 ],*/
        ],
             
];
