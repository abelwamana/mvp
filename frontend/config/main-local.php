<?php
$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'LHMI-7Vtar9xQWJ7KyjN1_ZTCRd1zg64',
        ],
        
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                // Regra de rota para a página inicial
                '/' => 'site/index',
                // Regra de rota para a página "Missao"
                'missao' => 'site/missao',
                // Regra de rota para a página "Resultados"
                'resultado' => 'site/resultado',
                // Regra de rota para a página "Galeria"
                'galeria' => 'site/galeria',
                // Regra de rota para a página "Contactos"
                'contacto' => 'site/contacto',
                // Regra de rota para a página "Política de Provacidade"
                'politica' => 'site/politica',
                // Rota para solicitar redefinição de senha
                'request-password-reset' => 'user/request-password-reset',
                // Rota para redefinir a senha
                'reset-password/<token>' => 'user/reset-password',
 
                // Regra de rota para a página "Login"
                'login' => 'site/login',
                'logout' => 'site/logout',
                
            ],
        ],
        
        'urlManagerBackend' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl'=>'/mvp/admin',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index', // Rota para backend/SiteController/index
                'fresan' => '/site/fresan',
                 'login' => '/site/login',
                'logout' => 'site/logout', // Rota para backend/SiteController/logout
                 'grupo' => 'grupo/index',
                'demostracoesculinarias' => 'demostracoesculinarias/index',
                'rastreio' => 'rastreio/index',
                'profissionaissaude' => 'profissionaissaude/index',
                'pacotepedagfresan' => 'pacotepedagfresan/index',                
                'suplementacao' => 'suplementacao/index',
                'merendaescolar' => 'merendaescolar/index',
                'capacitacao' => 'capacitacao/index',
                'materiais' => 'materiais/index',
                'supervisao' => 'supervisao/index',
                'agua' => 'agua/index',
                'reforcoinstitucional' => 'reforcoinstitucional/index',
                'doccomunicacao' => 'doccomunicacao/index',
                'eventos' => 'eventos/index',
                'relatorios/folhatrimestral' => 'site/folhatrimestral',
                'relatorios/quadrologico' => 'site/quadrologico',
                'biblioteca' => 'biblioteca/index2',
                'biblioteca' => 'biblioteca/index3',
                'calendario' => 'site/calendario2',
                'user' => 'user/index',
                'rotas' => 'rbac/route',
                'permisoes' => 'rbac/permission',
                'roles' => 'rbac/role',
                'perfisusuarios' => 'rbac/assignment',
                // Rota para solicitar redefinição de senha
                'request-password-reset' => 'user/request-password-reset',
                // Rota para redefinir a senha
                'reset-password/<token>' => 'user/reset-password',
 
//                'materiais' => 'materiais/index',
//                'materiais' => 'materiais/index',
//                'materiais' => 'materiais/index',
//                'materiais' => 'materiais/index',
//                'materiais' => 'materiais/index',
//                'materiais' => 'materiais/index', 
            ],
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
        ]
    ],
];

if (!YII_ENV_TEST) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => \yii\debug\Module::class,
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => \yii\gii\Module::class,
    ];
}

return $config;
