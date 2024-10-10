<?php

namespace backend\controllers;

use backend\models\Recomendacoes;
use backend\models\RecomendacoesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * RecomendacoesController implements the CRUD actions for Recomendacoes model.
 */
class RecomendacoesController extends Controller
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
     * Lists all Recomendacoes models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RecomendacoesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionRecomendacoes() {

        $recomendacoes = Recomendacoes::find()->all();
        return $this->render('recomendacoesPage', ['recomendacoes' => $recomendacoes]
        );
    }

    /**
     * Displays a single Recomendacoes model.
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
     * Creates a new Recomendacoes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Recomendacoes();

       $model->scenario = Recomendacoes::SCENARIO_CREATE; // Define o cenário de criação
        if ($this->request->isPost) {
             if (is_array($model->area)) {
                $model->area = implode(', ', $model->area);
            }
            if ($model->load($this->request->post())) {
                $model->fotoFile = UploadedFile::getInstance($model, 'fotoFile');
                if ($model->upload()) {
                    // salvar informações do arquivo no banco de dados
                    $model->fotografia = $model->fotoFile->baseName . '.' . $model->fotoFile->extension;
                    $model->save(false);
                    return $this->redirect(['view', 'Id' => $model->Id]);
                }
            } else {
                $model->loadDefaultValues();
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Recomendacoes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id)
    {
        $model = $this->findModel($Id);

         $modelOrig = $this->findModel($Id);
        $model->scenario = Recomendacoes::SCENARIO_UPDATE; // Define o cenário de atualização
        $model->area = !empty($model->area) ? explode(', ', $model->area) : [];
        if ($model->load(Yii::$app->request->post())) {
            // Converter o array `area` de volta para string antes de salvar no banco de dados.
            if (is_array($model->area)) {
                $model->area = implode(', ', $model->area);
            }
            $uploadedFoto = UploadedFile::getInstance($model, 'fotoFile');
            if ($uploadedFoto != null && !empty($uploadedFoto)) {
                $model->fotoFile = $uploadedFoto;
                $model->fotografia = $model->fotoFile->baseName . '.' . $model->fotoFile->extension;
            } else {
                // Manter o valor da fotografia existente se não for feito upload de uma nova imagem.
                $model->fotografia = $modelOrig->fotografia;
            }
            if ($model->upload()) {
                if ($model->save(false)) {
                    return $this->redirect(['view', 'Id' => $model->Id]);
                }
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Recomendacoes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id)
    {
        $this->findModel($Id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Recomendacoes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return Recomendacoes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id)
    {
        if (($model = Recomendacoes::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
