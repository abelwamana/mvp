<?php

namespace backend\controllers;

use backend\models\Biblioteca;
use backend\models\BibliotecaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * BibliotecaController implements the CRUD actions for Biblioteca model.
 */
class BibliotecaController extends Controller
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
     * Lists all Biblioteca models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BibliotecaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Biblioteca model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Biblioteca model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
    
         $model = new Biblioteca();

         if ($model->load(Yii::$app->request->post())) {
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

        return $this->render('create', [
            'model' => $model,
        ]);           
    }

    /**
     * Updates an existing Biblioteca model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
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
    public function actionDelete($id)
    {
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
    protected function findModel($id)
    {
        if (($model = Biblioteca::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
     public function actionDownload($id)
{
    $model = Biblioteca::findOne($id);
    if ($model) {
        $file = Yii::getAlias('@webroot') . '/biblioteca/' . $model->arquivo;
        if (file_exists($file)) {
            return Yii::$app->response->sendFile($file);
        }
    }
    throw new \yii\web\NotFoundHttpException('O arquivo não foi encontrado.');
}
}
