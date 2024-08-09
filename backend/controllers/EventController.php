<?php

namespace backend\controllers;

use backend\models\Event;
use backend\models\EventSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Provincia;
use backend\models\Municipio;
use backend\models\Comuna;
use backend\models\User;
use backend\models\Contacto;
use Yii;
use yii\web\UploadedFile;
use backend\models\Notificacoes;

/**
 * EventController implements the CRUD actions for Event model.
 */
class EventController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return array_merge(
                parent::behaviors(),
                [
                    'verbs' => [
                        'class' => VerbFilter::className(),
                        'actions' => [
                            'delete' => ['POST'],
                        ],
                    ],
                ]
        );
    }

    /**
     * Lists all Event models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new EventSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionListaeventos() {
        // Busca todos os eventos do banco de dados
        $eventos = \backend\models\Event::find()->all();
//             $eventos= $this->actionGetEvents();   
        // Renderiza a visualização index.php e passa os eventos para ela
        return $this->render('listaeventos', [
                    'eventos' => $eventos,
        ]);
    }

    public function actionGetEvents() {
        $entidadesSelecionadas = Yii::$app->request->get('entidades');
        $provinciasSelecionadas = Yii::$app->request->get('provincias');
        $areasSelecionadas = Yii::$app->request->get('areas');
        $dataInicio = Yii::$app->request->get('dataInicio');
        $dataFim = Yii::$app->request->get('dataFim');

        // Obter eventos filtrados
        $events = Event::getFilteredEvents($entidadesSelecionadas, $provinciasSelecionadas, $areasSelecionadas, $dataInicio, $dataFim);

//    return $events;
        return $this->render('listaeventos', ['eventos' => $events]);
    }

    /**
     * Displays a single Event model.
     * @param int $Id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id) {
        return $this->render('view', [
                    'model' => $this->findModel($Id),
        ]);
    }

    /**
     * Creates a new Event model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new Event();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'Id' => $model->Id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Event model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id) {
        $provincias = Provincia::find()->all();
        $provinciasList = [];
        $limit = 4; // Defina o número de elementos que deseja manter      
        $isAdmin = Yii::$app->user->isGuest ? false : Yii::$app->user->can("Permissão de Administrador");
        $nomeLogado = Yii::$app->user->identity->nomeCompleto;
        $emailLogado = Yii::$app->user->identity->email;
        $model = new \backend\models\Event();
        $modelOrig = $this->findModel($Id);
        $model = $this->findModel($Id);
        $participantes = $model->participantes;
        $model->participantes = explode(',', $model->participantes);
        $titulo = $model->summary;
        // Transformar array de participantes em uma string formatada
        // Verificar se $model->participantes é um array antes de chamar implode
        if (is_array($model->participantes)) {
            $participantesString = implode(',', $model->participantes);
            $model->participantes = $participantesString;
        }
//        $participantesString = implode(',', $model->participantes);
//        $model->participantes = $participantesString;
        // Suponha que $model->start tenha o formato 'Y-m-d H:i:s'
        $dateTimeString = $model->start;
        $dataevento = date('d-m-Y', strtotime($dateTimeString)); // Obtém a data no formato 'dia-mês-ano'
        $anfitriaoNome = $model->convocadoPor;
        if ($isAdmin || ($nomeLogado == $model->convocadoPor)) {
            foreach (array_slice($provincias, 0, $limit) as $provincia) {
                $provinciasList[$provincia->Id] = $provincia->nomeProvincia;
            }
            if ($this->request->isPost && $model->load($this->request->post())) {
                // Verificar se os campos de upload de arquivo estão vazios antes de sobrescrevê-los
                // Verificar se os campos de upload de arquivo estão vazios antes de sobrescrevê-los
                $uploadedAgenda = UploadedFile::getInstance($model, 'agenda');
                if ($uploadedAgenda != null && !empty($uploadedAgenda)) {
                    $model->agenda = $uploadedAgenda;
                } elseif ($uploadedAgenda == null || empty($uploadedAgenda)) {
                    $model->agenda = $modelOrig->agenda;
                }
                $uploadedListaConvidados = UploadedFile::getInstance($model, 'listaConvidados');
                if ($uploadedListaConvidados != null && !empty($uploadedListaConvidados)) {
                    $model->listaConvidados = $uploadedListaConvidados;
                } elseif ($uploadedListaConvidados == null || empty($uploadedListaConvidados)) {
                    $model->listaConvidados = $modelOrig->listaConvidados;
                }

                $uploadedPada = UploadedFile::getInstance($model, 'pada');
                if ($uploadedPada != null && !empty($uploadedPada)) {
                    $model->pada = $uploadedPada;
                } elseif ($uploadedPada == null || empty($uploadedPada)) {
                    $model->pada = $modelOrig->pada;
                }

                $uploadedActaRelatorio = UploadedFile::getInstance($model, 'actaRelatorio');
                if ($uploadedActaRelatorio != null && !empty($uploadedActaRelatorio)) {
                    $model->actaRelatorio = $uploadedActaRelatorio;
                } elseif ($uploadedActaRelatorio == null || empty($uploadedActaRelatorio)) {
                    $model->actaRelatorio = $modelOrig->actaRelatorio;
                }

                $uploadedListaParticipantes = UploadedFile::getInstance($model, 'listaParticipantes');
                if ($uploadedListaParticipantes != null && !empty($uploadedListaParticipantes)) {
                    $model->listaParticipantes = $uploadedListaParticipantes;
                } elseif ($uploadedListaParticipantes == null || empty($uploadedListaParticipantes)) {
                    $model->listaParticipantes = $modelOrig->listaParticipantes;
                }
                // Tratamento para o campo de arquivos múltiplos 'outrosAnexos'
                $uploadedOutrosAnexos = UploadedFile::getInstances($model, 'outrosAnexos');
                if ($uploadedOutrosAnexos != null && !empty($uploadedOutrosAnexos)) {
                    $model->outrosAnexos = $uploadedOutrosAnexos;
                } elseif ($uploadedOutrosAnexos == null && empty($uploadedOutrosAnexos)) {
                    $model->outrosAnexos = $modelOrig->outrosAnexos;
                }

                if (is_array($model->participantes)) {
                    $participantesString = implode(',', $model->participantes);
                    $model->participantes = $participantesString;
                }
                $model->description = empty($model->description) ? "A confirmar" : $model->description;
                $model->coordenadas = empty($model->coordenadas) ? "A confirmar" : $model->coordenadas;
                $model->local = empty($model->local) ? "A confirmar" : $model->local;
                $model->outrosAnexos = empty($model->outrosAnexos) ? "A confirmar" : $model->outrosAnexos;
                $anfitriaoEmail = User::find()->select('email')
                        ->where(['nomeCompleto' => $anfitriaoNome])
                        ->scalar();
                if ($model->uploadFiles()) {
                    // Serializar 'outrosAnexos' antes de salvar
                    if (is_array($model->outrosAnexos)) {
                        $model->outrosAnexos = implode(',', $model->outrosAnexos);
                    }
                    if ($model->save(false)) {
                        $signature = "
                                        <div style=\"color: #003399;font-family: Georgia, serif; font-size: 11px;\">
                                        SGI FRESAN/Camões, I.P.
                                        <br>
                                        Email: geral@sgi-fresancamoes.com
                                        <br>
                                        <br>
                                        FRESAN | Fortalecimento da Resiliência e da Segurança Alimentar e Nutricional
                                        <br>
                                        Ação financiada pela União Europeia
                                        <br>
                                        Camões – Instituto da Cooperação e da Língua, I.P.
                                        </div>
                                        <br>
                                        <img src=\"https://sgi-fresancamoes.com/admin/images/rodapeEm.jpg\" alt=\"Imagem Rodapé\" style=\"width: 430px; max-width: 100%;\">
                                         ";
                        //  Enviar notificação por email ao anfitrião original do evento
                        if (($anfitriaoEmail !== null) && ($emailLogado == $anfitriaoEmail)) {
                            Yii::$app->mailer->compose()
                                    ->setTo(trim($anfitriaoEmail))
                                    ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                                    ->setSubject('Actualização de Evento' . '[' . $titulo . ']')
                                    ->setHtmlBody("Olá $anfitriaoNome,<br><br> Actualizou o evento do <b>Calendário</b> para o dia <b>$dataevento,</b> com o nome <b>[$titulo].</b><br><br>  Para mais detalhes, clique <a href=\"https://sgi-fresancamoes.com/admin/calendario\">aqui.</a><br><br> Continuação de bom trabalho,<br><br> $signature")
                                    ->send();
                        }
                        // Email ao Administrador que actualizou o evento
                        else if (($emailLogado !== null)) {
                            $email = trim($email);
                            // Verificar se o email é válido
                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                Yii::$app->mailer->compose()
                                        ->setTo(trim($emailLogado))
                                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                                        ->setSubject('Actualização de Evento' . '[' . $titulo . ']')
                                        ->setHtmlBody("Olá $nomeLogado,<br><br> Actualizou o evento do <b>Calendário</b> para o dia <b>$dataevento,</b> com o nome <b>[$titulo].</b><br><br>  Para mais detalhes, clique <a href=\"https://sgi-fresancamoes.com/admin/calendario\">aqui.</a><br><br> Continuação de bom trabalho,<br><br> $signature")
                                        ->send();
                                // Email ao anfitrião que não actualizou o evento
                                Yii::$app->mailer->compose()
                                        ->setTo(trim($anfitriaoEmail))
                                        ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                                        ->setSubject('Evento Actualizado' . '[' . $titulo . ']')
                                        ->setHtmlBody("Olá $anfitriaoNome,<br><br>Foi actualizado pela administração o evento <b>[$titulo]</b> adicionado por si ao <b>Calendário</b>, para o dia <b>$dataevento,</b> com .</b><br><br>  Para mais detalhes, clique <a href=\"https://sgi-fresancamoes.com/admin/calendario\">aqui.</a><br><br> Continuação de bom trabalho,<br><br> $signature")
                                        ->send();
                            }
                        }
                        // Enviar notificações por email para os participantes
                        $currentDate = new \DateTime();
                        $eventStartDate = new \DateTime($model->start);
//                    var_dump($participantesArray[0]);
                        if ($model->participantes != "Por confirmar em breve" && $model->participantes != "A confirmar" && $eventStartDate >= $currentDate) {
                            $participantesArray = explode(',', $model->participantes);
                            foreach ($participantesArray as $email) {
                                $email = trim($email);
                                // Verificar se o email é válido
                                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                    // Consulta para encontrar o nome do contacto com o email atual
                                    $nomeContacto = Contacto::find()
                                            ->select('nome')
                                            ->where(['email' => $email])
                                            ->scalar(); // Retorna o nome do primeiro contacto encontrado ou null se não houver

                                    if ($nomeContacto !== null) {
                                        Yii::$app->mailer->compose()
                                                ->setTo(trim($email))
                                                ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
                                                ->setSubject('Actualização de Evento' . '[' . $titulo . ']')
                                                ->setHtmlBody("Olá $nomeContacto,<br><br> Foi actualizado o evento <b>[$titulo]</b> convocado por $anfitriaoNome para o dia <b>$dataevento,</b>. <br><br> Aceda ao <b>Calendário</b> para <a href=\"https://sgi-fresancamoes.com/admin/calendario\">mais detalhes.</a><br><br> Continuação de bom trabalho,<br><br> $signature")
                                                ->send();
                                    }
                                }
                            }
                        }
                        // Adicionar notificação
                        // Após salvar o novo evento
                        $usuarios = User::find()->all(); // Ou uma query para selecionar os usuários que devem receber a notificação
                        foreach ($usuarios as $usuario) {
                            $notificacao = new Notificacoes();
                            $notificacao->mensagem = "Evento [$titulo] actualizado";
                            $notificacao->estado = 0; // não lida
                            $notificacao->id_event = $model->Id;
                            $notificacao->id_usuario = $usuario->id;
                            $notificacao->save();
                        }
                        Yii::$app->session->setFlash('success', 'Evento actualizado e notificações enviadas!');
                        return $this->redirect(['site/calendario']);
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Não foi possível fazeer upload dos arquivos');
                    return $this->render('update', [
                                'model' => $model,
                                'provinciasList' => $provinciasList,
                    ]);
                }
            }
            else {
            return $this->render('update', [
                        'model' => $model,
                        'provinciasList' => $provinciasList,
            ]);
            }
        } else {
            Yii::$app->session->setFlash('error', 'So o Administrador ou anfitrião pode alterar eventos');
//                var_dump("Experiencia");
            return $this->redirect(['site/calendario']);
        }
    }

//    public function actionRemoveAnexo($id, $anexo) {
//    $model = $this->findModel($id);
//
//    $anexosArray = explode(',', $model->outrosAnexos);
//    if (($key = array_search($anexo, $anexosArray)) !== false) {
//        unset($anexosArray[$key]);
//        $model->outrosAnexos = implode(',', $anexosArray);
//        
//        if ($model->save(false)) {
//            return json_encode(['success' => true]);
//        } else {
//            return json_encode(['success' => false, 'message' => 'Erro ao salvar o modelo.']);
//        }
//    } else {
//        return json_encode(['success' => false, 'message' => 'Anexo não encontrado.']);
//    }
//}

    public function actionRemoveAnexo() {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $id = Yii::$app->request->post('id');
    $anexo = Yii::$app->request->post('anexo');

    if ($id && $anexo) {
        $model = $this->findModel($id);
        $anexosArray = explode(',', $model->outrosAnexos);

        if (($key = array_search($anexo, $anexosArray)) !== false) {
            unset($anexosArray[$key]);
            $model->outrosAnexos = implode(',', $anexosArray);

            if ($model->save(false)) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Erro ao salvar o modelo.'];
            }
        } else {
            return ['success' => false, 'message' => 'Anexo não encontrado.'];
        }
    } else {
        return ['success' => false, 'message' => 'ID ou Anexo ausente.'];
    }
}

    public function actionGetEventDetails($id) {
        $notificacao = Notificacoes::findOne($id);
        if ($notificacao !== null) {
            // Atualizar o estado da notificação
            $notificacao->estado = 1;
            $notificacao->save();
            $event = Event::findOne($notificacao->id_event);
            if ($event !== null) {
                return $this->asJson([
//                       'id' => $event->Id,
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
                            'agenda' => $event->agenda,
                            'actaRelatorio' => $event->actaRelatorio,
                            'listaParticipantes' => $event->listaParticipantes,
                ]);
            }
        }
        throw new \yii\web\NotFoundHttpException('Evento não encontrado.');
    }

    // No seu controlador
    public function actionGetNotifications() {
        $notificacoesEventos = Notificacoes::find()
                ->where(['id_usuario' => Yii::$app->user->id, 'estado' => 0])
                ->all();

        $notifications = [];
        foreach ($notificacoesEventos as $notificacao) {
            $notifications[] = [
                'id' => $notificacao->Id,
                'mensagem' => $notificacao->mensagem,
            ];
        }

        $totalNotificacoes = count($notifications);

        if (Yii::$app->user->can('Permissao Validador de dados')) {
            $totalNotificacoes += $pendentesCount; // Ajuste conforme necessário
        }

        if (Yii::$app->user->can('Perfil Aprovação de dados')) {
            $totalNotificacoes += $validadosCount; // Ajuste conforme necessário
        }

        if (Yii::$app->user->can('Perfil Lancamento')) {
            $totalNotificacoes += $aprovadosCount; // Ajuste conforme necessário
        }

        return $this->asJson([
                    'totalNotificacoes' => $totalNotificacoes,
                    'notifications' => $notifications,
        ]);
    }

    public function actionGetNotification() {
        $userId = Yii::$app->user->id;
        $count = Notificacoes::find()
                ->where(['id_usuario' => $userId, 'estado' => 0])
                ->count();

        return $this->asJson(['totalNotificacoes' => $count]);
    }

    public function actionDelete($Id) {
        $this->findModel($Id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Event model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return Event the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id) {
        if (($model = Event::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionGetMunicipios($id) {
        //Yii::$app->response->format = Response::FORMAT_JSON;

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
}
