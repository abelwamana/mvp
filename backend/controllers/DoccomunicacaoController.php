<?php

namespace backend\controllers;

use backend\models\Doccomunicacao;
use backend\models\DoccomunicacaoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * DoccomunicacaoController implements the CRUD actions for Doccomunicacao model.
 */
class DoccomunicacaoController extends Controller {

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
     * Lists all Doccomunicacao models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new DoccomunicacaoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Doccomunicacao model.
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
     * Creates a new Doccomunicacao model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    //Metodo para fazer upload dos 5 ficheiros e armazena cada um na sua pasta correspondente
    private function uploadFicheiro($models, $attribute, $filename) {
        $file = UploadedFile::getInstance($models, $attribute);

        $name = explode('.', $file->name);
        $ext = end($name);
        $folderName = $attribute; // Use o nome do atributo como nome da pasta
        $randomString = \Yii::$app->security->generateRandomString();
        $newFileName = $randomString . ".{$ext}";

        // Certifique-se de que a pasta exista, senão crie-a
        $resource = \Yii::$app->basePath . '/web/uploads/' . $folderName;
        if (!file_exists($resource)) {
            mkdir($resource, 0777, true);
        }

        $path = $resource . '/' . $newFileName;

        if ($file->saveAs($path)) {
            // Verifique se já existe um arquivo e o exclua
            $existingFile = $models->$filename;
            if (!empty($existingFile)) {
                $existingFilePath = \Yii::$app->basePath . '/web/uploads/' . $existingFile;
                if (file_exists($existingFilePath)) {
                    unlink($existingFilePath);
                }
            }

            // Atualize a propriedade do modelo com o novo caminho do arquivo
            $models->$filename = $folderName . '/' . $newFileName;

            // Agora salve o modelo para persistir a alteração no banco de dados
            if ($models->save()) {
                // O modelo foi salvo com sucesso
            } else {
                \Yii::error("Erro ao salvar o modelo após o upload de $attribute");
            }
        } else {
            \Yii::error("Erro ao fazer upload de $attribute");
        }
    }

    public function actionCreate() {
        $models = new Doccomunicacao();

        if (\Yii::$app->request->isPost) {
            $postData = \Yii::$app->request->post();
            $transaction = \Yii::$app->db->beginTransaction();

            try {
                $models->userID = \Yii::$app->user->identity->id;
                $models->repondente = \Yii::$app->user->identity->username;

                if ($models->load($postData)) {
                    // Carregue o arquivo de upload
                    $file = UploadedFile::getInstance($models, 'anexo');

                    if (!empty($file)) {
                        // Salve o arquivo de upload
                        $folderName = 'anexo'; // Use o nome do atributo como nome da pasta
                        $randomString = \Yii::$app->security->generateRandomString();
                        $ext = $file->getExtension();
                        $newFileName = $randomString . ".{$ext}";
                        $path = \Yii::$app->basePath . '/web/uploads/' . $folderName . '/' . $newFileName;

                        if ($file->saveAs($path)) {
                            $models->anexo = $folderName . '/' . $newFileName;
                        } else {
                            \Yii::error("Erro ao fazer upload de anexo");
                        }
                    }

                    if ($models->save()) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    } else {
                        \Yii::error('Erro ao salvar Registo: ' . print_r($models->getErrors(), true));
                    }
                } else {
                    \Yii::error('Erro de carregamento de dados do formulário.');
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

    public function actionUpdate($Id) {
        $models = $this->findModel($Id);
        // Realize uma consulta para obter o valor atual do campo "anexo"   
        $currentAnexo = \backend\models\Doccomunicacao::find()
                ->select('anexo')
                ->where(['Id' => $Id]) // Substitua 'id' pelo nome do seu campo de identificação
                ->all();
        if (\Yii::$app->request->isPost) {
            $postData = \Yii::$app->request->post();
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                // Verificar se um novo arquivo foi enviado
                $file = UploadedFile::getInstance($models, 'anexo');
                if (!empty($file)) {
                    // Salvar o novo arquivo de upload
                    $folderName = 'anexo'; // Use o nome do atributo como nome da pasta
                    $randomString = \Yii::$app->security->generateRandomString();
                    $ext = $file->getExtension();
                    $newFileName = "ComunicacaoArtigo" . $randomString . "_" . date('YmdHis') . ".{$ext}";
                    $path = \Yii::$app->basePath . '/web/uploads/' . $folderName . '/' . $newFileName;

                    $file->saveAs($path);
                    // Excluir o arquivo antigo se ele existir
                    if (!empty($models->anexo)) {
                        $oldFilePath = \Yii::$app->basePath . '/web/uploads/' . $models->anexo;
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }
                    // Atualizar o atributo 'anexo' no modelo com o novo caminho do arquivo
                    $models->anexo = $folderName . '/' . $newFileName;
                } else {
                    $models->anexo = $currentAnexo;
                }

                if ($models->load($postData) ) {

                    if (!empty($file)) {
                        // Resto do código para atualizar o registro
                        $models->anexo = $folderName . '/' . $newFileName;
                    }
                    if (empty($file)) {
                        // Resto do código para atualizar o registro
                        $models->anexo = $currentAnexo;
                         $models->save();
                         
                    }

                    $models->save();
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

        return $this->render('update', [
                    'models' => $models,
                    'currentAnexo' => $currentAnexo,
        ]);
    }

    /**
     * Deletes an existing Doccomunicacao model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id) {
        $model = $this->findModel($Id);

        // Excluir o arquivo antigo se ele existir
        if (!empty($model->anexo)) {
            $oldFilePath = \Yii::$app->basePath . '/web/uploads/' . $model->anexo;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        // Exclua o registro do banco de dados
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Doccomunicacao model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return Doccomunicacao the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id) {
        if (($model = Doccomunicacao::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public static function getEnumEntidadeImplementadoraValues($attribute) {
        $values = \Yii::$app->db->createCommand("SHOW COLUMNS FROM {{%doccomunicacao}} LIKE '{$attribute}'")->queryOne();
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

    // ...
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
