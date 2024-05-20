<?php
namespace backend\controllers;

use Yii;
use backend\models\calendarevento;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\Response;
use backend\models\Event;
use yii\filters\AccessControl;
/**
 * Description of calendareventoController
 *
 * @author abel.wamana
 */
class EventController extends Controller
{
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
                        'actions' => ['logout', 'index', 'folhatrimestral', 'exportfolhatrimestral', 'calendario2', 'fresan', 'beneficiario', 'galeria', 'get-events', 'filtragem', 'duracao', 'get-provincias', 'experiencia', 'get-municipios', 'get-comunas', 'events-area', 'add-events', 'emconstrucao', 'fresancunene', 'fresanhuila', 'fresannamibe', 'resultadosagricultura', 'resultadosnutricao', 'resultadosagua', 'resultadosreforcoinstitucional'],
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
    
    public function actionIndex()
    {
        // Busca todos os eventos do banco de dados
        $eventos = \backend\models\Event::find()->all();
//             $eventos= $this->actionGetEvents();   
        
        // Renderiza a visualização index.php e passa os eventos para ela
        return $this->render('index', [
            'eventos' => $eventos,
        ]);
    }
         public function actionGetEvents()
{
    $entidadesSelecionadas = Yii::$app->request->get('entidades');
    $provinciasSelecionadas = Yii::$app->request->get('provincias');
    $areasSelecionadas = Yii::$app->request->get('areas');
    $dataInicio = Yii::$app->request->get('dataInicio');
    $dataFim = Yii::$app->request->get('dataFim');

    // Obter eventos filtrados
    $events = Event::getFilteredEvents($entidadesSelecionadas, $provinciasSelecionadas, $areasSelecionadas, $dataInicio, $dataFim);

//    return $events;
    return $this->render('index', ['eventos' => $events]);
}

}
