<?php

use backend\controllers\EventosController;
use backend\models\Doccomunicacao;
use backend\models\Provincia;
use buttflattery\formwizard\FormWizard;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;


/** @var View $this */
/** @var Doccomunicacao $model */
/** @var ActiveForm $form */
$getP2 = Provincia::find()
        ->asArray()
        ->all();

//print_r($getP2);
// Recupere todos os registros da tabela provincia
$provincias = Provincia::find()->all();
$provinciaArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($provincias as $provincia) {
    $provinciaArray[$provincia->Id] = $provincia->nomeProvincia;
}
//fim recuperar provincias
//

?>

<?=

FormWizard::widget(
        [
            'theme' => FormWizard::THEME_MATERIAL_V,
            'enablePersistence' => true,
            'labelNext' => 'Próximo',
            'labelPrev' => 'Anterior',
            'labelFinish' => 'Finalizar',
            // 'classNext'=>'btn btn-info botao',
            //   'transitionEffect'=>'slide',
            'steps' => [
                [
                    'model' => $models,
                    'title' => 'Identificação',
                    'description' => 'Secção 1',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldOrder' => [],
                    'fieldConfig' => [
                        // 'updated_at' => false, //hide a specific field
                        'provinciaID' => [
                            'widget' => Select2::class,
                            'containerOptions' => [
                                'class' => 'form-group',
                                'id' => 'provinciaID-container'
                            ],
                            'options' => [
                                'data' => ArrayHelper::map(Provincia::find()->all(), 'Id', 'nomeProvincia'),
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'placeholder' => 'Select'
                                ]
                            ],
                        ],
                        'municipioID' => [
                            'widget' => DepDrop::class,
                            'containerOptions' => [
                                'class' => 'form-group',
                                'id' => 'municipioID-container',
                            ],
                            'options' => [
                                'pluginOptions' => [
                                    'depends' => ['provinciaID-container'], // Dependência do Select2
                                    'placeholder' => 'Selecione o municipio...',
                                    'url' => Url::to(['/reforcoinstitucional/getmunicipio']),
                                    'initialize' => true, // Inicialize o campo DepDrop com um valor predefinido
                                    'params' => [Html::getInputId($models, 'provinciaID')], // Use o ID do campo provinciaID
                                ],
                            ],
                        ],
                         
                        'primeiroReporte' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione a data',
                                    'id' => 'primeiroReportp',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'actualizacao' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione a data',
                                    'id' => 'my-actualizacao',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'entidade' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => EventosController::getEnumValues('entidade'),
                                'prompt' => 'Selecione a Entidade Implementadora',
                            ],
                        ],
                        'only' => ['primeiroReporte', 'actualizacao', 'provinciaID', 'municipioID',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Descrição',
                    'description' => 'Secção 2',
                    'fieldConfig' => [
                        'descricaoTema' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'estadoDescricao' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => EventosController::getEnumValues('estadoDescricao'),
                                'prompt' => 'Selecione a Entidade Apoiada',
                            ],
                        ],
                        'parceiro' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => EventosController::getEnumValues('parceiro'),
                                'prompt' => 'Selecione a Entidade Apoiada',
                            ],
                        ],
                        'dataRelacionadaEstadForum' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre da publicação',
                                    'id' => 'my-publicacTrimestre',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'only' => ['descricaoTema',
                            'estadoDescricao',
                            'parceiro',
                            'dataRelacionadaEstadForum',
                            'tematicaAbordada',
                            'orador',
                            'localLink',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Nº de Participantes',
                    'description' => 'Secção 3',
                    'fieldConfig' => [
                       
                         'anexoForum' => [
                            'widget' => FileInput::classname(),
                            'options' => [
                                'options' => [
                                    'multiple' => false,
                                    'accept' => 'image/jpeg, image/png, image/gif, application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-powerpoint, application/vnd.openxmlformats-officedocument.presentationml.presentation',
                                    'pluginOptions' => [
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => true,
                                        'browseClass' => 'btn btn-primary btn-block',
                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                        'browseLabel' => 'Anexar Ficheiro',
                                        'allowedFileExtensions' => ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx'],
                                        'overwriteInitial' => true
                                    ],
                                ],
                            ],
                        ],
                        'only' => ['publicoAlvo',
                            'participantesHomem',
                            'participantesMulher',
                            'anexoForum',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'ONG - Desafios e Lições Aprendidas',
                    'description' => 'Secção 4',
                    'fieldConfig' => [
                        'desafiosONG' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'licoesONG' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['desafiosONG',
                            'licoesONG',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Missões de Monitoria UIC FRESAN/Camões, I.P.',
                    'description' => 'Secção 5',
                    'fieldConfig' => [
                        'dataVisitaFresan' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre de participantes na formacao',
                                    'id' => 'my-dataVisitaFresan',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'tecnicoResponsavelFresan' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'constantacoeFeitasFresan' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'recomendacoes' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['dataVisitaFresan',
                            'tecnicoResponsavelFresan',
                            'constantacoeFeitasFresan',
                            'recomendacoes',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Compromisso e Progresso',
                    'description' => 'Secção 6',
                    'fieldConfig' => [
                        'medidasMitigacaoONG' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'medidasMitigacaoEstado' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['medidasMitigacaoONG',
                            'medidasMitigacaoEstado',
                        ],
                    ],
                ],
            ],
        ]);
$models->userID = Yii::$app->user->identity->id; // pega o id do usuario logado e armazena para guardar junto com o formulario
?>