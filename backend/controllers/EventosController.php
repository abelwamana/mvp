<?php

namespace backend\controllers;

use backend\models\Eventos;
use backend\models\EventosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * EventosController implements the CRUD actions for Eventos model.
 */
class EventosController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
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
     * Lists all Eventos models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EventosSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Eventos model.
     * @param int $Id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($Id)
    {
        return $this->render('view', [
            'model' => $this->findModel($Id),
        ]);
    }

    /**
     * Creates a new Eventos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
  public function actionCreate() {
        $models = new Eventos();

        if (\Yii::$app->request->isPost) {
            $postData = \Yii::$app->request->post();
            $transaction = \Yii::$app->db->beginTransaction();

            try {
                 $models->userID = \Yii::$app->user->identity->id; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->criadoPor = \Yii::$app->user->identity->username; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->actualizadoPor = \Yii::$app->user->identity->username; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->entidade = \Yii::$app->user->identity->entidade;
                $models->respondente = \Yii::$app->user->identity->username;

                if (empty($models->createdAt)) {
                    $models->createdAt = date('Y-m-d H:i:s');
                }
                $models->UpdatedAt = date('Y-m-d H:i:s'); // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->estadoValidacao = "Pendente";


                //adicionar a data de criaçao
                 if ($models->load($postData)) {
                    // Carregue o arquivo de upload
                    $file = UploadedFile::getInstance($models, 'anexoForum');

                    if (!empty($file)) {
                        // Salve o arquivo de upload
                        $folderName = 'anexoForum'; // Use o nome do atributo como nome da pasta
                        $randomString = \Yii::$app->security->generateRandomString();
                        $ext = $file->getExtension();
                        $newFileName = $randomString . ".{$ext}";
                        $path = \Yii::$app->basePath . '/web/uploads/' . $folderName . '/' . $newFileName;

                        if ($file->saveAs($path)) {
                            $models->anexoForum = $folderName . '/' . $newFileName;
                        } else {
                            \Yii::error("Erro ao fazer upload de anexoForum");
                        }
                    }

                    if ($models->save()) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    } else {
                        \Yii::error('Erro ao salvar Registo: ' . print_r($models->getErrors(), true));
                    }
                } else {
                    \Yii::error('Erro de validação ou salvamento Registo ' . print_r($models->getErrors(), true));
                    throw new Exception('Erro ao salvar Registo.');
                }
            } catch (Exception $e) {
                \Yii::error('Erro na transação: ' . $e->getMessage());
                $transaction->rollBack();
                // Lidar com exceções, se necessário
            }
        }

        return $this->render('create', [
                    'models' => $models,
        ]);
    }

    /**
     * Updates an existing Reforcoinstitucional model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id) {
        $models = $this->findModel($Id);

        // Verifica se o usuário logado tem a mesma entidade que a do registro
         $models->userID = \Yii::$app->user->identity->id; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->criadoPor = \Yii::$app->user->identity->username; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->actualizadoPor = \Yii::$app->user->identity->username; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->entidade = \Yii::$app->user->identity->entidade;
                $models->respondente = \Yii::$app->user->identity->username;

                if (empty($models->createdAt)) {
                    $models->createdAt = date('Y-m-d H:i:s');
                }
                $models->UpdatedAt = date('Y-m-d H:i:s'); // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->estadoValidacao = "Pendente";

        if ($models->entidade !== \Yii::$app->user->identity->entidade) {
            // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
            \Yii::$app->session->setFlash('error', 'Você não tem permissão para atualizar este registro.');
            return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
        }
try{
        // Verifica se a solicitação é uma requisição POST e se o modelo pode ser carregado com os dados do formulário
         if ($models->load($postData)) {
                    // Carregue o arquivo de upload
                    $file = UploadedFile::getInstance($models, 'anexoForum');

                    if (!empty($file)) {
                        // Salve o arquivo de upload
                        $folderName = 'anexoForum'; // Use o nome do atributo como nome da pasta
                        $randomString = \Yii::$app->security->generateRandomString();
                        $ext = $file->getExtension();
                        $newFileName = $randomString . ".{$ext}";
                        $path = \Yii::$app->basePath . '/web/uploads/' . $folderName . '/' . $newFileName;

                        if ($file->saveAs($path)) {
                            $models->anexoForum = $folderName . '/' . $newFileName;
                        } else {
                            \Yii::error("Erro ao fazer upload de anexoForum");
                        }
                    }

                    if ($models->save()) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    } else {
                        \Yii::error('Erro ao salvar Registo: ' . print_r($models->getErrors(), true));
                    }
                } else {
                    \Yii::error('Erro de validação ou salvamento Registo ' . print_r($models->getErrors(), true));
                    throw new Exception('Erro ao salvar Registo.');
                }
            } catch (Exception $e) {
                \Yii::error('Erro na transação: ' . $e->getMessage());
                $transaction->rollBack();
                // Lidar com exceções, se necessário
            }
        

        return $this->render('update', [
                    'models' => $models,
        ]);
    }

    /**
     * Deletes an existing Reforcoinstitucional model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id) {

        $model = $this->findModel($Id);

        // Verifica se o usuário logado é o mesmo que criou o registro
        // Verifica se o usuário logado tem a mesma entidade que a do registro
        if ($model->entidade !== \Yii::$app->user->identity->entidade) {
            // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
            \Yii::$app->session->setFlash('error', 'Você não tem permissão para eliminar este registro.');
            return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
        } else {
            $model->delete(); // Exclui o registro apenas se o usuário for o criador
        }

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
        if (($model = Eventos::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionValidar($id) {
        $model = $this->findModel($id);

        // Verifica se o usuário logado tem a mesma entidade que a do registro
        if ($model->entidade !== \Yii::$app->user->identity->entidade) {
            // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
            \Yii::$app->session->setFlash('error', 'Você não tem permissão para VALIDAR este registro.');
            return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
        }

        if ($model->estadoValidacao === 'Pendente' && $model->canValidate()) {
            $model->estadoValidacao = 'Validado';
            $model->save();

            \Yii::$app->session->setFlash('success', 'O registro foi validado com sucesso.', ['class' => 'alert alert-info alert-dismissible fade show']);
        } else {
            \Yii::$app->session->setFlash('error', 'Você não tem permissão para validar este registro ou o registro já foi validado.');
        }

        return $this->redirect(['view', 'Id' => $model->Id]);
    }

    public function actionAprovar($id) {
        $model = $this->findModel($id);

        // Verifica se o usuário logado tem a mesma entidade que a do registro
        if ($model->entidade !== \Yii::$app->user->identity->entidade) {
            // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
            \Yii::$app->session->setFlash('error', 'Você não tem permissão para APROVAR este registro.');
            return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
        }

        if ($model->estadoValidacao === 'Validado' && $model->canApprove()) {
            $model->estadoValidacao = 'Aprovado';
            $model->save();

            \Yii::$app->session->setFlash('success', 'O registro foi aprovado com sucesso.', ['class' => 'alert alert-success alert-dismissible fade show']);
        } else {
            \Yii::$app->session->setFlash('error', 'Você não tem permissão para aprovar este registro ou o registro não está validado.');
        }

        return $this->redirect(['view', 'Id' => $model->Id]);
    }

    public function actionPublicar($id) {
        $model = $this->findModel($id);

        // Verifica se o usuário logado tem a mesma entidade que a do registro
        if ($model->entidade !== \Yii::$app->user->identity->entidade) {
            // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
            \Yii::$app->session->setFlash('error', 'Você não tem permissão para PUBLICAR este registro.');
            return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
        }

        if ($model->estadoValidacao === 'Aprovado' && $model->canPublish()) {
            $model->estadoValidacao = 'Publicado';
            $model->save();

            \Yii::$app->session->setFlash('success', 'O registro foi publicado com sucesso.', ['class' => 'alert alert-primary alert-dismissible fade show']);
        } else {
            \Yii::$app->session->setFlash('error', 'Você não tem permissão para publicar este registro ou o registro não está aprovado.');
        }

        return $this->redirect(['view', 'Id' => $model->Id]);
    }

    // ...

    public function actionValidarSelecionados() {
        $selectedIds = \Yii::$app->request->post('selection'); // Obtém os IDs selecionados

        if (is_array($selectedIds)) {
            foreach ($selectedIds as $id) {
                $model = $this->findModel($id);

                \Yii::info('ID: ' . $id . ', Estado Atual: ' . $model->estadoValidacao);

                if ($model->canValidate()) {
                    $model->estadoValidacao = 'Validado';
                    $model->save();
                }
            }

            \Yii::$app->session->setFlash('success', 'Registros selecionados validados com sucesso.');
        } else {
            \Yii::$app->session->setFlash('error', 'Nenhum registro selecionado para validação.');
        }

        return $this->redirect(['index']);
    }

    //relatorio Reforço Institucional
    public function actionRelatorioreforco() {
// Gráfico de municípios com perfis de vulnerabilidade definidos
        $dataMunicipios = [['Provincia', 'NumeroDeMunicipios']];
        $query = \Yii::$app->db->createCommand('
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
        $values = \Yii::$app->db->createCommand("SHOW COLUMNS FROM {{%eventos}} LIKE '{$attribute}'")->queryOne();
        $values = str_replace("enum('", '', $values['Type']);
        $values = str_replace("')", '', $values);
        $values = explode("','", $values);

        return array_combine($values, $values);
    }

    // Generate list of subcat based on cat
    public function actionSubcat() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $cat_id = $parents[0];
                $out = Municipio::getSubCatList($cat_id);
                $pre_selected_subject_id = 1; // or whatever you want to be default
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

// Generate list of products based on cat and subcat
    public function actionProd() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $cat_id = empty($ids[0]) ? null : $ids[0];
            $subcat_id = empty($ids[1]) ? null : $ids[1];
            if ($cat_id != null) {
                $data = self::getProdList($cat_id, $subcat_id);
                /**
                 * the getProdList function will query the database based on the
                 * cat_id and sub_cat_id and return an array like below:
                 *  [
                 *      'out'=>[
                 *          ['id'=>'<prod-id-1>', 'name'=>'<prod-name1>'],
                 *          ['id'=>'<prod_id_2>', 'name'=>'<prod-name2>']
                 *       ],
                 *       'selected'=>'<prod-id-1>'
                 *  ]
                 */
                echo Json::encode(['output' => $data['out'], 'selected' => $data['selected']]);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    public static function actionListmunicipio() {
             $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {

                $provinciaID = $parents[0];
                $out = Municipio::getDefProvincias($provinciaID);
                $_POST['test'] = $out;
                

                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
}
