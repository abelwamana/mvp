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
use DateTime;
use backend\models\Municipio;
use backend\models\Comuna;
use backend\models\Contacto;
use backend\models\User;

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
                        'actions' => ['logout', 'index', 'folhatrimestral', 'exportfolhatrimestral', 'calendario2', 'fresan', 'beneficiario', 'galeria', 'get-events', 'filtragem', 'duracao', 'get-provincias', 'experiencia', 'get-municipios', 'get-comunas', 'events-area', 'add-events', 'emconstrucao', 'fresancunene', 'fresanhuila', 'fresannamibe', 'resultadosagricultura', 'resultadosnutricao', 'resultadosagua', 'resultadosreforcoinstitucional'],
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
        $query = \backend\models\Event::find()->all();
        // Data e hora de início
        $startDateTime = $query = \backend\models\Event::find()
                ->select('start') // Seleciona apenas a coluna 'start'
                ->orderBy(['id' => SORT_DESC]) // Ordena pela chave primária em ordem decrescente
                ->scalar(); // Retorna apenas um valor escalar
        // Data e hora de término
        $endDateTime = $query = \backend\models\Event::find()
                ->select('end') // Seleciona apenas a coluna 'start'
                ->orderBy(['id' => SORT_DESC]) // Ordena pela chave primária em ordem decrescente
                ->scalar(); // Retorna apenas um valor escalar
        $startDateTime = new DateTime($startDateTime);
        $endDateTime = new DateTime($endDateTime);
        $this->actionDuracao($startDateTime, $endDateTime);
    }

    public function actionGetMunicipios($id) {

        $limite = 10;
        if ($id == 2) {

            $limite = 7;
        }

        $municipios = Municipio::find()
                ->where(['provinciaID' => $id])
                ->limit($limite) // Limita o resultado a três municípios
                ->all();

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

    public function actionDuracao($start, $end) {
        $startDateTime = new DateTime($start);
        $endDateTime = new DateTime($end);

        $interval = $startDateTime->diff($endDateTime);

        // Calcular a duração total em minutos
        $totalMinutes = $interval->days * 24 * 60;
        $totalMinutes += $interval->h * 60;
        $totalMinutes += $interval->i; // Adicionar os minutos ao total
        // Calcular as horas e minutos separadamente
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        // Formatar a duração para exibir horas e minutos
        $duration = sprintf('%02d:%02d', $hours, $minutes);

        // Retornar a duração formatada como resposta AJAX
        echo $duration;
    }

//    public function actionFiltragem() {
//        $entidade = null;
//        $provincia = null;
//        $area = null;
//        $entidade = Yii::$app->request->get('entidade');
//        $provincia = Yii::$app->request->get('provincia');
//        $area = Yii::$app->request->get('area');
//
//        if (!empty($entidade) || !empty($provincia) || !empty($area)) {
//            $selecaoModel = new \backend\models\Selecao();
//            $selecaoModel->endidade = $entidade; // Define o valor da entidade no modelo
//            $selecaoModel->provincia = $provincia; // Define o valor da província no modelo
//            $selecaoModel->area = $area; // Define o valor da área no modelo
//
//            if ($selecaoModel->save()) {
//                //Yii::$app->session->setFlash('success', 'Critério de filtragem bem selecionado(s)!');
//            } else {
//                Yii::$app->session->setFlash('error', 'Ocorreu um erro ao salvar a selecão para o filtro.');
//                var_dump($selecaoModel->errors);
//            }
//        } else {
//            Yii::$app->session->setFlash('error', 'Nenhum criterio de filtragem foi selecionado.');
//        }
//
//        // Redirecionar para onde você precisar após o processamento do formulário
//        return $this->redirect(['site/calendario2', 'area' => 'inicio']);
//    }
//    public function actionEventsArea($area) {
//        $entidade = null;
//        $provincia = null;
//        if (!($area == "inicio")) {
//            if (!($area == null) & !empty($area)) {
//
//                $selecaoModel = new \backend\models\Selecao();
//                $selecaoModel->endidade = $entidade; // Define o valor da entidade no modelo
//                $selecaoModel->provincia = $provincia; // Define o valor da província no modelo
//                $selecaoModel->area = $area; // Define o valor da área no modelo
//
//                if ($selecaoModel->save()) {
//                    //Yii::$app->session->setFlash('success', 'Critério de filtragem bem selecionado(s)!');
//                } else {
//                    Yii::$app->session->setFlash('error', 'Ocorreu um erro ao salvar a area para o filtro.');
//                    var_dump($selecaoModel->errors);
//                }
//            } else {
//                Yii::$app->session->setFlash('error', 'Nenhum evento desta area.');
//                \backend\models\Selecao::deleteAll();
//            }
//
//            // Redirecionar para onde você precisar após o processamento do formulário
//            // return $this->redirect(['site/calendario2']);
//        }
//    }

    public function actionCalendario2() {
        $entidadesSelecionadas = Yii::$app->request->get('entidades');
        $provinciasSelecionadas = Yii::$app->request->get('provincias');
        $areasSelecionadas = Yii::$app->request->get('areas');

        $provincias = Provincia::find()->all();
        $provinciasList = [];
        $limit = 4; // Defina o número de elementos que deseja manter
// Use array_slice para pegar apenas os primeiros N elementos
        foreach (array_slice($provincias, 0, $limit) as $provincia) {
            $provinciasList[$provincia->Id] = $provincia->nomeProvincia;
        }

        $eventModel = new \backend\models\Event();

        return $this->render('calendario2', [
                    'eventModel' => $eventModel, 'provinciasList' => $provinciasList,
        ]);
    }

    public function actionAddEvents() {
        $provincias = Provincia::find()->all();
        $provinciasList = [];
        $limit = 4; // Defina o número de elementos que deseja manter
// Use array_slice para pegar apenas os primeiros N elementos
        foreach (array_slice($provincias, 0, $limit) as $provincia) {
            $provinciasList[$provincia->Id] = $provincia->nomeProvincia;
        }


        $eventModel = new \backend\models\Event();

        // Verifique se o formulário de adição de eventos foi enviado
        if (Yii::$app->request->post('Event')) {
            $eventData = Yii::$app->request->post('Event');
            if ($eventData !== null) {
                $calendarEvento = new \backend\models\Event();
                $calendarEvento->load(Yii::$app->request->post()); // Carregar dados diretamente do POST
                // Serializar os participantes antes de salvar
                $participantes = $calendarEvento->participantes;
                $titulo=$calendarEvento->summary;
                // $calendarEvento->participantes = serialize($participantes);
                // Transformar array de participantes em uma string formatada
                $participantesString = implode(',', $calendarEvento->participantes);
                $calendarEvento->participantes = $participantesString;
                // Suponha que $calendarEvento->start tenha o formato 'Y-m-d H:i:s'
                $dateTimeString = $calendarEvento->start;
                 $dataevento = date('d-m-Y', strtotime($dateTimeString)); // Obtém a data no formato 'dia-mês-ano'
                $anfitriaoNome = $calendarEvento->convocadoPor;
                $anfitriaoEmail = User::find()->select('email')
                                ->where(['nomeCompleto' => $anfitriaoNome])
                                ->scalar(); 
                 if ($anfitriaoEmail !== null) {
                            Yii::$app->mailer->compose()
                                    ->setTo(trim($anfitriaoEmail))
                                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                                    ->setSubject('Novo Evento Adicionado')
                                    ->setHtmlBody("Olá $anfitriaoNome,<br><br> Adicionou um novo evento ao <b>Calendário</b> para o dia <b>$dataevento,</b> com o nome <b>[$titulo].</b><br><br>  Para mais detalhes, clique <a href=\"https://sgi-fresancamoes.com/admin/calendario\">aqui.</a><br><br> Continuação de bom trabalho,<br><br> FRESAN/Camões, I.P.")
                                    ->send();
                        }
                    // Dividindo a string em data e hora
               
                if ($calendarEvento->save()) {
                    // Enviar notificações por email para os participantes
                    foreach ($participantes as $email) {
                        // Consulta para encontrar o nome do contacto com o email atual
                        $nomeContacto = Contacto::find()
                                ->select('nome')
                                ->where(['email' => $email])
                                ->scalar(); // Retorna o nome do primeiro contacto encontrado ou null se não houver

                        if ($nomeContacto !== null) {
                            Yii::$app->mailer->compose()
                                    ->setTo(trim($email))
                                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                                    ->setSubject('Novo Evento Adicionado')
                                    ->setHtmlBody("Olá $nomeContacto,<br><br> Contamos com a sua participação para o evento <b>[$titulo]</b> marcado para o dia <b>$dataevento,</b>. <br><br> Aceda ao <b>Calendário</b> para <a href=\"https://sgi-fresancamoes.com/admin/calendario\">mais detalhes.</a><br><br> Continuação de bom trabalho,<br><br> FRESAN/Camões, I.P.")
                                    ->send();
                        }
                    }
                    Yii::$app->session->setFlash('success', 'Evento criado e notificações enviadas!');
                } else {
                    Yii::$app->session->setFlash('error', 'Ocorreu um erro ao salvar o evento.');
                    var_dump($calendarEvento->errors);
                }
            }
        }

        return $this->render('calendario2', [
                    'eventModel' => $eventModel,
                    'provinciasList' => $provinciasList,
        ]);
    }

    public function actionGetEvents() {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $entidadesSelecionadas = Yii::$app->request->get('entidades');
        $provinciasSelecionadas = Yii::$app->request->get('provincias');
        $areasSelecionadas = Yii::$app->request->get('areas');
        //$areasSelecionadas =["Água"];
        $events = \backend\models\Event::find()->all();
        $formattedEvents = [];

        if (($entidadesSelecionadas !== null && !empty($entidadesSelecionadas)) || ($provinciasSelecionadas !== null && !empty($provinciasSelecionadas)) || ($areasSelecionadas !== null && !empty($areasSelecionadas))) {
            if (!empty($entidadesSelecionadas)) {
                foreach ($entidadesSelecionadas as $entidade) {
                    foreach ($events as $event) {
                        if ($entidade == $event->entidadeOrganizadora) {

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
                    }
                }
            }

            if (!empty($provinciasSelecionadas)) {
                foreach ($provinciasSelecionadas as $provincia) {
                    foreach ($events as $event) {
                        if ($provincia == $event->provincia->nomeProvincia) {
                            if (!in_array($event, $formattedEvents)) {
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
                        }
                    }
                }
            }

            if (!empty($areasSelecionadas)) {
                foreach ($areasSelecionadas as $area) {
                    foreach ($events as $event) {
                        if ($area == $event->area) {
                            if (!in_array($event, $formattedEvents)) {
                                $formattedEvents[] = $event;
                            }
                        }
                    }
                }
            }
        } else {
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
        }
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
    public function actionLogout() {
        Yii::$app->user->logout();
        Yii::$app->session->destroy(); // Isso encerrará a sessão
        //return $this->redirect(['site/login']);
        return $this->redirect(Yii::$app->urlManagerFrontend->createUrl(['site/login']));
    }

    public function actionFresan() {
        //$users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('fresan');
    }

    public function actionGaleria() {
        return $this->render('galeria');
    }

    public function actionBeneficiario() {

        return $this->render('beneficiario');
    }

    public function actionEmconstrucao() {
        //$users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('emconstrucao');
    }

    public function actionFresancunene() {
        //$users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('fresancunene');
    }

    public function actionFresanhuila() {
        //$users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('fresanhuila');
    }

    public function actionFresannamibe() {
        //$users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('fresannamibe');
    }

    public function actionResultadosagricultura() {
        //$users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('resultadosagricultura');
    }

    public function actionResultadosnutricao() {
        //$users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('resultadosnutricao');
    }

    public function actionResultadosagua() {
        //$users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('resultadosagua');
    }

    public function actionResultadosreforcoinstitucional() {
        //$users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('resultadosreforcoinstitucional');
    }

    public function actionIndex2() {
        $users = Reforcoinstitucional::find()->all(); // Recupera todos os dados
        return $this->render('index', ['users' => $users]);
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

    public function actionExportfolhatrimestral() {

        if (isset($this->results)) {//se tiver uma consulta
            // Caminho para o documento DOCX Modelo existente com marcadores
            $existingFile = 'https://sgi-fresancamoes.com/admin/uploads/modelofolha.docx';

// Crie uma instância do TemplateProcessor
            $templateProcessor = new TemplateProcessor($existingFile);

// Substitua os marcadores pelos valores desejados
            $totalEcas = 0;
            $metaECA = Meta::find()->where(['nomeMeta' => 'ECA'])->one()->valorMeta; //não é necessário um foreach porque é um valor único de uma tabela específica
            if (isset($this->results)) {//verifica se tem resultados da pesquisa efetuada
                $totalEcas = 50;
                if (isset($grupo['grupo'])) {

                    foreach ($this->results['grupo'] as $grupo) { //for each para pesquisar os dados da tabela grupo
                        //$this->variaveldapesquisa['nomedatabela'] as $variavelquerecebeosdadosdatabela
                        // Verificar se o atributo "estadoValidacao" é igual a "Publicado"
                        if ($grupo->estadoValidacao === 'Publicado') {
                            $totalEcas++;
                        }
                    }
                }
            }

            $templateProcessor->setValue('{{Neca}}', $totalEcas);
            $templateProcessor->setValue('{{Meca}}', $metaECA);

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
