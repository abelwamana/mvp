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
use backend\models\Event;
use backend\models\Selecao;
use DateTime;
use yii\helpers\ArrayHelper;
use backend\models\Municipio;
use backend\models\Comuna;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public $results = [];

//    public $entidadeSelected;

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
                        'actions' => ['logout', 'index', 'folhatrimestral', 'exportfolhatrimestral', 'calendario2', 'calendario', 'fresan', 'galeria', 'get-events', 'test', 'add-event', 'filtragem', 'duracao', 'get-provincias', 'experiencia', 'get-municipios', 'get-comunas','events-area', 'delete-selecao'],
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

    public function actionExperiencia() {
        return $this->actionGetComunas(8);
    }

    public function actionGetMunicipios($id) {
        //Yii::$app->response->format = Response::FORMAT_JSON;

        $municipios = Municipio::find()->where(['provinciaID' => $id])->all();
        $municipios_list = [];
        foreach ($municipios as $municipio) {
            $municipios_list[] = ['id' => $municipio->Id, 'nome' => $municipio->nomeMunicipio];
        }
        return json_encode($municipios_list);
    }

    public function actionGetComunas($id) {
        $comunas = Comuna::find()->where(['municipioID' => $id])->all();
        $comunas_list = [];
        foreach ($comunas as $comuna) {
            $comunas_list[] = ['id' => $comuna->Id, 'nome' => $comuna->nomeComuna];
        }
        return json_encode($comunas_list);
    }

