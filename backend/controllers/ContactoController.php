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
//use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
//use PhpOffice\PhpSpreadsheet\Writer\Csv;
//use mPDF\mPDF;

require_once __DIR__ . '/../../vendor/autoload.php';




/**
 * ContactoControl+ler implements the CRUD actions for Contacto model.
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
            if (is_array($model->actividades)) {
                // Concatenar os elementos do array em uma string
                $model->actividades = implode(',', $model->actividades);
            }
            // Atualize a propriedade real 'actividades' com a string do campo oculto
//            $model->actividades = Yii::$app->request->post('Contacto')['actividades'];0
//             $model->actividades = Yii::$app->request->post('Contacto')['actividades'];
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

public function actionExportXls()
{
    $searchModel = new ContactoSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    $dataProvider->pagination = false;
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    
    $columns = ['Nome', 'Contacto', 'Email', 'Função', 'Instituição', 'Província', 'Município', 'Comuna', 'Localidade', 'País', 'Ponto Focal', 'Atividades', 'Entidade', 'Nível', 'Rótulo', 'Privacidade', 'Estado', 'Usuário'];

    // Cabeçalho
    $columnIndex = 'A';
    foreach ($columns as $column) {
        $sheet->setCellValue($columnIndex . '1', $column);
        $columnIndex++;
    }

    // Dados
    $rowIndex = 2;
    foreach ($dataProvider->getModels() as $model) {
        $columnIndex = 'A';
//        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->Id);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->nome);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->contacto);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->email);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->funcao);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->instituicao);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->provincia ? $model->provincia->nomeProvincia : '');
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->municipio ? $model->municipio->nomeMunicipio : '');
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->comuna ? $model->comuna->nomeComuna : '');
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->localidade);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->pais);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->pontofocal);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->actividades);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->entidade);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->nivel);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->rotulo);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->privacidade);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->estado);
        $sheet->setCellValue($columnIndex++ . $rowIndex, $model->usuario);
        $rowIndex++;
    }

    // Salvar arquivo
    $filename = 'Contactos-SGI Fresan Camões I.P.xlsx';
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save('php://output');
    exit();
}

// Função de exportação para PDF
    public function actionExportPdf()
    {
        $searchModel = new ContactoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $mpdf = new \mPDF();

        // Cabeçalho
        $html = '<h1>Exportação de Contactos</h1>';
        $html .= '<table border="1" cellspacing="0" cellpadding="5">';
        $html .= '<thead><tr>';
        $columns = ['ID','Nome', 'Contacto', 'Email', 'Função', 'Instituição', 'Província', 'Município', 'Comuna', 'Localidade', 'País', 'Ponto Focal', 'Atividades', 'Entidade', 'Nível', 'Rótulo', 'Privacidade', 'Estado', 'Usuário'];
        foreach ($columns as $column) {
            $html .= "<th>{$column}</th>";
        }
        $html .= '</tr></thead>';
        $html .= '<tbody>';

        // Dados
        foreach ($dataProvider->getModels() as $model) {
            $html .= '<tr>';
            $html .= "<td>{$model->Id}</td>";
            $html .= "<td>{$model->nome}</td>";
            $html .= "<td>{$model->contacto}</td>";
            $html .= "<td>{$model->email}</td>";
            $html .= "<td>{$model->funcao}</td>";
            $html .= "<td>{$model->instituicao}</td>";
//            $html .= "<td>{$model->provinciaNome}</td>";
//            $html .= "<td>{$model->municipioNome}</td>";
//            $html .= "<td>{$model->comunaNome}</td>";
            $html .= "<td>{$model->localidade}</td>";
            $html .= "<td>{$model->pais}</td>";
            $html .= "<td>{$model->pontofocal}</td>";
            $html .= "<td>{$model->actividades}</td>";
            $html .= "<td>{$model->entidade}</td>";
            $html .= "<td>{$model->nivel}</td>";
            $html .= "<td>{$model->rotulo}</td>";
            $html .= "<td>{$model->privacidade}</td>";
            $html .= "<td>{$model->estado}</td>";
            $html .= "<td>{$model->usuario}</td>";
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';

        $mpdf->WriteHTML($html);
        $mpdf->Output('grade-exportacao.pdf', 'D');
        exit();
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
