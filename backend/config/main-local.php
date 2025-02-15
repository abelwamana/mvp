<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'n3dyjm-x0HxMzxZunw2Sq8v-JuY1yG7n',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index', // Rota para backend/SiteController/index
                'fresan' => '/site/fresan',
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
                'calendario' => 'site/calendario',
                'user' => 'user/index',
                'rotas' => 'rbac/route',
                'permisoes' => 'rbac/permission',
                'roles' => 'rbac/role',
                'perfisusuarios' => 'rbac/assignment',
                'eventos' => 'site/eventos',
                'calendarevento' => 'calendarevento/index',
                'get-events' => 'site/get-events',
                'test' => 'site/test',
                 'tabelaEventosCalendario' => 'event/index',
                 'eventos' => 'eventos/index',
                'provincia' => 'provincia/index',
                'municipio' => 'municipio/index',
                'comuna' => 'comuna/index',
                'localidade' => 'localidade/index',
                'unidade' => 'unidade/index',
                'classificacaodocumentoartigo' => 'classificacaodocumentoartigo/index',
                'finalidade' => 'finalidade/index',
                'culturasprovidas' => 'culturasprovidas/index',
                'metas' => 'metas/index',
                 'galeria' => 'site/galeria',
                'beneficiario' => 'site/beneficiario',
                 'add-events' => 'site/add-events',
                'coberturacunene' => 'site/fresancunene',
                'coberturahuila' => 'site/fresanhuila',
                'coberturanamibe' => 'site/fresannamibe',
               'emconstrucao' => ' site/emconstrucao',
                'emconstrucao' => 'site/emconstrucao',
                'localidade' => 'localidade/index',
                'localidade' => 'localidade/index',
                'listaeventosfiltratos' => 'event/get-events', 
                'resultadosagricultura'=>'site/resultadosagricultura',
                'resultadosnutricao'=>'site/resultadosnutricao',
                'resultadosreforcoinstitucional' => 'site/resultadosreforcoinstitucional',
                'resultadosagua' => 'site/resultadosagua',
                // Rota para solicitar redefinição de senha
                'request-password-reset' => 'user/request-password-reset',
                // Rota para redefinir a senha
//              'reset-password/<token>' => 'user/reset-password',
                'update'=> 'user/update',
                'adicionarContacto' => 'contacto/create',
                'verContacto' => 'contacto/view', 
                'actualizarContacto' => 'contacto/update',
//                'update-event' => 'site/update-event',
                'listaeventosCalendario' => 'event/listaeventos',
                'verAgua' => 'agua/view', 
                'actualizarAgua' => 'agua/update', 
                'adicionarDocumento' => 'biblioteca/create',
                'bibliotecaLista' => 'biblioteca/index', 
                'editarDocumento' => 'biblioteca/update', 
                'verDocumento' => 'biblioteca/view', 
                'bibliotecaPage' => 'biblioteca/biblioteca', 
                'viewpage' => 'biblioteca/viewpage', 
                'actualizarEvento' => 'event/update', 
                'event/remove-anexo' => 'event/remove-anexo',
                'arquivo' => 'arquivo/arquivo',
                'arquivoAdmin' => 'arquivo/index',
                 'VerArquivo' => 'arquivo/viewpage',
                 'VerDetalhesArquivo' => 'arquivo/view',
                'AdicionarArquivo'=>'arquivo/create',
                 'boaspraticasAdmin' => 'boaspraticas/index',
                'VerBoasPraticas'=>'boaspraticas/view',
                 'AdicionarBoasPraticas'=>'boaspraticas/create',
                 'EditarBoasPraticas'=>'boaspraticas/update',
                'boaspraticasPage'=>'boaspraticas/boaspraticas',
                'boaspraticasAdmin'=>'boaspraticas/index',
                'boaspraticasEstatic'=>'boaspraticas/boaspraticasestatic',
                'AdicionarRecomendacoes'=>'recomendacoes/create',
                 'EditarRecomendacoes'=>'recomendacoes/update',
                'recomendacoesPage'=>'recomendacoes/recomendacoes',
                'RecomendacoesAdmin'=>'recomendacoes/index'
            ],
        ],
        'urlManagerFrontend' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl'=>'/mvp',
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
                // Regra de rota para a página "Login"
                'login' => 'site/login',
                 'logout' => 'site/logout',
            ],
        ],
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
        'generators' => [
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'myCrud' => '@app/meuTemplate/crud/default',
                ]
            ]
        ],
    ];
}

return $config;