//    public function actionGetProvincias()
//{
//    $provincias = Provincia::find()->all();
//    $data = [];
//    foreach ($provincias as $provincia) {
//        $data[] = [
//            'id' => $provincia->Id,
//            'nome' => $provincia->nomeProvincia
//        ];
//    }
//    return json_encode($data);
//}
//    
//
//    public static function getMunicipios($provinciaID)
//    {
//        return ArrayHelper::map(Municipio::find()->where(['provinciaID' => $provinciaID])->all(), 'Id', 'nomeMunicipio');
//    }
//
//    public static function getComunas($municipioID)
//    {
//        return ArrayHelper::map(Comuna::find()->where(['municipioID' => $municipioID])->all(), 'Id', 'nomeComuna');
//    }


    public function actionAddEvent() {
        $eventModel = new Event();

        if ($eventModel->load(Yii::$app->request->post()) && $eventModel->save()) {
            Yii::$app->session->setFlash('success', 'Evento adicionado com sucesso!');
            return $this->redirect(['site/calendario2']); // Redireciona de volta à página de calendário
        } else {
            Yii::$app->session->setFlash('error', 'Ocorreu um erro ao adicionar o evento.');
            return $this->redirect(['site/calendario2']); // Redireciona de volta à página de calendário
        }
    }

    public function actionDuracao($start, $end) {
        $startDateTime = new DateTime($start);
        $endDateTime = new DateTime($end);

        $interval = $startDateTime->diff($endDateTime);
        $hours = $interval->h;
        $hours += $interval->days * 24;

        // Retorne a duração do evento como resposta AJAX
        echo $hours;
    }

    public function actionDeleteSelecao() {
        // Execute a linha de código para deletar todos os registros de Selecao
        Selecao::deleteAll();

        // Retorne uma resposta para indicar o sucesso da operação
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return ['success' => true];
    }

    public function actionFiltragem() {
        $entidade = null;
        $provincia = null;
        $area = null;
        $entidade = Yii::$app->request->get('entidade');
        $provincia = Yii::$app->request->get('provincia');
        $area = Yii::$app->request->get('area');

        if (!empty($entidade) || !empty($provincia) || !empty($area)) {
            $selecaoModel = new \backend\models\Selecao();
            $selecaoModel->endidade = $entidade; // Define o valor da entidade no modelo
            $selecaoModel->provincia = $provincia; // Define o valor da província no modelo
            $selecaoModel->area = $area; // Define o valor da área no modelo

            if ($selecaoModel->save()) {
                //Yii::$app->session->setFlash('success', 'Critério de filtragem bem selecionado(s)!');
            } else {
                Yii::$app->session->setFlash('error', 'Ocorreu um erro ao salvar a selecão para o filtro.');
                var_dump($selecaoModel->errors);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Nenhum criterio de filtragem foi selecionado.');
            \backend\models\Selecao::deleteAll();
        }

        // Redirecionar para onde você precisar após o processamento do formulário
        return $this->redirect(['site/calendario2', 'area' => 'inicio']);
    }
    
    public function actionEventsArea($area) {
        $entidade=null; 
        $provincia=null;
        if (!($area=="inicio") ) {
        if (!($area==null) & !empty($area)) {
            
            $selecaoModel = new \backend\models\Selecao();
            $selecaoModel->endidade = $entidade; // Define o valor da entidade no modelo
            $selecaoModel->provincia = $provincia; // Define o valor da província no modelo
            $selecaoModel->area = $area; // Define o valor da área no modelo

            if ($selecaoModel->save()) {
                //Yii::$app->session->setFlash('success', 'Critério de filtragem bem selecionado(s)!');
            } else {
                Yii::$app->session->setFlash('error', 'Ocorreu um erro ao salvar a area para o filtro.');
                var_dump($selecaoModel->errors);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Nenhum evento desta area.');
            \backend\models\Selecao::deleteAll();
        }

        // Redirecionar para onde você precisar após o processamento do formulário
       // return $this->redirect(['site/calendario2']);
    }
    }

    
    public function actionCalendario2($area) {
//        $entidade = Yii::$app->request->get('entidade');
//         if (!empty($entidade)) {
//               $this->entidadeSelected=$entidade;
//              // return $this->render('fresan');
//              
//            }
        $this->actionEventsArea($area);
// Crie uma instância do modelo de evento
        $provincias = Provincia::find()->all();
        $provinciasList = [];
        foreach ($provincias as $provincia) {
            $provinciasList[$provincia->Id] = $provincia->nomeProvincia; // Supondo que o nome da província está na coluna 'nome'
        }

        $eventModel = new \backend\models\Event();
        // Verifique se o formulário de adição de eventos foi enviado
        if (Yii::$app->request->post('Event')) {
            $eventData = Yii::$app->request->post('Event');
            if ($eventData !== null) {
                $calendarEvento = new \backend\models\Event();
                $calendarEvento->load(Yii::$app->request->post()); // Carregar dados diretamente do POST
                if ($calendarEvento->save()) {
                    Yii::$app->session->setFlash('success', 'Evento salvo com sucesso!');
                } else {
                    Yii::$app->session->setFlash('error', 'Ocorreu um erro ao salvar o evento.');
                    var_dump($calendarEvento->errors);
                }
            }
        }
        return $this->render('calendario2', [
                    'eventModel' => $eventModel, 'provinciasList' => $provinciasList,
        ]);
    }

// Ação para recuperar os eventos)
    public function actionGetEvents() {
//    $entidade = Yii::$app->request->get('entidade');
//    if (!empty($entidade)) {
//        $this->entidadeSelected = $entidade;
//        //return $this->render('index');
//    }
        // $this->entidadeSelected='UIC';
        Yii::$app->response->format = Response::FORMAT_JSON;

        // Inicializa a query de eventos
        $events = new \backend\models\Event();
        $selecoes = \backend\models\Selecao::find()->all();
        $entidade = null;
        $area = null;
        $provincia = null;
        foreach ($selecoes as $selecao) {
            $entidade = $selecao->endidade;
            $area = $selecao->area;
            $provincia = $selecao->provincia;
        }
        // Se os critérios da consulta foram definidos e não são nulos
//        if (isset($entidade, $area, $provincia)) {
//            // Inicializa a query de eventos com os filtros selecionados
//            $query = \backend\models\Event::find()
//                    ->andWhere([
//                'entidadeOrganizadora' => $entidade,
//                'localizacao' => $provincia,
//                'area' => $area,
//            ]);
        //     } 
        if (!empty($entidade) & !($entidade == null) & !empty($area) & !($area == null)) {
            // Inicializa a query de eventos com os filtros de entidade e área selecionados
            $query = \backend\models\Event::find()
                    ->andWhere([
                'entidadeOrganizadora' => $entidade,
                'area' => $area,
            ]);
        } elseif (!empty($entidade) & !($entidade == null) & !empty($provincia) & !($provincia == null)) {
            // Inicializa a query de eventos com os filtros de entidade e província selecionados
            $provinciaID = Provincia::find()->select('Id')->where(['nomeProvincia' => $provincia])->scalar();
            $query = \backend\models\Event::find()
                    ->andWhere([
                'entidadeOrganizadora' => $entidade,
                'provinciaID->' => $provinciaID,
            ]);
        }
        if (!empty($provincia) & !($provincia == null) & !empty($area) & !($area == null)) {
            // Inicializa a query de eventos com os filtros de entidade e área selecionados
            $provinciaID = Provincia::find()->select('Id')->where(['nomeProvincia' => $provincia])->scalar();
            $query = \backend\models\Event::find()
                    ->andWhere([
                'provinciaID' => $provinciaID,
                'area' => $area,
            ]);
        } elseif (!empty($entidade) & !($entidade == null)) {
            // Inicializa a query de eventos com o filtro de entidade selecionado
            $query = \backend\models\Event::find()
                    ->andWhere(['entidadeOrganizadora' => $entidade]);
        } elseif (!empty($provincia) & !($provincia == null)) {
            // Inicializa a query de eventos com o filtro de entidade selecionado
            $provinciaID = Provincia::find()->select('Id')->where(['nomeProvincia' => $provincia])->scalar();

        // Consulta ajustada usando o provinciaID
            $query = \backend\models\Event::find()->andWhere(['provinciaID' => $provinciaID]);
           
        } elseif (!empty($area) & !($area == null)) {
            // Inicializa a query de eventos com o filtro de entidade selecionado
            $query = \backend\models\Event::find()
                    ->andWhere(['area' => $area]);
        } else {
            // Se nenhum filtro foi selecionado, retorna todos os eventos
            $query = \backend\models\Event::find();
        }

        // Executa a query para recuperar os eventos filtrados
        $events = $query->all();

        // Formata os eventos para serem enviados como JSON
        $formattedEvents = [];
        foreach ($events as $event) {
            $formattedEvents[] = [
                'summary' => $event->summary,
                'description' => $event->description,
                'area' => $event->area,
                'start' => $event->start,
                'end' => $event->end,
                'duracao' => $event->duracao,
                'provincia' => $event->provincia->nomeProvincia,
                'municipio' => $event->municipio->nomeMunicipio,
                'comuna' => $event->comuna->nomeComuna,
                'local' => $event->local,
                'coordenadas' => $event->coordenadas,
                'entidadeOrganizadora' => $event->entidadeOrganizadora,
                'convocadoPor' => $event->convocadoPor,
                'participantes' => $event->participantes,
            ];
        }
        // \backend\models\Selecao::deleteAll();
        //Por uma variavel enviado a renderizar a pagina. no inicio perguntar. por variavel apagar =0 e apagar=1 zero desde renderização dao filtrafem
        return $formattedEvents;
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
        return $this->render('fresan');
    }

    public function actionGaleria() {
        return $this->render('galeria');
    }

    public function actionIndex2() {
        $users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('index', ['users' => $users]);
    }

//    public function actionCalendario() {
//        $client = new Google_Client();
//        $client->setAuthConfig('C:/Users/hp/Downloads/credentials.json'); // Caminho para o arquivo JSON de credenciais
//        $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
//    }

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

        if (isset($this->results)) {//se tiver uma consulta
            // Caminho para o documento DOCX Modelo existente com marcadores
            $existingFile = 'C:\\xampp\\htdocs\\mvp\\admin\\uploads\\modelofolha.docx';

// Crie uma instância do TemplateProcessor
            $templateProcessor = new TemplateProcessor($existingFile);

// Substitua os marcadores pelos valores desejados
            $totalEcas = 0;
            $metaECA = Meta::find()->where(['nomeMeta' => 'ECA'])->one()->valorMeta; //não é necessário um foreach porque é um valor único de uma tabela específica
//            if (isset($this->results)) {//verifica se tem resultados da pesquisa efetuada
//                if (isset($grupo['grupo'])) {                   
//                    foreach ($this->results['grupo'] as $grupo) { //for each para pesquisar os dados da tabela grupo
//                        //$this->variaveldapesquisa['nomedatabela'] as $variavelquerecebeosdadosdatabela
//                        // Verificar se o atributo "estadoValidacao" é igual a "Publicado"
//                        if ($grupo->estadoValidacao === 'Publicado') {                              
//                            $totalEcas++;
//                        }
//                    }
//                }
//            }
            $totalEcas = 40;
            if (isset($this->results['grupo'])) {

                foreach ($this->results['grupo'] as $grupo) {
                    // Verificar se o atributo "estadoValidacao" é igual a "Publicado"
                    // if ($grupo->estadoValidacao === 'Publicado') {
                    $totalEcas++;
                    // }
                }
            }


            $templateProcessor->setValue('{{Neca}}', $totalEcas);
            $templateProcessor->setValue('{{Meca}}', $metaECA);
            $templateProcessor->setValue('{{Ec}}', $metaECA);
            $templateProcessor->setValue('{{Eh}}', $metaECA);
            $templateProcessor->setValue('{{En}}', $metaECA);

            $filename = 'FolhaTrimestral.docx';
// Salve o documento modificado em um novo arquivo
            $newFile = Yii::getAlias('@webroot/uploads') . '/' . $filename;
            $templateProcessor->saveAs($newFile);

// Envie o novo arquivo para download
            if (file_exists($newFile)) {
                Yii::$app->response->sendFile($newFile)->send();
            } else {
                // Trate o caso em que o arquivo não pode ser encontrado ou criado
                Yii::$app->session->setFlash('error', 'Falha ao criar o arquivo DOCX.');
                // Redirecione ou exiba uma mensagem de erro
            }
        } else {
            // A variável não foi definida na primeira ação
            echo 'A variável não está definida.';
        }
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
