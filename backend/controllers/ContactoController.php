<?php

namespace backend\controllers;

use backend\models\Contacto;
use backend\models\ContactoSearch;
use yii\web\Controller;
use backend\models\Municipio;
use backend\models\Comuna;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii;

/**
 * ContactoController implements the CRUD actions for Contacto model.
 */
class ContactoController extends Controller
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
     * Lists all Contacto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ContactoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

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
    public function actionView($Id)
    {
        return $this->render('view', [
            'model' => $this->findModel($Id),
        ]);
    }

    /**
     * Creates a new Contacto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    public function actionCreate()
{
    $model = new Contacto();

    if ($this->request->isPost) {
        if ($model->load($this->request->post())) {
            // Atualize a propriedade real 'actividades' com a string do campo oculto
            $model->actividades = Yii::$app->request->post('Contacto')['actividades'];
            if ($model->save()) {
                return $this->redirect(['view', 'Id' => $model->Id]);
            }
        }
    } else {
        $model->loadDefaultValues();
    }

    // Inicialize a propriedade virtual 'actividadesSelect' como um array vazio
//    $model->actividadesSelect = [];

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
//    public function actionUpdate($Id)
//    {
//        $model = $this->findModel($Id);
//
//        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'Id' => $model->Id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);
//    }

    public function actionUpdate($Id)
{
    $model = $this->findModel($Id);

    if ($model->load(Yii::$app->request->post())) {
        // Atualize a propriedade real 'actividades' com a string do campo oculto
//        $model->actividades = Yii::$app->request->post('Contacto')['actividades'];
       $actividadesString= implode(",", $model->actividades);
       $model->actividades=$actividadesString;
        if ($model->save()) {
            return $this->redirect(['view', 'Id' => $model->Id]);
        }
    }

    // Inicialize a propriedade virtual 'actividadesSelect' com os valores atuais
//    $model->actividadesSelect = explode(', ', $model->actividades);

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
    public function actionDelete($Id)
    {
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
    protected function findModel($Id)
    {
        if (($model = Contacto::findOne(['Id' => $Id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
