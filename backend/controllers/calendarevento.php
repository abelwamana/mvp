<?php
namespace backend\controllers;

use Yii;
use backend\models\calendarevento;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * Description of calendareventoController
 *
 * @author abel.wamana
 */
class calendareventoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // Busca todos os eventos do banco de dados
        $eventos = Calendarevento::find()->all();

        // Renderiza a visualização index.php e passa os eventos para ela
        return $this->render('index', [
            'eventos' => $eventos,
        ]);
    }
}
