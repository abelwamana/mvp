<?php

/** @var Created by: Abel Eusébio Alberto Wamana */
/** @varE - mail  : abelwamana@gmail.com */
/** @var Tel: +244 927 487 045 */
/** @var Eu Creio! Eu Creio! Eu Creio em Jesús Cristo meu Senhor e Rei */

namespace backend\controllers;

use yii\web\Controller;
use yii\helpers\FileHelper;
use yii\web\Response;
use backend\models\Arquivo;
use backend\models\ArquivoSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

class ArquivoController extends Controller {

    public function actionArquivo() {
        $basePath = \Yii::getAlias('@webroot/arquivos');
        $structure = $this->getDirectoryStructure($basePath);
        $parentPath = Yii::$app->request->get('path', 'arquivos'); // Define um valor padrão 'arquivos' se não estiver definido
        $searchModel = new ArquivoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('arquivo', [
                    'structure' => $structure,
                    'parentPath' => $parentPath,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex() {
        $searchModel = new ArquivoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    // Ação para exibir todos os arquivos
    public function actionFicheiros() {
        $searchModel = new ArquivoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('ficheiros', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    protected function getDirectoryStructure($path) {
        $items = [];
        $folders = FileHelper::findDirectories($path, ['recursive' => false]);
        foreach ($folders as $folder) {
            $folderName = basename($folder);
            $subFolders = $this->getDirectoryStructure($folder);
            $items[$folderName] = $subFolders;
        }

        $files = FileHelper::findFiles($path, ['recursive' => false]);
        foreach ($files as $file) {
            $fileName = basename($file);
            $items['files'][] = $fileName;
        }

        return $items;
    }

    // Novo método para carregar subpastas via AJAX
    public function actionLoadSubfolder($folder) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $basePath = \Yii::getAlias('@webroot/arquivos');
        $path = $basePath . DIRECTORY_SEPARATOR . str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $folder);

        if (is_dir($path)) {
            $structure = $this->getDirectoryStructure($path);
            $content = $this->renderPartial('_folders', ['structure' => $structure, 'parentPath' => $folder]);

            return ['success' => true, 'content' => $content];
        }
        return ['success' => false, 'message' => 'Erro ao carregar a pasta.'];
    }

    public function actionDownload($file) {
        $basePath = \Yii::getAlias('@webroot/arquivos');
        $filePath = $basePath . DIRECTORY_SEPARATOR . urldecode(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $file));

        if (file_exists($filePath)) {
            return \Yii::$app->response->sendFile($filePath);
        } else {
            \Yii::$app->session->setFlash('error', 'O arquivo solicitado não foi encontrado.');
            return $this->redirect(['index']);
        }
    }

    public function actionView($file) {
        return $this->render('view', [
                    'model' => $this->findModel($file),
        ]);
    }

    public function actionViewpage($file) {
        return $this->render('viewPage', [
                    'model' => $this->findModel($file),
        ]);
    }

    public function actionCreate($path) {
        $model = new Arquivo();
        $model->scenario = Arquivo::SCENARIO_CREATE; // Define o cenário de criação
        if ($path != "undefined") {
            $parentPath = "arquivos/" . implode('/', explode(' > ', $path));
        } else {
            $parentPath = "arquivos";
        }
//        $parentPath = Yii::$app->request->get('path'); // Define um valor padrão 'arquivos' se não estiver definido
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->printFile = UploadedFile::getInstance($model, 'printFile');
//            $model->caminho = Yii::$app->request->post('Arquivo')['caminho']; // Captura o caminho do post
//            $model->pastaRais = Yii::$app->request->post('Arquivo')['pastaRais']; // Captura a pasta do post
            if ($model->uploadFiles()) {
                // salvar informações do arquivo no banco de dados
                $model->arquivo = $model->file->baseName . '.' . $model->file->extension;
                $model->print = $model->printFile->baseName . '.' . $model->printFile->extension;
                $model->tipo_arquivo = $model->file->type;
                $model->tamanho_arquivo = $model->file->size;
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Arquivo salvo com sucesso.');
                    return $this->redirect(['view', 'file' => $model->arquivo]);
                }
            }
        }

        return $this->render('create', [
                    'model' => $model,
                    'parentPath' => $parentPath,
        ]);
    }

    /**
     * Updates an existing Biblioteca model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $fileName ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($fileName) {
        $model = $this->findModel($fileName);
        $modelOrig = $this->findModel($fileName);
        $model->scenario = Arquivo::SCENARIO_UPDATE; // Define o cenário de atualização
        if ($model->load(Yii::$app->request->post())) {
            $uploadedArquivo = UploadedFile::getInstance($model, 'file');
            if ($uploadedArquivo != null && !empty($uploadedArquivo)) {
                $model->file = $uploadedArquivo;
                $model->arquivo = $model->file->baseName . '.' . $model->file->extension;
                $model->tipo_arquivo = $model->file->type;
                $model->tamanho_arquivo = $model->file->size;
            } elseif ($uploadedArquivo == null || empty($uploadedArquivo)) {
                $model->file = $modelOrig->arquivo;
            }
            $uploadedCapa = UploadedFile::getInstance($model, 'printFile');
            if ($uploadedCapa != null && !empty($uploadedCapa)) {
                $model->printFile = $uploadedCapa;
                $model->print = $model->printFile->baseName . '.' . $model->printFile->extension;
            } elseif ($uploadedCapa == null || empty($uploadedCapa)) {
                $model->printFile = $modelOrig->print;
            }
            // Verificar se o checkbox de remoção foi marcado
//            if (Yii::$app->request->post('removerArquivo')) {
//                // Remover o arquivo existente
//                $model->arquivo = null; // Limpa o campo arquivo
//            }

            if ($model->uploadFiles()) {
                if ($model->save(false)) {
                    return $this->redirect(['view', 'file' => $model->id]);
                }
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Arquivo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $fileName ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($fileName) {
        try {
            $model = $this->findModel($fileName);
            if ($model) {
                $model->delete(); // Excluir do banco de dados se o registro for encontrado
            }
        } catch (NotFoundHttpException $e) {
            // Captura a exceção e permite que o processo continue, se o registro não estiver no banco
            Yii::$app->session->setFlash('warning', 'Ficheiro sem dados informativos na base de dados..');
        }

        // Código para eliminar ou mover o arquivo físico para a lixeira
        $basePath = \Yii::getAlias('@webroot/arquivos');
        $filePath = $basePath . DIRECTORY_SEPARATOR . urldecode(str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $fileName));

        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                Yii::$app->session->setFlash('success', 'Arquivo eliminado com sucesso.');
            } else {
                Yii::$app->session->setFlash('error', 'Ocorreu um erro ao tentar eliminar o arquivo.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'O arquivo não foi encontrado.');
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Biblioteca model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $file ID
     * @return Biblioteca the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($file) {
        if (($model = Arquivo::findOne(['arquivo' => $file])) !== null || ($model = Arquivo::findOne(['id' => $file])) !== null) {
            return $model;
        }


        throw new NotFoundHttpException(Yii::t('app', 'Ficheiro sem dados informativos na base de dados.'));
    }
}
