
<?php

use backend\models\Demostracoesculinarias;
use backend\models\Provincia;
use buttflattery\formwizard\FormWizard;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var Demostracoesculinarias $model */
/** @var ActiveForm $form */
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
//                        
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
                            'comunaID' => [
                                'widget' => DepDrop::class,
                                'containerOptions' => [
                                    'class' => 'form-group',
                                    'id' => 'comunaID-container', // Adicione um ID ao container
                                ],
                                'options' => [
                                    'pluginOptions' => [
                                        'depends' => ['municipioID-container'], // Dependente do campo 'municipioID-container'
                                        'placeholder' => 'Selecione a Comuna...',
                                        'url' => Url::to(['/reforcoinstitucional/getcomuna']),
                                        'initialize' => true, // Inicialize o campo DepDrop com um valor predefinido
                                        'params' => [Html::getInputId($models, 'municipioID')], // Use o ID do campo municipioID
                                    ],
                                ],
                            ],
                            'localidadeID' => [
                                'widget' => DepDrop::class,
                                'containerOptions' => [
                                    'class' => 'form-group',
                                    'id' => 'localidadeID-container', // Adicione um ID ao container
                                ],
                                'options' => [
                                    'pluginOptions' => [
                                        'depends' => ['comunaID-container'], // Dependente do campo 'municipioID-container'
                                        'placeholder' => 'Selecione a Localidade...',
                                        'url' => Url::to(['/reforcoinstitucional/getlocalidade']),
                                        'initialize' => true, // Inicialize o campo DepDrop com um valor predefinido
                                        'params' => [Html::getInputId($models, 'comunaID')], // Use o ID do campo municipioID
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
                                        'id' => 'my-actualizacao2',
                                        'class' => 'form-control',
                                    ],
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                    // Outras opções do plugin, se necessário
                                    ],
                                ],
                            ],
                            'nDemostracaoCulinariaTrimestre' => [
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
                           
                            'anexoEvidenciaDemonsCulinaria' => [
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
                            'desafiosImplementacaoONG' => [
                                'options' => [
                                    'type' => 'textarea',
                                    'class' => 'form-control',
                                    'cols' => 25,
                                    'rows' => 10
                                ]
                            ],
                            'licoesImplementacaoONG' => [
                                'options' => [
                                    'type' => 'textarea',
                                    'class' => 'form-control',
                                    'cols' => 25,
                                    'rows' => 10
                                ]
                            ],
                            'dataVisitaFresan' => [
                                'widget' => DatePicker::class,
                                'options' => [
                                    'options' => [
                                        'placeholder' => 'Selecione a data',
                                        'id' => 'my-bisitaF',
                                        'class' => 'form-control',
                                    ],
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                    // Outras opções do plugin, se necessário
                                    ],
                                ],
                            ],
                            'constatacoesFeitasFresan' => [
                                'options' => [
                                    'type' => 'textarea',
                                    'class' => 'form-control',
                                    'cols' => 25,
                                    'rows' => 10
                                ]
                            ],
                            'recomendacoesPrincipaisFresan' => [
                                'options' => [
                                    'type' => 'textarea',
                                    'class' => 'form-control',
                                    'cols' => 25,
                                    'rows' => 10
                                ]
                            ],
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
                            'only' => [
                                'provinciaID',
                                'municipioID',
                                'comunaID',
                                'localidadeID',
                                'nDemostracaoCulinaria',
                                'nDemostracaoCulinariaTrimestre',
                                'beneficiariosDemoCuliHomem',
                                'beneficiariosDemoCuliMulher',
                                'anexoEvidenciaDemonsCulinaria',
                                'primeiroReporte',
                                'actualizacao',
                                'latitude',
                                'longitude',
                                'desafiosImplementacaoONG',
                                'licoesImplementacaoONG',
                                'dataVisitaFresan',
                                'tecnicoResponsavelFresan',
                                'constatacoesFeitasFresan',
                                'recomendacoesPrincipaisFresan',
                                'medidasMitigacaoONG',
                                'medidasMitigacaoEstado',
                            //'nomeGrupoID',
                            ], // all fields except these will be added in the step
                        ],
                    ],
                ],
    ]);
     ?>
