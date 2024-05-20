<?php

$params = require (__DIR__ . '/params.php');
return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=localhost;dbname=dbmvp2',
            'username' => 'root',
            'password' => '',
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
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'nodes' => [
                ['http_address' => 'localhost:9200'],
            // Adicione mais nós do Elasticsearch conforme necessário
            ],
        ],
    
//
// See: https://symfony.com/doc/current/mailer.html#using-built-in-transports
// Or if you use a 3rd party service, see:
// https://symfony.com/doc/current/mailer.html#using-a-3rd-party-transport
    ],
];
