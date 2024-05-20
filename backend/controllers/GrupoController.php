<?php

namespace backend\controllers;

use backend\models\Fitofarmacosferramentas;
use backend\models\Grupo;
use backend\models\GrupoSearch;
use backend\models\Insumogrupo;
use backend\models\Reforcoinstitucional;
use scotthuangzl\googlechart\GoogleChart;
use Yii;
use yii\base\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * GrupoController implements the CRUD actions for Grupo model.
 */
class GrupoController extends Controller {

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
     * Lists all Grupo models.
     *
     * @return string
     */
    public function actionIndex() {

        $searchModel = new GrupoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Grupo model.
     * @param int $Id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id) {
        $model = $this->findModel($Id);
        // Verifica se o usuário logado tem a mesma entidade que a do registro
        if ($model->entidade !== Yii::$app->user->identity->entidade) {
            // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
            Yii::$app->session->setFlash('error', 'Você não tem permissão para VALIDAR este registro.');
            return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
        }

        return $this->render('view', [
                    'model' => $this->findModel($Id),
        ]);
    }

    /**
     * Creates a new Grupo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate() {
        $grupoModel = new Grupo();

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();

            try {
                $grupoModel->userID = Yii::$app->user->identity->id;
                $grupoModel->entidade = Yii::$app->user->identity->entidade;
                $grupoModel->respondente = Yii::$app->user->identity->username;

                if ($grupoModel->load($postData)) {

                    $file = UploadedFile::getInstance($grupoModel, 'anexoAutoEntrega');

                    if (!empty($file)) {
                        // Salve o arquivo de upload
                        $folderName = 'anexoAutoEntrega'; // Use o nome do atributo como nome da pasta
                        $randomString = \Yii::$app->security->generateRandomString();
                        $ext = $file->getExtension();
                        $newFileName = $randomString . ".{$ext}";
                        $path = \Yii::$app->basePath . '/web/uploads/' . $folderName . '/' . $newFileName;

                        if ($file->saveAs($path)) {
                            $grupoModel->anexoAutoEntrega = $folderName . '/' . $newFileName;
                        } else {
                            \Yii::error("Erro ao fazer upload de anexoAutoEntrega");
                        }
                    }
                    if ($grupoModel->save()) {
                        
                    }

                    $insumoGrupoData = $postData['Insumogrupo'];
                    $fitofarmacosferramentasData = $postData['Fitofarmacosferramentas'];

                    //salvar insumo
                    foreach ($insumoGrupoData as $insumoData) {
                        $insumoGrupo = new Insumogrupo();
                        $insumoGrupo->load($insumoData);

                        if ($insumoGrupo->validate()) {
                            $insumoGrupo->grupoID = $grupoModel->Id;
                            $insumoGrupo->save();
                        } else {
                            // Lide com os erros de validação do modelo InsumoGrupo, se necessário
                        }
                    }
                    //salvar fito
                    foreach ($fitofarmacosferramentasData as $fitofarmData) {
                        $fitofarmacosferramentas = new Fitofarmacosferramentas();
                        $fitofarmacosferramentas->load($fitofarmData);

                        if ($fitofarmacosferramentas->validate()) {
                            $fitofarmacosferramentas->grupoID = $grupoModel->Id;
                            $fitofarmacosferramentas->save();
                        } else {
                            // Lide com os erros de validação do modelo Fitofarmacosferramentas, se necessário
                        }
                    }

                    $transaction->commit();
                    return $this->redirect(['index']);
                } else {
                    Yii::error('Erro de validação ou salvamento do modelo Grupo: ' . print_r($grupoModel->getErrors(), true));
                    throw new Exception('Erro ao salvar o modelo Grupo.');
                }
            } catch (Exception $e) {
                Yii::error('Erro na transação: ' . $e->getMessage());
                $transaction->rollBack();
                // Lidar com exceções, se necessário
            }
        }

        $insumoGrupo = [new Insumogrupo()]; // Crie uma matriz de modelos InsumoGrupo
        $fitofarmacosferramentas = [new Fitofarmacosferramentas()]; // Crie uma matriz de modelos Fitofarmacosferramentas

        return $this->render('create', [
                    'grupoModel' => $grupoModel,
                    'insumoGrupo' => $insumoGrupo,
                    'fitofarmacosferramentas' => $fitofarmacosferramentas,
        ]);
    }

    /**
     * Updates an existing Reforcoinstitucional model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id) {
        // Carregar o modelo Grupo existente
        $grupoModel = Grupo::findOne($Id);

        // Verifica se o usuário logado tem a mesma entidade que a do registro
        if ($grupoModel->entidade !== Yii::$app->user->identity->entidade) {
            // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
            Yii::$app->session->setFlash('error', 'Você não tem permissão para VALIDAR este registro.');
            return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
        }

        if (!$grupoModel) {
            throw new NotFoundHttpException('O modelo Grupo não foi encontrado.');
        }

        // Carregar os modelos relacionados InsumoGrupo e Fitofarmacosferramentas para este grupo
        $insumoGrupo = InsumoGrupo::findAll(['grupoID' => $grupoModel->Id]);
        $fitofarmacosferramentas = Fitofarmacosferramentas::findAll(['grupoID' => $grupoModel->Id]);

        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();

//            $grupoModel->userID = \Yii::$app->user->identity->id; // pega o id do usuario logado e armazena para guardar junto com o formulario
//            $grupoModel->criadoPor = \Yii::$app->user->identity->username; // pega o id do usuario logado e armazena para guardar junto com o formulario
//            $grupoModel->actualizadoPor = \Yii::$app->user->identity->username; // pega o id do usuario logado e armazena para guardar junto com o formulario
//            $grupoModel->respondente = \Yii::$app->user->identity->username;
//            $grupoModel->entidade = \Yii::$app->user->identity->entidade;
//
//            if (empty($grupoModel->createdAt)) {
//                $grupoModel->createdAt = date('Y-m-d H:i:s');
//            }
//            $grupoModel->UpdatedAt = date('Y-m-d H:i:s'); // pega o id do usuario logado e armazena para guardar junto com o formulario
                $grupoModel->estadoValidacao = "Pendente";
            
            if ($grupoModel->load($postData)) {
                // Atualize o modelo Grupo
                $grupoModel->save();

                // Carregue os modelos relacionados existentes
                $existingInsumoGrupo = InsumoGrupo::findAll(['grupoID' => $grupoModel->Id]);
                $existingFitofarmacosferramentas = Fitofarmacosferramentas::findAll(['grupoID' => $grupoModel->Id]);

                // Atualize os modelos relacionados existentes
                // Você pode implementar sua lógica de atualização aqui
                // Atualize os modelos relacionados existentes
                foreach ($existingInsumoGrupo as $insumoGrupo) {
                    $insumoGrupo->load($postData);
                    if ($insumoGrupo->validate()) {
                        $insumoGrupo->save();
                    } else {
                        // Lide com os erros de validação do modelo InsumoGrupo, se necessário
                    }
                }

                foreach ($existingFitofarmacosferramentas as $fitofarmacosferramentas) {
                    $fitofarmacosferramentas->load($postData);
                    if ($fitofarmacosferramentas->validate()) {
                        $fitofarmacosferramentas->save();
                    } else {
                        // Lide com os erros de validação do modelo Fitofarmacosferramentas, se necessário
                    }
                }


                $transaction->commit();
                return $this->redirect(['index']);
            } else {
                Yii::error('Erro de validação ou salvamento do modelo Grupo: ' . print_r($grupoModel->getErrors(), true));
                throw new Exception('Erro ao salvar o modelo Grupo.');
            }
        }

        return $this->render('update', [
                    'grupoModel' => $grupoModel,
                    'insumoGrupo' => $insumoGrupo,
                    'fitofarmacosferramentas' => $fitofarmacosferramentas,
        ]);
    }

    /**
     * Deletes an existing Reforcoinstitucional model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id) {

        $model = $this->findModel($Id);
        // Verifica se o usuário logado tem a mesma entidade que a do registro
        if ($model->entidade !== Yii::$app->user->identity->entidade) {
            // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
            Yii::$app->session->setFlash('error', 'Você não tem permissão para Eliminar este registro.');
            return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
        }

        $model->delete(); // Exclui o registro apenas se o usuário for o criador


        return $this->redirect(['index']);
    }

    /**
     * Finds the Reforcoinstitucional model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return Reforcoinstitucional the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id) {
        if (($model = Grupo::findOne(['Id' => $Id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionValidar($id) {
        $model = $this->findModel($id);

        $isAdmin = Yii::$app->user->isGuest ? false : Yii::$app->user->can("Permissão de Administrador");
        // Verifica se o usuário logado é um administrador
        if ($isAdmin) {
            $this->validarAcoes($model);
        } else {
            // Verifica se o usuário logado tem a mesma entidade que a do registro
            if ($model->entidade !== Yii::$app->user->identity->entidade) {
                // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                Yii::$app->session->setFlash('error', 'Você não tem permissão para VALIDAR este registro.');
                return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
            }

            if ($model->estadoValidacao === 'Pendente' && $model->canValidate()) {
                $this->validarAcoes($model);
            } else {
                Yii::$app->session->setFlash('error', 'Você não tem permissão para validar este registro ou o registro já foi validado.');
            }
        }

        return $this->redirect(['view', 'Id' => $model->Id]);
    }

    protected function validarAcoes($model) {
        $model->estadoValidacao = 'Validado';
        $model->save();

        // Insira aqui a lógica para aprovar e publicar, se necessário

        Yii::$app->session->setFlash('success', 'O registro foi validado com sucesso.', ['class' => 'alert alert-info alert-dismissible fade show']);
    }

    public function actionAprovar($id) {
        $model = $this->findModel($id);

        $user = Yii::$app->user->identity;

        // Verifica se o usuário logado é um administrador
        $user = Yii::$app->user->identity;
        $userEntidade = $user->entidade;
        $isAdmin = Yii::$app->user->isGuest ? false : Yii::$app->user->can("Permissão de Administrador");

        if ($isAdmin) {

            $this->aprovarAcoes($model);
        } else {
            // Verifica se o usuário logado tem a mesma entidade que a do registro
            if ($model->entidade !== $user->entidade) {
                // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                Yii::$app->session->setFlash('error', 'Você não tem permissão para APROVAR este registro.');
                return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
            }

            if ($model->estadoValidacao === 'Validado' && $model->canApprove()) {
                $this->aprovarAcoes($model);
            } else {
                Yii::$app->session->setFlash('error', 'Você não tem permissão para aprovar este registro ou o registro não está validado.');
            }
        }

        return $this->redirect(['view', 'Id' => $model->Id]);
    }

    protected function aprovarAcoes($model) {
        $model->estadoValidacao = 'Aprovado';
        $model->save();

        // Insira aqui a lógica adicional, se necessário

        Yii::$app->session->setFlash('success', 'O registro foi aprovado com sucesso.', ['class' => 'alert alert-success alert-dismissible fade show']);
    }

    public function actionPublicar($id) {
        $model = $this->findModel($id);

        $user = Yii::$app->user->identity;

        // Verifica se o usuário logado é um administrador
        $user = Yii::$app->user->identity;
        $userEntidade = $user->entidade;
        $isAdmin = Yii::$app->user->isGuest ? false : Yii::$app->user->can("Permissão de Administrador");

        if ($isAdmin) {

            $this->publicacarAcoes($model);
        } else {
            // Verifica se o usuário logado tem a mesma entidade que a do registro
            if ($model->entidade !== $user->entidade) {
                // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                Yii::$app->session->setFlash('error', 'Você não tem permissão para PUBLICAR este registro.');
                return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
            }

            if ($model->estadoValidacao === 'Aprovado' && $model->canPublish()) {
                $this->publicacarAcoes($model);
            } else {
                Yii::$app->session->setFlash('error', 'Você não tem permissão para publicar este registro ou o registro não está aprovado.');
            }
        }

        return $this->redirect(['view', 'Id' => $model->Id]);
    }

    protected function publicacarAcoes($model) {
        $model->estadoValidacao = 'Publicado';
        $model->save();
        Yii::$app->session->setFlash('success', 'O registro foi publicado com sucesso.', ['class' => 'alert alert-primary alert-dismissible fade show']);
    }

    // ...
    public function actionValidarSelecionados() {
        $selectedIds = Yii::$app->request->post('selection'); // Obtém os IDs selecionados

        $user = Yii::$app->user->identity;

        if (is_array($selectedIds)) {
            foreach ($selectedIds as $id) {
                $model = $this->findModel($id);

                $user = Yii::$app->user->identity;
                // Verifica se o usuário logado é um administrador
                $user = Yii::$app->user->identity;
                $userEntidade = $user->entidade;
                $isAdmin = Yii::$app->user->isGuest ? false : Yii::$app->user->can("Permissão de Administrador");
                if ($isAdmin) {
                    $this->validarSelect($model);
                } else {
                    // Verifica se o usuário logado tem a mesma entidade que a do registro
                    if ($model->entidade !== $user->entidade) {
                        // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                        Yii::$app->session->setFlash('error', 'Você não tem permissão para VALIDAR este registro.');
                        return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
                    }
                    if ($model->canValidate()) {
                        $this->validarSelect($model);
                    }
                }
            }

            Yii::$app->session->setFlash('success', 'Registros selecionados validados com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Nenhum registro selecionado para validação.');
        }

        return $this->redirect(['index']);
    }

    protected function validarSelect($model) {
        $model->estadoValidacao = 'Validado';
        $model->save();

        // Insira aqui a lógica adicional, se necessário

        Yii::info('ID: ' . $model->Id . ', Estado Atual: ' . $model->estadoValidacao);
    }

    public function actionAprovarSelecionados() {
        $selectedIds = Yii::$app->request->post('selection'); // Obtém os IDs selecionados

        $user = Yii::$app->user->identity;

        if (is_array($selectedIds)) {
            foreach ($selectedIds as $id) {
                $model = $this->findModel($id);
                $user = Yii::$app->user->identity;

                // Verifica se o usuário logado é um administrador
                $user = Yii::$app->user->identity;
                $userEntidade = $user->entidade;
                $isAdmin = Yii::$app->user->isGuest ? false : Yii::$app->user->can("Permissão de Administrador");
                if ($isAdmin) {
                    $this->aprovarSelect($model);
                } else {
                    // Verifica se o usuário logado tem a mesma entidade que a do registro
                    if ($model->entidade !== $user->entidade) {
                        // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                        Yii::$app->session->setFlash('error', 'Você não tem permissão para APROVAR este registro.');
                        return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
                    }

                    if ($model->estadoValidacao === 'Validado') {
                        $this->aprovarSelect($model);
                    } else {
                        Yii::$app->session->setFlash('error', 'Você não pode aprovar um registro que não esteja validado.');
                    }
                }
            }

            Yii::$app->session->setFlash('success', 'Registros selecionados aprovados com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Nenhum registro selecionado para aprovação.');
        }

        return $this->redirect(['index']);
    }

    protected function aprovarSelect($model) {
        $model->estadoValidacao = 'Aprovado';
        $model->save();

        // Insira aqui a lógica adicional, se necessário

        Yii::info('ID: ' . $model->Id . ', Estado Atual: ' . $model->estadoValidacao);
    }

    public function actionPublicarSelecionados() {
        $selectedIds = Yii::$app->request->post('selection'); // Obtém os IDs selecionados

        $user = Yii::$app->user->identity;

        if (is_array($selectedIds)) {
            foreach ($selectedIds as $id) {
                $model = $this->findModel($id);
                // Verifica se o usuário logado é um administrador
                $user = Yii::$app->user->identity;
                $userEntidade = $user->entidade;
                $isAdmin = Yii::$app->user->isGuest ? false : Yii::$app->user->can("Permissão de Administrador");
                if ($isAdmin) {
                    $this->publicarAcoes($model);
                } else {
                    // Verifica se o usuário logado tem a mesma entidade que a do registro
                    if ($model->entidade !== $user->entidade) {
                        // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                        Yii::$app->session->setFlash('error', 'Você não tem permissão para PUBLICAR este registro.');
                        return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
                    }

                    if ($model->estadoValidacao === 'Aprovado') {
                        $this->publicarAcoes($model);
                    } else {
                        Yii::$app->session->setFlash('error', 'Você não pode publicar um registro que não esteja aprovado.');
                    }
                }
            }

            Yii::$app->session->setFlash('success', 'Registros selecionados publicados com sucesso.');
        } else {
            Yii::$app->session->setFlash('error', 'Nenhum registro selecionado para publicação.');
        }

        return $this->redirect(['index']);
    }

    protected function publicarAcoes($model) {
        $model->estadoValidacao = 'Publicado';
        $model->save();

        // Insira aqui a lógica adicional, se necessário

        Yii::info('ID: ' . $model->Id . ', Estado Atual: ' . $model->estadoValidacao);
    }

    //relatorio Reforço Institucional
    public function actionRelatorioreforco() {
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
                            'titleTextStyle' => ['color' => '#333'], // Cor do título do eixo horizontal
                        ],
                        'vAxis' => [
                            'title' => 'Municípios',
                            'format' => '0',
                            'viewWindow' => [
                                'min' => 0,
                            ],
                            'titleTextStyle' => ['color' => '#333'], // Cor do título do eixo vertical
                        ],
                        'width' => '80%',
                        'height' => 300,
                        'backgroundColor' => ['fill' => 'transparent'],
                        'colors' => ['#3366CC'], // Cor das barras do gráfico
                        'legend' => ['position' => 'none'], // Remove a legenda
                        'annotations' => [
                            'alwaysOutside' => true,
                            'textStyle' => [
                                'fontSize' => 12,
                                'color' => '#333',
                            ],
                        ],
                        'chartArea' => [
                            'left' => 60, // Ajusta a margem esquerda para o título do eixo horizontal
                            'top' => 40, // Ajusta a margem superior para o título do eixo vertical
                            'width' => '70%', // Define a largura da área do gráfico
                            'height' => '70%', // Define a altura da área do gráfico
                        ],
                        'is3D' => true, // Ativar o efeito 3D
                    ],
        ]);

// Configuração do gráfico de pizza
        $chart = GoogleChart::widget([
                    'visualization' => 'PieChart', // Tipo de gráfico de pizza 3D
                    'data' => $dataMunicipios,
                    'options' => [
                        'title' => 'Municípios por Província',
                        'is3D' => true, // Ativar o efeito 3D
                        'width' => '100%',
                        'height' => 300,
                        'backgroundColor' => ['fill' => 'transparent'],
                        'titleTextStyle' => ['color' => '#333'], // Cor do título
                        'legend' => ['position' => 'right'], // Posição da legenda
                    ],
        ]);

        $linhas = GoogleChart::widget([
                    'visualization' => 'LineChart',
                    'data' => $dataMunicipios, // Substitua isso pelos seus próprios dados
                    'options' => [
                        'title' => 'Gráfico de Linhas 3D',
                        'width' => '80%',
                        'height' => 300,
                        'backgroundColor' => ['fill' => 'transparent'],
                        'colors' => ['#3366CC'], // Cor das linhas do gráfico
                        'legend' => ['position' => 'none'], // Remove a legenda
                        'annotations' => [
                            'alwaysOutside' => true,
                            'textStyle' => [
                                'fontSize' => 12,
                                'color' => '#333',
                            ],
                        ],
                        'chartArea' => [
                            'left' => 60, // Ajusta a margem esquerda para o título do eixo horizontal
                            'top' => 40, // Ajusta a margem superior para o título do eixo vertical
                            'width' => '70%', // Define a largura da área do gráfico
                            'height' => '70%', // Define a altura da área do gráfico
                        ],
                        'is3D' => true, // Ativar o efeito 3D
                        'vAxis' => [
                            'viewWindow' => [
                                'min' => 0, // Começa a contar a partir de zero
                            ],
                            'format' => '0', // Exibe apenas números inteiros
                        ],
                    ],
        ]);

        return $this->render('relatorioreforco', ['chartGoogleMunicipios' => $chartGoogleMunicipios, 'chart' => $chart, 'linhas' => $linhas]);
    }

    public static function getEnumValues($attribute) {
        $values = Yii::$app->db->createCommand("SHOW COLUMNS FROM {{%grupo}} LIKE '{$attribute}'")->queryOne();
        $values = str_replace("enum('", '', $values['Type']);
        $values = str_replace("')", '', $values);
        $values = explode("','", $values);

        return array_combine($values, $values);
    }

    public static function getEnumInsumoValues($attribute) {
        $values = Yii::$app->db->createCommand("SHOW COLUMNS FROM {{%insumoGrupo}} LIKE '{$attribute}'")->queryOne();
        $values = str_replace("enum('", '', $values['Type']);
        $values = str_replace("')", '', $values);
        $values = explode("','", $values);

        return array_combine($values, $values);
    }
}
