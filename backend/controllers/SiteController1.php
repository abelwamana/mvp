<?php

namespace backend\controllers;

use backend\models\Provincia;
use backend\models\Reforcoinstitucional;
use common\models\LoginForm;
use Google_Client;
use Google_Service_Calendar;
use PhpOffice\PhpWord\TemplateProcessor;
use scotthuangzl\googlechart\GoogleChart;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;
use backend\models\Meta;
use yii\helpers\Url;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public $results = [];

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'folhatrimestral', 'exportfolhatrimestral', 'calendario2', 'fresan'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
        $ano = Yii::$app->request->get('ano');
        $provincia = Yii::$app->request->get('provincia');
        $municipio = Yii::$app->request->get('municipio');
        $localidade = Yii::$app->request->get('localidade');
        $entidade = Yii::$app->request->get('entidade');
        $trimestre = Yii::$app->request->get('trimestre'); // Obtenha o trimestre selecionado
        // Inicializar um array para armazenar os resultados de todas as tabelas
        // Tabelas a serem pesquisadas
        $tabelas = [
            'Agua',
            'Capacitacao',
            'demostracoesculinarias',
            'eventos',
            'grupo',
            'doccomunicacao',
            'materiais',
            'merendaescolar',
            'pacotepedagfresan',
            'profissionaissaude',
            'rastreio',
            'reforcoinstitucional',
            'supervisao',
            'suplementacao',
        ];

        // Loop através das tabelas
        foreach ($tabelas as $tabela) {
            $modelClass = 'backend\models\\' . $tabela;

            $query = Yii::createObject(['class' => $modelClass])->find()
                    ->andWhere(['<=', 'YEAR(primeiroReporte)', 2023]);

//            // Verifique se o trimestre está definido e adicione-o à consulta
//            if (!empty($trimestre)) {
//                // Converta o trimestre para o mês inicial e final
//                $mesInicial = ($trimestre - 1) * 3 + 1;
//                $mesFinal = $trimestre * 3;
//
//                // Use as funções DATEPART ou MONTH, dependendo do seu sistema de banco de dados
//                // Exemplo para MySQL:
//                $query->andWhere(['BETWEEN', 'MONTH(primeiroReporte)', $mesInicial, $mesFinal]);
//            }

            if (!empty($trimestre)) {
                $mesInicial = ($trimestre - 1) * 3 + 1;
                $mesFinal = $trimestre * 3;

                $query->andWhere(['OR',
                    ['<', 'YEAR(primeiroReporte)', $ano],
                    ['AND',
                        ['=', 'YEAR(primeiroReporte)', $ano],
                        ['BETWEEN', 'MONTH(primeiroReporte)', $mesInicial, $mesFinal],
                    ],
                ]);
            }

            if (!empty($provincia)) {
                $query->andWhere(['provinciaID' => $provincia]);
            }
            if (!empty($municipio)) {
                $query->andWhere(['municipioID' => $municipio]);
            }

            // Verifica se a tabela tem o campo "localidadeID" antes de adicioná-lo à consulta
            if ($tabela != 'eventos' && $tabela != 'doccomunicacao' && !empty($localidade)) {
                $query->andWhere(['localidadeID' => $localidade]);
            }

            // Verifica se a tabela é diferente de 'doccomunicacao' antes de verificar a entidade
            if ($tabela != 'doccomunicacao' && !empty($entidade)) {
                $query->andWhere(['entidade' => $entidade]);
            }


            // Executar a consulta
            $this->results[$tabela] = $query->all();
            //  $this->$results
        }





        // Use esses parâmetros para construir uma consulta para buscar resultados no banco de dados
        //  $query = YourModel::find();
//        if (!empty($province)) {
//            $query->andWhere(['province' => $province]);
//        }
//
//        // Repita o processo para outros parâmetros de pesquisa
//        // Execute a consulta
//        $results = $query->all();

        $provincias = Provincia::find()->all();

        $provinciaArray = [];
