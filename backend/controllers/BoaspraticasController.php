<?php

namespace backend\controllers;

use backend\models\Boaspraticas;
use backend\models\BoaspraticasSearch;
use backend\models\Provincia;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * BoaspraticasController implements the CRUD actions for Boaspraticas model.
 */
class BoaspraticasController extends Controller {

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
     * Lists all Boaspraticas models.
     *
     * @return string
     */
    public function actionIndex() {
        $searchModel = new BoaspraticasSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Boaspraticas model.
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
     * Creates a new Boaspraticas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function ListaProvincias() {

        $provincias = Provincia::find()->all();

// Separe "Interprovincial" e "Outra" das outras províncias
        $provinciaInterprovincial = null;
        $provinciaOutra = null;
        $provinciasList = [];
        $count = 0;
        foreach ($provincias as $provincia) {
            if ($provincia->nomeProvincia === 'Interprovincial') {
                $provinciaInterprovincial = $provincia;
            } elseif ($provincia->nomeProvincia === 'Outra') {
                $provinciaOutra = $provincia;
            } else {
                if ($count < 3) {
                    $provinciasList[$provincia->Id] = $provincia->nomeProvincia;
                    $count++;
                }
            }
        }

// Ordene o array de províncias em ordem alfabética
        asort($provinciasList);

// Adicione "Interprovincial" e "Outra" ao final
        if ($provinciaInterprovincial !== null) {
            $provinciasList[$provinciaInterprovincial->Id] = $provinciaInterprovincial->nomeProvincia;
        }
        if ($provinciaOutra !== null) {
            $provinciasList[$provinciaOutra->Id] = $provinciaOutra->nomeProvincia;
        }
        return $provinciasList; // Retorna a lista de províncias
    }

    public function actionGetBoasPraticas($area) {
        // Buscar as boas práticas da base de dados com base na área
        $boasPraticas = BoasPraticas::find()->where(['area' => $area])->all();

        // Renderizar a vista parcial com as boas práticas
        return $this->renderPartial('_boas_praticas', ['boasPraticas' => $boasPraticas]);
    }

    public function actionCreate() {
        $model = new Boaspraticas();
        $model->scenario = Boaspraticas::SCENARIO_CREATE; // Define o cenário de criação
        $provinciasList = $this->ListaProvincias();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if (!is_string($model->area)) {
                    $areaString = implode(', ', $model->area);
                    $model->area = $areaString;
                }
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
                    'model' => $model, 'provinciasList' => $provinciasList,
        ]);
    }

    /**
     * Updates an existing Boaspraticas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id) {
        $model = $this->findModel($Id);
        $modelOrig = $this->findModel($Id);
        $model->scenario = Boaspraticas::SCENARIO_UPDATE; // Define o cenário de atualização
        $provinciasList = $this->ListaProvincias();
        // Converter a string do campo `area` para um array para exibição no formulário.
        $model->area = !empty($model->area) ? explode(', ', $model->area) : [];
        if ($model->load(Yii::$app->request->post())) {
             $model->aprovado = 0;
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
                    'model' => $model, 'provinciasList' => $provinciasList,
        ]);
    }

    /**
     * Deletes an existing Boaspraticas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id) {
        $this->findModel($Id)->delete();

        return $this->redirect(['index']);
    }

    public function actionBoaspraticas() {

        $boaspratias = Boaspraticas::find()->where(['aprovado' => 1])->all();
        return $this->render('boaspraticasPage', ['boaspraticas' => $boaspratias]
        );
    }

    public function actionBoaspraticasestatic() {
        return $this->render('boaspraticas');
    }

    /**
     * Finds the Boaspraticas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return Boaspraticas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id) {
        if (($model = Boaspraticas::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionApprove($Id) {
        $model = $this->findModel($Id);
        if ($model) {
            $model->aprovado = 1; // 1 para aprovado
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Boa prática aprovada com sucesso.');
            } else {
                Yii::$app->session->setFlash('error', 'Falha ao aprovar a boa prática.');
            }
        }
        return $this->redirect(['view', 'Id' => $model->Id]);
    }
}
