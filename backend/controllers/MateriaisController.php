<?php

namespace backend\controllers;

use backend\models\Materiais;
use backend\models\MateriaisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MateriaisController implements the CRUD actions for Materiais model.
 */
class MateriaisController extends Controller
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
     * Lists all Materiais models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new MateriaisSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Materiais model.
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
     * Creates a new Materiais model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $models = new Materiais();

        if (\Yii::$app->request->isPost) {
            $postData = \Yii::$app->request->post();
            $transaction = \Yii::$app->db->beginTransaction();

            try {
                $models->userID = \Yii::$app->user->identity->id; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->criadoPor = \Yii::$app->user->identity->username; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->actualizadoPor = \Yii::$app->user->identity->username; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->respondente = \Yii::$app->user->identity->username;
                $models->entidade = \Yii::$app->user->identity->entidade;

                if (empty($models->createdAt)) {
                    $models->createdAt = date('Y-m-d H:i:s');
                }
                $models->UpdatedAt = date('Y-m-d H:i:s'); // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->estadoValidacao = "Pendente";

                //adicionar a data de criaçao
                if ($models->load($postData) && $models->save()) {
                    // $model (Reforcoinstitucional) foi salvo com sucesso, obtenha o ID inserido
                    $reforcoinstitucionalId = $models->primaryKey;

                    // Qualquer outra lógica de sucesso ou redirecionamento aqui

                    $transaction->commit();
                    return $this->redirect(['index']);
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
     * Updates an existing Demostracoesculinarias model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id) {
        $models = $this->findModel($Id);

        if (\Yii::$app->request->isPost) {
            $postData = \Yii::$app->request->post();
            $transaction = \Yii::$app->db->beginTransaction();

            try {
                $models->userID = \Yii::$app->user->identity->id; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->criadoPor = \Yii::$app->user->identity->username; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->actualizadoPor = \Yii::$app->user->identity->username; // pega o id do usuario logado e armazena para guardar junto com o formulario
                $models->respondente = \Yii::$app->user->identity->username;
                $models->entidade = \Yii::$app->user->identity->entidade;

                if (empty($models->createdAt)) {
                    $models->createdAt = date('Y-m-d H:i:s');
                }
                $models->UpdatedAt = date('Y-m-d H:i:s'); // pega o id do usuario logado e armazena para guardar junto com o formulario
                // Carregue os dados do modelo sem validar
                if ($models->load($postData)) {
                    // Trate o upload de arquivos
                    $this->uploadFicheiro($models, 'anexoEvidenciaDemonsCulinaria', 'anexoEvidenciaDemonsCulinaria');

                    // Salve o modelo novamente para atualizar os campos de arquivo
                    $models->save();

                    $transaction->commit();
                    return $this->redirect(['index']);
                } else {
                    \Yii::error('Erro de validação ou salvamento Registo ' . print_r($models->getErrors(), true));
                    throw new Exception('Erro ao atualizar Registo.');
                }
            } catch (Exception $e) {
                \Yii::error('Erro na transação: ' . $e->getMessage());
                $transaction->rollBack();
                // Lidar com exceções, se necessário
            }
        }

        return $this->render('update', [
                    'models' => $models,
        ]);
    }

    //Metodo para fazer upload dos 5 ficheiros e armazena cada um na sua pasta correspondente
    private function uploadFicheiro($models, $attribute, $filename) {
        $file = UploadedFile::getInstance($models, $attribute);
        if (!is_null($file)) {
            $name = explode('.', $file->name);
            $ext = end($name);
            $folderName = $attribute; // Use o nome do atributo como nome da pasta
            $randomString = \Yii::$app->security->generateRandomString();
            $models->$attribute = $folderName . '/' . $randomString . ".{$ext}";

            // Certifique-se de que a pasta exista, senão crie-a
            $resource = \Yii::$app->basePath . '/web/uploads/' . $folderName;
            if (!file_exists($resource)) {
                mkdir($resource, 0777, true);
            }

            $path = $resource . '/' . $models->$attribute;
            if ($file->saveAs($path)) {
                // Verifique se já existe um arquivo e o exclua
                $existingFile = $models->$filename;
                if (!empty($existingFile)) {
                    unlink(\Yii::$app->basePath . '/web/uploads/' . $existingFile);
                }

                $models->$filename = $models->$attribute;
            } else {
                \Yii::error("Erro ao fazer upload de $attribute");
            }
        }
    }

    /**
     * Deletes an existing Demostracoesculinarias model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
     public function actionDelete($Id) {

        $model = $this->findModel($Id);

        $model = $this->findModel($Id);
        // Verifica se o usuário logado tem a mesma entidade que a do registro
        if ($model->entidade !== \Yii::$app->user->identity->entidade) {
            // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
            \Yii::$app->session->setFlash('error', 'Você não tem permissão para VALIDAR este registro.');
            return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
        }

        $model->delete(); // Exclui o registro apenas se o usuário for o criador


        return $this->redirect(['index']);
    }

    /**
     * Finds the Materiais model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return Materiais the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id)
    {
        if (($model = Materiais::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
     public static function getEnumValues($attribute) {
        $values = \Yii::$app->db->createCommand("SHOW COLUMNS FROM {{%materiais}} LIKE '{$attribute}'")->queryOne();
        $values = str_replace("enum('", '', $values['Type']);
        $values = str_replace("')", '', $values);
        $values = explode("','", $values);

        return array_combine($values, $values);
    }

    public function actionValidar($id) {
        $model = $this->findModel($id);

        $user = \Yii::$app->user->identity;

        // Verifica se o usuário logado é um administrador
        $user = \Yii::$app->user->identity;
        $userEntidade = $user->entidade;
        $isAdmin = \Yii::$app->user->isGuest ? false : \Yii::$app->user->can("Permissão de Administrador");

        if ($isAdmin) {
            $this->validarAcoes($model);
        } else {
            // Verifica se o usuário logado tem a mesma entidade que a do registro
            if ($model->entidade !== $userEntidade) {
                // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                \Yii::$app->session->setFlash('error', 'Você não tem permissão para VALIDAR este registro.');
                return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
            }

            if ($model->estadoValidacao === 'Pendente' && $model->canValidate()) {
                $this->validarAcoes($model);
            } else {
                \Yii::$app->session->setFlash('error', 'Você não tem permissão para validar este registro ou o registro já foi validado.');
            }
        }

        return $this->redirect(['index']);
    }

    protected function validarAcoes($model) {
        $model->estadoValidacao = 'Validado';
        $model->save();

        // Insira aqui a lógica para aprovar e publicar, se necessário

        \Yii::$app->session->setFlash('success', 'O registro foi validado com sucesso.', ['class' => 'alert alert-info alert-dismissible fade show']);
    }

    public function actionAprovar($id) {
        $model = $this->findModel($id);

        $user = \Yii::$app->user->identity;

        // Verifica se o usuário logado é um administrador
        $user = \Yii::$app->user->identity;
        $userEntidade = $user->entidade;
        $isAdmin = \Yii::$app->user->isGuest ? false : \Yii::$app->user->can("Permissão de Administrador");

        if ($isAdmin) {

            $this->aprovarAcoes($model);
        } else {
            // Verifica se o usuário logado tem a mesma entidade que a do registro
            if ($model->entidade !== $user->entidade) {
                // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                \Yii::$app->session->setFlash('error', 'Você não tem permissão para APROVAR este registro.');
                return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
            }

            if ($model->estadoValidacao === 'Validado' && $model->canApprove()) {
                $this->aprovarAcoes($model);
            } else {
                \Yii::$app->session->setFlash('error', 'Você não tem permissão para aprovar este registro ou o registro não está validado.');
            }
        }

        return $this->redirect(['index']);
    }

    protected function aprovarAcoes($model) {
        $model->estadoValidacao = 'Aprovado';
        $model->save();

        // Insira aqui a lógica adicional, se necessário

        \Yii::$app->session->setFlash('success', 'O registro foi aprovado com sucesso.', ['class' => 'alert alert-success alert-dismissible fade show']);
    }

    public function actionPublicar($id) {
        $model = $this->findModel($id);

        $user = \Yii::$app->user->identity;

        // Verifica se o usuário logado é um administrador
        $user = \Yii::$app->user->identity;
        $userEntidade = $user->entidade;
        $isAdmin = \Yii::$app->user->isGuest ? false : \Yii::$app->user->can("Permissão de Administrador");

        if ($isAdmin) {

            $this->publicacarAcoes($model);
        } else {
            // Verifica se o usuário logado tem a mesma entidade que a do registro
            if ($model->entidade !== $user->entidade) {
                // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                \Yii::$app->session->setFlash('error', 'Você não tem permissão para PUBLICAR este registro.');
                return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
            }

            if ($model->estadoValidacao === 'Aprovado' && $model->canPublish()) {
                $this->publicacarAcoes($model);
            } else {
                \Yii::$app->session->setFlash('error', 'Você não tem permissão para publicar este registro ou o registro não está aprovado.');
            }
        }

        return $this->redirect(['index']);
    }

    protected function publicacarAcoes($model) {
        $model->estadoValidacao = 'Publicado';
        $model->save();
        \Yii::$app->session->setFlash('success', 'O registro foi publicado com sucesso.', ['class' => 'alert alert-primary alert-dismissible fade show']);
    }

    public function actionValidarSelecionados() {
        $selectedIds = \Yii::$app->request->post('selection'); // Obtém os IDs selecionados

        $user = \Yii::$app->user->identity;

        if (is_array($selectedIds)) {
            foreach ($selectedIds as $id) {
                $model = $this->findModel($id);

                $user = \Yii::$app->user->identity;
                // Verifica se o usuário logado é um administrador
                $user = \Yii::$app->user->identity;
                $userEntidade = $user->entidade;
                $isAdmin = \Yii::$app->user->isGuest ? false : \Yii::$app->user->can("Permissão de Administrador");
                if ($isAdmin) {
                    $this->validarSelect($model);
                } else {
                    // Verifica se o usuário logado tem a mesma entidade que a do registro
                    if ($model->entidade !== $user->entidade) {
                        // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                        \Yii::$app->session->setFlash('error', 'Você não tem permissão para VALIDAR este registro.');
                        return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
                    }
                    if ($model->canValidate()) {
                        $this->validarSelect($model);
                    }
                }
            }

            \Yii::$app->session->setFlash('success', 'Registros selecionados validados com sucesso.');
        } else {
            \Yii::$app->session->setFlash('error', 'Nenhum registro selecionado para validação.');
        }

        return $this->redirect(['index']);
    }

    protected function validarSelect($model) {
        $model->estadoValidacao = 'Validado';
        $model->save();

        // Insira aqui a lógica adicional, se necessário

        \Yii::info('ID: ' . $model->Id . ', Estado Atual: ' . $model->estadoValidacao);
    }

    public function actionAprovarSelecionados() {
        $selectedIds = \Yii::$app->request->post('selection'); // Obtém os IDs selecionados

        $user = \Yii::$app->user->identity;

        if (is_array($selectedIds)) {
            foreach ($selectedIds as $id) {
                $model = $this->findModel($id);
                $user = \Yii::$app->user->identity;

                // Verifica se o usuário logado é um administrador
                $user = \Yii::$app->user->identity;
                $userEntidade = $user->entidade;
                $isAdmin = \Yii::$app->user->isGuest ? false : \Yii::$app->user->can("Permissão de Administrador");
                if ($isAdmin) {
                    $this->aprovarSelect($model);
                } else {
                    // Verifica se o usuário logado tem a mesma entidade que a do registro
                    if ($model->entidade !== $user->entidade) {
                        // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                        \Yii::$app->session->setFlash('error', 'Você não tem permissão para APROVAR este registro.');
                        return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
                    }

                    if ($model->estadoValidacao === 'Validado') {
                        $this->aprovarSelect($model);
                    } else {
                        \Yii::$app->session->setFlash('error', 'Você não pode aprovar um registro que não esteja validado.');
                    }
                }
            }

            \Yii::$app->session->setFlash('success', 'Registros selecionados aprovados com sucesso.');
        } else {
            \Yii::$app->session->setFlash('error', 'Nenhum registro selecionado para aprovação.');
        }

        return $this->redirect(['index']);
    }

    protected function aprovarSelect($model) {
        $model->estadoValidacao = 'Aprovado';
        $model->save();

        // Insira aqui a lógica adicional, se necessário

        \Yii::info('ID: ' . $model->Id . ', Estado Atual: ' . $model->estadoValidacao);
    }

    public function actionPublicarSelecionados() {
        $selectedIds = \Yii::$app->request->post('selection'); // Obtém os IDs selecionados

        $user = \Yii::$app->user->identity;

        if (is_array($selectedIds)) {
            foreach ($selectedIds as $id) {
                $model = $this->findModel($id);
                // Verifica se o usuário logado é um administrador
                $user = \Yii::$app->user->identity;
                $userEntidade = $user->entidade;
                $isAdmin = \Yii::$app->user->isGuest ? false : \Yii::$app->user->can("Permissão de Administrador");
                if ($isAdmin) {
                    $this->publicarAcoes($model);
                } else {
                    // Verifica se o usuário logado tem a mesma entidade que a do registro
                    if ($model->entidade !== $user->entidade) {
                        // Redireciona ou exibe uma mensagem de erro, dependendo do seu caso
                        \Yii::$app->session->setFlash('error', 'Você não tem permissão para PUBLICAR este registro.');
                        return $this->redirect(['index']); // Redireciona para a página de listagem, por exemplo
                    }

                    if ($model->estadoValidacao === 'Aprovado') {
                        $this->publicarAcoes($model);
                    } else {
                        \Yii::$app->session->setFlash('error', 'Você não pode publicar um registro que não esteja aprovado.');
                    }
                }
            }

            \Yii::$app->session->setFlash('success', 'Registros selecionados publicados com sucesso.');
        } else {
            \Yii::$app->session->setFlash('error', 'Nenhum registro selecionado para publicação.');
        }

        return $this->redirect(['index']);
    }

    protected function publicarAcoes($model) {
        $model->estadoValidacao = 'Publicado';
        $model->save();

        // Insira aqui a lógica adicional, se necessário

        \Yii::info('ID: ' . $model->Id . ', Estado Atual: ' . $model->estadoValidacao);
    }
}
