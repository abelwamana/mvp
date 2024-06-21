<?php

namespace backend\controllers;

use backend\models\Contacto;
use backend\models\ContactoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Municipio;
use backend\models\Comuna;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

/**
 * ContactoController implements the CRUD actions for Contacto model.
 */
class ContactoController extends Controller {

    /**
     * @inheritDoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','view','update','create', 'delete', 'get-municipios', 'get-comunas'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    } 
    /**
     * Lists all Contacto models.
     *
     * @return string
     */
    public function actionIndex() {
    $searchModel = new ContactoSearch();
    $dataProvider = $searchModel->search($this->request->queryParams);
    // Adicionando a configuração de paginação
    $dataProvider->pagination->pageSize = 10; // Ou qualquer outro tamanho desejado

    return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
}

    /**
     * Displays a single Contacto model.
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
     * Creates a new Contacto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate() {
        $model = new Contacto();

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
     * Updates an existing Contacto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $Id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($Id) {
        $model = $this->findModel($Id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'Id' => $model->Id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contacto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $Id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($Id) {
        $this->findModel($Id)->delete();

        return $this->redirect(['index']);
    }

    public function actionGetMunicipios($id) {
        //Yii::$app->response->format = Response::FORMAT_JSON;

        $municipios = Municipio::find()->where(['provinciaID' => $id])->all();
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

    /**
     * Finds the Contacto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $Id ID
     * @return Contacto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($Id) {
        if (($model = Contacto::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'A página solicitada não existe.'));
    }
}
