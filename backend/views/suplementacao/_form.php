<?php

use backend\models\Provincia;
use backend\models\Suplementacao;
use buttflattery\formwizard\FormWizard;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var View $this */
/** @var Suplementacao $model */
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
                        'nSuplemViTrimestre' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione a data',
                                    'id' => 'primeiroReportpq',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'nDesparatizacaoTrimestre' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione a data',
                                    'id' => 'nDesparatizacaoTrimestre',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'primeiroReporte' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione a data',
                                    'id' => 'primeiroReporte1',
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
                        'only' => ['provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'nSuplemVit', 'nSuplemViTrimestre',
                            'nDesparatizacao', 'nDesparatizacaoTrimestre', 'primeiroReporte', 'actualizacao',
                            'latitude', 'longitude', 'desafiosImplementacaoONG', 'licoesImplementacaoONG', 'dataVisitaFresan',
                            'tecnicoResponsavelFresan', 'constatacoesFeitasFresan', 'recomendacoesPrincipaisFresan', 'medidasMitigacaoONG',
                            'medidasMitigacaoEstado'
                        ], // all fields except these will be added in the step
                    ],
                ],
            ],
        ]);
?>

