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

    public function actionIndex() {
        $basePath = \Yii::getAlias('@webroot/arquivos');
        $structure = $this->getDirectoryStructure($basePath);
        $parentPath = Yii::$app->request->get('path', 'arquivos'); // Define um valor padrão 'arquivos' se não estiver definido
        $searchModel = new ArquivoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
                    'structure' => $structure,
                    'parentPath' => $parentPath,
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
   
    // Ação para exibir todos os arquivos
    public function actionFicheiros()
    {
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

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionViewpage($id) {
        return $this->render('viewPage', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate($path) {
        $model = new Arquivo();
        if ($path != "undefined") {
            $parentPath = implode('/', explode(' > ', $path));
        } else {
            $parentPath = "arquivos";
        }
//        $parentPath = Yii::$app->request->get('path'); // Define um valor padrão 'arquivos' se não estiver definido
        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            $model->printFile = UploadedFile::getInstance($model, 'printFile');
//            $model->caminho = Yii::$app->request->post('Arquivo')['caminho']; // Captura o caminho do post
//            $model->pastaRais = Yii::$app->request->post('Arquivo')['pastaRais']; // Captura a pasta do post
            if ($model->upload()) {
                // salvar informações do arquivo no banco de dados
                if ($model->save(false)) {
                    Yii::$app->session->setFlash('success', 'Arquivo salvo com sucesso.');
                    return $this->redirect(['view', 'id' => $model->id]);
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
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
//            $model->save()
//            return $this->redirect(['view', 'id' => $model->id]);

            $model->file = UploadedFile::getInstance($model, 'file');
            $model->printFile = UploadedFile::getInstance($model, 'printFile');
            if ($model->upload()) {
                // salvar informações do arquivo no banco de dados
                $model->arquivo = $model->file->baseName . '.' . $model->file->extension;
                $model->print = $model->printFile->baseName . '.' . $model->printFile->extension;
                $model->tipo_arquivo = $model->file->type;
                $model->tamanho_arquivo = $model->file->size;
                $model->save(false);
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Biblioteca model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Biblioteca model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Biblioteca the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Arquivo::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