// Percorra os resultados da consulta e crie o array manualmente
        foreach ($provincias as $provincia) {
            $provinciaArray[$provincia->Id] = $provincia->nomeProvincia;
        }

        // Gráfico de quantidade de ECAS por província
        $dataGruposPorProvincia = [['Provincia', 'Quantidade de ECAS', ['role' => 'style']]];

        $queryGrupos = Yii::$app->db->createCommand('
        SELECT p.nomeProvincia AS Provincia, COUNT(g.Id) AS QuantidadeDeGrupos
        FROM provincia AS p
        LEFT JOIN grupo AS g ON p.Id = g.provinciaID
        GROUP BY p.nomeProvincia
        ')->queryAll();

        $totalGrupos = 0;

        foreach ($queryGrupos as $row) {
            $totalGrupos += (int) $row['QuantidadeDeGrupos'];
        }

        foreach ($queryGrupos as $row) {
            $quantidadeGrupos = (int) $row['QuantidadeDeGrupos'];
            $provinciaNome = $row['Provincia'];

            // Defina a cor da barra total (por exemplo, vermelho)
            $cor = $provinciaNome === 'Total' ? 'color: red;
        ' : '';

            $dataGruposPorProvincia[] = [$provinciaNome, $quantidadeGrupos, $cor];
        }

        // Adicione a barra total ao final
        $dataGruposPorProvincia[] = ['Total', $totalGrupos, 'color: green;
        '];

        $chartGoogleGruposPorProvincia = GoogleChart::widget([
                    'visualization' => 'ColumnChart',
                    'data' => $dataGruposPorProvincia,
                    'options' => [
                        'title' => 'Quantidade de ECAS por Província',
                        'hAxis' => [
                            'title' => 'Provincia'
                        ],
                        'vAxis' => [
                            'title' => 'Quantidade de ECAS'
                        ],
                        'width' => '100%',
                        'height' => 500,
                        'backgroundColor' => ['fill' => 'transparent']
                    ]
        ]);

        // Gráfico de quantidade de nSessoeTeoPrat por província
        $dataSessoesPorProvincia = [['Provincia', 'Quantidade de nSessoeTeoPrat']];

        $querySessoes = Yii::$app->db->createCommand('
        SELECT
        p.nomeProvincia AS Provincia,
        SUM(p1.nSessoeTeoPrat) AS QuantidadeDeSessoes
        FROM provincia AS p
        LEFT JOIN grupo AS p1 ON p.id = p1.provinciaID
        GROUP BY p.nomeProvincia
        ')->queryAll();

        foreach ($querySessoes as $row) {
            $provinciaNome = $row['Provincia'];
            $quantidadeSessoes = (int) $row['QuantidadeDeSessoes'];

            $dataSessoesPorProvincia[] = [$provinciaNome, $quantidadeSessoes];
        }

        $chartGoogleSessoesPorProvincia = GoogleChart::widget([
                    'visualization' => 'ColumnChart',
                    'data' => $dataSessoesPorProvincia,
                    'options' => [
                        'title' => 'Quantidade de nSessoeTeoPrat por Província',
                        'hAxis' => [
                            'title' => 'Provincia'
                        ],
                        'vAxis' => [
                            'title' => 'Quantidade de nSessoeTeoPrat'
                        ],
                        'width' => '100%',
                        'height' => 500,
                        'backgroundColor' => ['fill' => 'transparent']
                    ],
        ]);

        // Gráfico de quantidade de municípios relacionados com a tabela "água" por província
        $dataMunicipiosAgua = [['Província', 'Quantidade de Municípios']];

        $queryMunicipiosAgua = Yii::$app->db->createCommand('
        SELECT p.nomeProvincia AS Província, COUNT(DISTINCT a.municipioID) AS QuantidadeDeMunicípios
        FROM provincia AS p
        LEFT JOIN agua AS a ON p.Id = a.provinciaID
        GROUP BY p.nomeProvincia
        ')->queryAll();

        foreach ($queryMunicipiosAgua as $row) {
            $província = $row['Província'];
            $quantidadeMunicípios = (int) $row['QuantidadeDeMunicípios'];

            $dataMunicipiosAgua[] = [$província, $quantidadeMunicípios];
        }

        $chartGoogleMunicipiosAgua = GoogleChart::widget([
                    'visualization' => 'ColumnChart',
                    'data' => $dataMunicipiosAgua,
                    'options' => [
                        'title' => 'Municípios
        com perfis de vulnerabilidade definidos',
                        'hAxis' => [
                            'title' => 'Província'
                        ],
                        'vAxis' => [
                            'title' => 'Quantidade de Municípios'
                        ],
                        'width' => '100%',
                        'height' => 500,
                        'backgroundColor' => ['fill' => 'transparent']
                    ]
        ]);

        return $this->render('index', [
                    'chartGoogleGruposPorProvincia' => $chartGoogleGruposPorProvincia,
                    'chartGoogleSessoesPorProvincia' => $chartGoogleSessoesPorProvincia,
                    'chartGoogleMunicipiosAgua' => $chartGoogleMunicipiosAgua,
                    'provinciaArray' => $provinciaArray,
                    'results' => $this->results,
        ]);
    }

    public function actionCalendario2() {
        // Carregue todos os registros com estado "Publicado"
        $model = \backend\models\Reforcoinstitucional::find()
                ->where(['estadoValidacao' => 'Publicado'])
                ->all();

        // Crie uma instância do modelo de evento
        $eventModel = new \backend\models\EventForm();

        // Verifique se o formulário de adição de eventos foi enviado
        if (Yii::$app->request->post('event')) {
            $eventData = Yii::$app->request->post('event');
            $event = new Google_Service_Calendar_Event([
                'summary' => $eventData['summary'],
                'description' => $eventData['description'],
                'start' => [
                    'dateTime' => $eventData['start'], // Data e hora de início
                    'timeZone' => 'America/New_York', // Fuso horário
                ],
                'end' => [
                    'dateTime' => $eventData['end'], // Data e hora de término
                    'timeZone' => 'America/New_York', // Fuso horário
                ],
            ]);

            // Substitua 'seu_id_do_calendario' pelo ID do seu calendário no Google Calendar
            $calendarId = 'https://calendar.google.com/calendar/embed?src=gugurai923%40gmail.com&ctz=America%2FHavana';

            // Configurar o cliente da API do Google
            $client = new Google_Client();
            $client->setAuthConfig('C:/Users/hp/Downloads/credential.json'); // Caminho para o arquivo JSON de credenciais
            $client->setClientSecret('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'); // Cole o client_secret aqui
            $client->setClientId('697537109983-s5brfieka4634p6sp0tljutbh2ccbk84.apps.googleusercontent.com'); // Cole o client_id aqui

            $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);

            // Criar um serviço Google Calendar
            $service = new Google_Service_Calendar($client);

            try {
                // Adicionar o evento ao Google Calendar
                $evento = $service->events->insert($calendarId, $event);

                // Redirecionar de volta para a página após a adição do evento
                return $this->redirect(['index']);
            } catch (Exception $e) {
                // Tratar o erro de forma apropriada, por exemplo, exibindo uma mensagem de erro
                Yii::$app->session->setFlash('error', 'Erro ao adicionar o evento ao Google Calendar: ' . $e->getMessage());
            }
        }

        // Continuar com a renderização da vista, incluindo os registros publicados e a instância $eventModel
// Gráfico de municípios com perfis de vulnerabilidade definidos
        $dataMunicipios = [['Provincia', 'NumeroDeMunicipios']];

        $query = Yii::$app->db->createCommand('
    SELECT p.nomeProvincia AS Provincia, COUNT(m.id) AS NumeroDeMunicipios
    FROM provincia AS p
    LEFT JOIN municipio AS m ON p.id = m.provinciaID
    GROUP BY p.nomeProvincia
')->queryAll();

        foreach ($query as $row) {
            $dataMunicipios[] = [$row['Provincia'], (int) $row['NumeroDeMunicipios']];
        }



        $chartGoogleMunicipios = GoogleChart::widget([
                    'visualization' => 'ColumnChart',
                    'data' => $dataMunicipios,
                    'options' => [
                        'title' => 'Municípios com perfis de vulnerabilidade definidos',
                        'hAxis' => [
                            'title' => 'Provincia',
                        ],
                        'vAxis' => [
                            'title' => 'Municipios',
                            'format' => '0', // Define o formato para números inteiros
                            'viewWindow' => [
                                'min' => 0, // Valor mínimo no eixo vertical
                            ],
                        ],
                        'width' => '100%',
                        'height' => 300,
                        'backgroundColor' => ['fill' => 'transparent'],
                        'annotations' => [
                            'alwaysOutside' => true, // Coloca as labels fora das barras
                            'textStyle' => [
                                'fontSize' => 12, // Tamanho da fonte das labels
                                'color' => '#000', // Cor das labels
                            ],
                        ],
                    ],
        ]);

        return $this->render('calendario2', ['model' => $model, 'eventModel' => $eventModel, 'chartGoogleMunicipios' => $chartGoogleMunicipios]);
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
//    public function actionLogout() {
//        Yii::$app->user->logout();
//        Yii::$app->session->destroy(); // Isso encerrará a sessão
//        return $this->redirect(['site/login']);
//     }

    public function actionLogout() {
        Yii::$app->user->logout();
        Yii::$app->session->destroy(); // Isso encerrará a sessão
        // return $this->redirect(Url::to(['site/login']));
        return $this->redirect(Yii::$app->urlManagerFrontend->createUrl(['site/login']));
//     $frontendLogoutUrl = Yii::$app->urlManagerFrontend->createUrl(['site/logout']);
//    return $this->redirect([$frontendLogoutUrl, 'logout' => true]);
    }

    public function actionFresan() {
        //$users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('fresan');
    }

    public function actionIndex2() {
        $users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('index', ['users' => $users]);
    }

    public function actionCalendario() {
        $client = new Google_Client();
        $client->setAuthConfig('C:/Users/hp/Downloads/credentials.json'); // Caminho para o arquivo JSON de credenciais
        $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
    }

    public function actionGraficos() {
        // Gráfico de municípios com perfis de vulnerabilidade definidos
        $dataMunicipios = [['Provincia', 'Municipios']];
        $query = Yii::$app->db->createCommand('
        SELECT p.nome AS Provincia, COUNT(r.provinciaID) AS Municipios
        FROM provincia AS p
        LEFT JOIN reforcoinstitucional AS r ON p.id = r.provinciaID
        GROUP BY p.nome
    ')->queryAll();
        foreach ($query as $row) {
            $dataMunicipios[] = [$row['Provincia'], (int) $row['Municipios']];
        }
        $chartGoogleMunicipios = GoogleChart::widget([
                    'visualization' => 'ColumnChart',
                    'data' => $dataMunicipios,
                    'options' => [
                        'title' => 'Municípios com perfis de vulnerabilidade definidos',
                        'hAxis' => [
                            'title' => 'Provincia'
                        ],
                        'vAxis' => [
                            'title' => 'Municipios'
                        ],
                        'width' => '100%',
                        'height' => 500,
                        'backgroundColor' => ['fill' => 'transparent']
                    ]
        ]);

        return $this->render('index', ['chartGoogleMunicipios' => $chartGoogleMunicipios]);
    }
    
      public function actionFolhatrimestral() {

        $ano = Yii::$app->request->get('ano');
        $provincia = Yii::$app->request->get('provincia');
        $municipio = Yii::$app->request->get('municipio');
        $localidade = Yii::$app->request->get('localidade');
        $entidade = Yii::$app->request->get('entidade');
        $trimestre = Yii::$app->request->get('trimestre'); // Obtenha o trimestre selecionado
        // Inicializar um array para armazenar os resultados de todas as tabelas
        // Tabelas a serem pesquisadas
        $tabelas = [
            'Agua',
            'Capacitacao',
            'demostracoesculinarias',
            'eventos',
            'grupo',
            'doccomunicacao',
            'materiais',
            'merendaescolar',
            'pacotepedagfresan',
            'profissionaissaude',
            'rastreio',
            'reforcoinstitucional',
            'supervisao',
            'suplementacao',
        ];

        // Loop através das tabelas
        foreach ($tabelas as $tabela) {
            $modelClass = 'backend\models\\' . $tabela;

            $query = Yii::createObject(['class' => $modelClass])->find()
                    ->andWhere(['<=', 'YEAR(primeiroReporte)', $ano]);

//            // Verifique se o trimestre está definido e adicione-o à consulta
//            if (!empty($trimestre)) {
//                // Converta o trimestre para o mês inicial e final
//                $mesInicial = ($trimestre - 1) * 3 + 1;
//                $mesFinal = $trimestre * 3;
//
//                // Use as funções DATEPART ou MONTH, dependendo do seu sistema de banco de dados
//                // Exemplo para MySQL:
//                $query->andWhere(['BETWEEN', 'MONTH(primeiroReporte)', $mesInicial, $mesFinal]);
//            }


            if (!empty($trimestre)) {
                $mesInicial = ($trimestre - 1) * 3 + 1;
                $mesFinal = $trimestre * 3;

                $query->andWhere(['OR',
                    ['<', 'YEAR(primeiroReporte)', $ano],
                    ['AND',
                        ['=', 'YEAR(primeiroReporte)', $ano],
                        ['BETWEEN', 'MONTH(primeiroReporte)', $mesInicial, $mesFinal],
                    ],
                ]);
            }

            if (!empty($provincia)) {
                $query->andWhere(['provinciaID' => $provincia]);
            }
            if (!empty($municipio)) {
                $query->andWhere(['municipioID' => $municipio]);
            }

            // Verifica se a tabela tem o campo "localidadeID" antes de adicioná-lo à consulta
            if ($tabela != 'eventos' && $tabela != 'doccomunicacao' && !empty($localidade)) {
                $query->andWhere(['localidadeID' => $localidade]);
            }

            // Verificar se a tabela é diferente de 'doccomunicacao' antes de verificar a entidade
            if ($tabela != 'doccomunicacao' && !empty($entidade)) {
                $query->andWhere(['entidade' => $entidade]);
            }

            // Executar a consulta
            $this->results[$tabela] = $query->all();
            //  $this->$results
        }





        // Use esses parâmetros para construir uma consulta para buscar resultados no banco de dados
        //  $query = YourModel::find();
//        if (!empty($province)) {
//            $query->andWhere(['province' => $province]);
//        }
//
//        // Repita o processo para outros parâmetros de pesquisa
//        // Execute a consulta
//        $results = $query->all();

        $provincias = Provincia::find()->all();

        $provinciaArray = [];
// Percorra os resultados da consulta e crie o array manualmente
        foreach ($provincias as $provincia) {
            $provinciaArray[$provincia->Id] = $provincia->nomeProvincia;
        }

        // Gráfico de quantidade de ECAS por província
        $dataGruposPorProvincia = [['Provincia', 'Quantidade de ECAS', ['role' => 'style']]];

        $queryGrupos = Yii::$app->db->createCommand('
        SELECT p.nomeProvincia AS Provincia, COUNT(g.Id) AS QuantidadeDeGrupos
        FROM provincia AS p
        LEFT JOIN grupo AS g ON p.Id = g.provinciaID
        GROUP BY p.nomeProvincia
        ')->queryAll();

        $totalGrupos = 0;

        foreach ($queryGrupos as $row) {
            $totalGrupos += (int) $row['QuantidadeDeGrupos'];
        }

        foreach ($queryGrupos as $row) {
            $quantidadeGrupos = (int) $row['QuantidadeDeGrupos'];
            $provinciaNome = $row['Provincia'];

            // Defina a cor da barra total (por exemplo, vermelho)
            $cor = $provinciaNome === 'Total' ? 'color: red;
        ' : '';

            $dataGruposPorProvincia[] = [$provinciaNome, $quantidadeGrupos, $cor];
        }

        // Adicione a barra total ao final
        $dataGruposPorProvincia[] = ['Total', $totalGrupos, 'color: green;
        '];

        $chartGoogleGruposPorProvincia = GoogleChart::widget([
                    'visualization' => 'ColumnChart',
                    'data' => $dataGruposPorProvincia,
                    'options' => [
                        'title' => 'Quantidade de ECAS por Província',
                        'hAxis' => [
                            'title' => 'Provincia'
                        ],
                        'vAxis' => [
                            'title' => 'Quantidade de ECAS'
                        ],
                        'width' => '100%',
                        'height' => 500,
                        'backgroundColor' => ['fill' => 'transparent']
                    ]
        ]);

        // Gráfico de quantidade de nSessoeTeoPrat por província
        $dataSessoesPorProvincia = [['Provincia', 'Quantidade de nSessoeTeoPrat']];

        $querySessoes = Yii::$app->db->createCommand('
        SELECT
        p.nomeProvincia AS Provincia,
        SUM(p1.nSessoeTeoPrat) AS QuantidadeDeSessoes
        FROM provincia AS p
        LEFT JOIN grupo AS p1 ON p.id = p1.provinciaID
        GROUP BY p.nomeProvincia
        ')->queryAll();

        foreach ($querySessoes as $row) {
            $provinciaNome = $row['Provincia'];
            $quantidadeSessoes = (int) $row['QuantidadeDeSessoes'];

            $dataSessoesPorProvincia[] = [$provinciaNome, $quantidadeSessoes];
        }

        $chartGoogleSessoesPorProvincia = GoogleChart::widget([
                    'visualization' => 'ColumnChart',
                    'data' => $dataSessoesPorProvincia,
                    'options' => [
                        'title' => 'Quantidade de nSessoeTeoPrat por Província',
                        'hAxis' => [
                            'title' => 'Provincia'
                        ],
                        'vAxis' => [
                            'title' => 'Quantidade de nSessoeTeoPrat'
                        ],
                        'width' => '100%',
                        'height' => 500,
                        'backgroundColor' => ['fill' => 'transparent']
                    ],
        ]);

        // Gráfico de quantidade de municípios relacionados com a tabela "água" por província
        $dataMunicipiosAgua = [['Província', 'Quantidade de Municípios']];

        $queryMunicipiosAgua = Yii::$app->db->createCommand('
        SELECT p.nomeProvincia AS Província, COUNT(DISTINCT a.municipioID) AS QuantidadeDeMunicípios
        FROM provincia AS p
        LEFT JOIN agua AS a ON p.Id = a.provinciaID
        GROUP BY p.nomeProvincia
        ')->queryAll();

        foreach ($queryMunicipiosAgua as $row) {
            $província = $row['Província'];
            $quantidadeMunicípios = (int) $row['QuantidadeDeMunicípios'];

            $dataMunicipiosAgua[] = [$província, $quantidadeMunicípios];
        }

        $chartGoogleMunicipiosAgua = GoogleChart::widget([
                    'visualization' => 'ColumnChart',
                    'data' => $dataMunicipiosAgua,
                    'options' => [
                        'title' => 'Municípios
        com perfis de vulnerabilidade definidos',
                        'hAxis' => [
                            'title' => 'Província'
                        ],
                        'vAxis' => [
                            'title' => 'Quantidade de Municípios'
                        ],
                        'width' => '100%',
                        'height' => 500,
                        'backgroundColor' => ['fill' => 'transparent']
                    ]
        ]);

        //  $totalECAs = $this->getTotalECAs(); // Chame a função para obter o total de ECAs


        return $this->render('folhatrimestral', [
                    'chartGoogleGruposPorProvincia' => $chartGoogleGruposPorProvincia,
                    'chartGoogleSessoesPorProvincia' => $chartGoogleSessoesPorProvincia,
                    'chartGoogleMunicipiosAgua' => $chartGoogleMunicipiosAgua,
                    'provinciaArray' => $provinciaArray,
                    'results' => $this->results,
                        //'totalECAs' => $totalECAs,
        ]);
    }

    public function actionExportfolhatrimestral() {
          $ano = Yii::$app->request->get('ano');
        $provincia = Yii::$app->request->get('provincia');
        $municipio = Yii::$app->request->get('municipio');
        $localidade = Yii::$app->request->get('localidade');
        $entidade = Yii::$app->request->get('entidade');
        $trimestre = Yii::$app->request->get('trimestre'); // Obtenha o trimestre selecionado
        // Inicializar um array para armazenar os resultados de todas as tabelas
        // Tabelas a serem pesquisadas
        $tabelas = [
            'Agua',
            'Capacitacao',
            'demostracoesculinarias',
            'eventos',
            'grupo',
            'doccomunicacao',
            'materiais',
            'merendaescolar',
            'pacotepedagfresan',
            'profissionaissaude',
            'rastreio',
            'reforcoinstitucional',
            'supervisao',
            'suplementacao',
        ];

        // Loop através das tabelas
        foreach ($tabelas as $tabela) {
            $modelClass = 'backend\models\\' . $tabela;

            $query = Yii::createObject(['class' => $modelClass])->find()
                    ->andWhere(['<=', 'YEAR(primeiroReporte)', $ano]);

//            // Verifique se o trimestre está definido e adicione-o à consulta
//            if (!empty($trimestre)) {
//                // Converta o trimestre para o mês inicial e final
//                $mesInicial = ($trimestre - 1) * 3 + 1;
//                $mesFinal = $trimestre * 3;
//
//                // Use as funções DATEPART ou MONTH, dependendo do seu sistema de banco de dados
//                // Exemplo para MySQL:
//                $query->andWhere(['BETWEEN', 'MONTH(primeiroReporte)', $mesInicial, $mesFinal]);
//            }


            if (!empty($trimestre)) {
                $mesInicial = ($trimestre - 1) * 3 + 1;
                $mesFinal = $trimestre * 3;

                $query->andWhere(['OR',
                    ['<', 'YEAR(primeiroReporte)', $ano],
                    ['AND',
                        ['=', 'YEAR(primeiroReporte)', $ano],
                        ['BETWEEN', 'MONTH(primeiroReporte)', $mesInicial, $mesFinal],
                    ],
                ]);
            }

            if (!empty($provincia)) {
                $query->andWhere(['provinciaID' => $provincia]);
            }
            if (!empty($municipio)) {
                $query->andWhere(['municipioID' => $municipio]);
            }

            // Verifica se a tabela tem o campo "localidadeID" antes de adicioná-lo à consulta
            if ($tabela != 'eventos' && $tabela != 'doccomunicacao' && !empty($localidade)) {
                $query->andWhere(['localidadeID' => $localidade]);
            }

            // Verificar se a tabela é diferente de 'doccomunicacao' antes de verificar a entidade
            if ($tabela != 'doccomunicacao' && !empty($entidade)) {
                $query->andWhere(['entidade' => $entidade]);
            }

            // Executar a consulta
            $this->results[$tabela] = $query->all();
            //  $this->$results
        }




         $grupo=$this->results;
//
//        if (isset($this->results)) {//se tiver uma consulta
//            $grupo=$this->results;
//            // Caminho para o documento DOCX Modelo existente com marcadores
//            $existingFile = 'C:\\xampp\\htdocs\\mvp\\admin\\uploads\\modelofolha.docx';
//            // $existingFile = 'C:/xampp/htdocs/mvp/admin/web/uploads/modelofolha.docx';
//// Crie uma instância do TemplateProcessor
//            $templateProcessor = new TemplateProcessor($existingFile);
//
//// Substitua os marcadores pelos valores desejados
//            $totalEcas = 0;
//
//            //Total de Ecas por provincia
//            $totalEcaNamibe = 0;
//            $totalEcaHuila = 0;
//            $totalEcaCunene = 0;
//            //Fim Total de Ecas por provincia
//            $metaECA = Meta::find()->where(['nomeMeta' => 'ECA'])->one()->valorMeta; //não é necessário um foreach porque é um valor único de uma tabela específica
//            if (isset($this->results)) {//verifica se tem resultados da pesquisa efetuada
//                // 
//                // $totalEcas = 50;// Consultar na DB foreach
//                if (isset($grupo['grupo'])) { // : FAZER O MESMO PARA OUTRAS TABELAS
//                    foreach ($this->results['grupo'] as $grupo) { //for each para pesquisar os dados da tabela grupo 
//                        //$this->variaveldapesquisa['nomedatabela'] as $variavelquerecebeosdadosdatabela
//                        // Verificar se o atributo "estadoValidacao" é igual a "Publicado"
//                        if ($grupo->estadoValidacao === 'Publicado') {
//                            $totalEcas++;
//                            //somar ecas, TotalCamponeses por provincia
//                            $provincia = $grupo->provinciaID; // Substitua 'provincia' pelo nome do campo que contém a província
//
//                            if ($provincia == 1) {
//                                $totalEcaNamibe++;
//                            } elseif ($provincia == 2) {
//                                $totalEcaHuila++;
//                            } elseif ($provincia == 3) {
//                                $totalEcaCunene++;
//                            }
//                        }
//                    }
//                }
//            }
//
//            $metaBene = Meta::find()->where(['nomeMeta' => 'camponeses apoiados'])->one()->valorMeta; //não é necessário um foreach porque é um valor único de uma tabela específica
//            $templateProcessor->setValue('{{bene}}', $metaBene);
//
//            $templateProcessor->setValue('{{Neca}}', $totalEcas);
//            $templateProcessor->setValue('{{Meca}}', $metaECA);
//            $templateProcessor->setValue('{{En}}', $totalEcaNamibe);
//            $templateProcessor->setValue('{{Eh}}', $totalEcaHuila);
//            $templateProcessor->setValue('{{Ec}}', $totalEcaCunene);         
//            $filename = 'FolhaTrimestral.docx';
//// Salve o documento modificado em um novo arquivo
//            $newFile = Yii::getAlias('@webroot/uploads') . '/' . $filename;
//            $templateProcessor->saveAs($newFile);
//
//// Envie o novo arquivo para download
//            if (file_exists($newFile)) {
//                Yii::$app->response->sendFile($newFile)->send();
//            } else {
//                // Trate o caso em que o arquivo não pode ser encontrado ou criado
//                Yii::$app->session->setFlash('error', 'Falha ao criar o arquivo DOCX.');
//                // Redirecione ou exiba uma mensagem de erro
//            }
//        } else {
//            // A variável não foi definida na primeira ação
//            echo 'A variável não está definida.';
//        }
                        return $this->render('fresan', ['grupo' => $this->results]);

    }

    /**
     * Esta ação lida com solicitações GET.
     * @return string
     */
  

    //funcao para obter o trimestre a partir da data, Essa função pega uma data no formato Y-m-d e retorna o trimestre correspondente.
    public function getQuarterFromDate($date) {
        $timestamp = strtotime($date);
        $quarter = ceil(date('n', $timestamp) / 3);
        return $quarter;
    }

    public function actionError() {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }
}
