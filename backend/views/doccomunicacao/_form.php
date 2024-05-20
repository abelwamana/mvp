<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\controllers\DoccomunicacaoController;
use buttflattery\formwizard\FormWizard;
use backend\models\Provincia;
use backend\models\Municipio;
use backend\models\Comuna;
use backend\models\Localidade;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use backend\models\Doccomunicacao;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var backend\models\Doccomunicacao $model */
/** @var yii\widgets\ActiveForm $form */
$getP2 = Provincia::find()
        ->asArray()
        ->all();

// Recupere todos os registros da tabela provincia
$provincias = Provincia::find()->all();
$provinciaArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($provincias as $provincia) {
    $provinciaArray[$provincia->Id] = $provincia->nomeProvincia;
}
//fim recuperar provincias
// Recupere todos os registros da tabela Municipio
$municipios = Municipio::find()->all();
$municipiosArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($municipios as $municipio) {
    $municipiosArray[$municipio->Id] = $municipio->nomeMunicipio;
}

$classificacaoDoc = \backend\models\Classificacaodocumentoartigo::find()->all();
$classificacaoDocArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($classificacaoDoc as $classificacao) {
    $classificacaoDocArray[$classificacao->Id] = $classificacao->NomeClassficacao;
}
//fim recuperar provincias
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
                    'fieldOrder' => ['primeiroReporte', 'actualizacao', 'respondente', 'entidade', 'actividade', 'provinciaID', 'municipioID'],
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
                                'itemsList' => DoccomunicacaoController::getEnumEntidadeImplementadoraValues('entidade'),
                                'prompt' => 'Selecione a Entidade Implementadora',
                            ],
                        ],
                        'only' => ['primeiroReporte', 'actividade', 'actualizacao', 'entidade', 'respondente', 'provinciaID', 'municipioID'], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Descrição dos Documentos ou Artigos de Comunicação e Visibilidade',
                    'description' => 'Secção 2',
                    'fieldConfig' => [
                        'classificacaoDocumentoID' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => $classificacaoDocArray,
                                'prompt' => 'Selecione a Entidade Apoiada',
                            ],
                        ],
                        'areaTematica' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => Doccomunicacao::getEnumValues('areaTematica'),
                                'prompt' => 'Selecione a Entidade Apoiada',
                            ],
                        ],
                        'estado' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => Doccomunicacao::getEnumValues('estado'),
                                'prompt' => 'Selecione a Entidade Apoiada',
                            ],
                        ],
                        'descricaoDocumentoArtigo' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'dataConclusao' => [
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
                        'documentoDisponivel' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => Doccomunicacao::getEnumValues('documentoDisponivel'),
                                'prompt' => 'Selecione a Entidade Apoiada',
                            ],
                        ],
                        'documentoCumpreNormasPublicacao' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => Doccomunicacao::getEnumValues('documentoCumpreNormasPublicacao'),
                                'prompt' => 'Selecione a Entidade Apoiada',
                            ],
                        ],
                        'documentoValidado' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => Doccomunicacao::getEnumValues('documentoValidado'),
                                'prompt' => 'Selecione a Entidade Apoiada',
                            ],
                        ],
                        'anexo' => [
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
                        'only' => ['classificacaoDocumentoID', 'nomeDocumentoArtigo', 'areaTematica', 'descricaoDocumentoArtigo', 'audienciaProduto', 'qtdTotalProduto', 'estado', 'dataConclusao', 'documentoDisponivel', 'documentoCumpreNormasPublicacao', 'documentoValidado', 'anexo', 'hiperlink',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'ONG - Desafios e Lições Aprendidas',
                    'description' => 'Secção 8',
                    'fieldConfig' => [
                        'desafiosImplementacao' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'licoesAprendidas' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['desafiosImplementacao',
                            'licoesAprendidas'], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Missões de Monitoria UIC FRESAN/Camões, I.P.',
                    'description' => 'Secção 9',
                    'fieldConfig' => [
                        'dataMonitoria' => [
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
                        'tecnicoResponsavel' => [
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
                        'only' => ['dataMonitoria',
                            'tecnicoResponsavel',
                            'recomendacoes'], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Compromisso e Progresso',
                    'description' => 'Secção 10',
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
                        'only' => ['medidasMitigacao', 'medidasMitigacaoEstado',],
                    ],
                ],
            ],
        ]);
$models->userID = Yii::$app->user->identity->id; // pega o id do usuario logado e armazena para guardar junto com o formulario
?>



<?php

$this->registerJs('
    // Código JavaScript aqui
    $(document).ready(function() {
        // Capture o evento de mudança no Select2 de provinciaID
        $("#select2-doccomunicacao-provinciaid-container").on("change", function() {
            // Obtenha o valor selecionado
            var provinciaID = $(this).val();

            // Atualize o URL do DepDrop com o valor de provinciaID
            var depDrop = $("#doccomunicacao-municipioid");
            depDrop.data("depdrop").settings.params = { provinciaId: provinciaID };

            // Recrie o DepDrop para aplicar as alterações
            depDrop.depdrop("init");
        });
    });
');
?>
<?php

$this->registerJs('
    $(document).ready(function() {
        // Capture o evento de mudança no Select2 de municipioID
        $("#reforcoinstitucional-municipioid").on("change", function() {
            // Obtenha o valor selecionado
            var municipioID = $(this).val();

            // Atualize o URL do DepDrop com o valor de municipioID
            var depDrop = $("#reforcoinstitucional-comunaid");
            depDrop.data("depdrop").settings.params = { municipioId: municipioID };

            // Recrie o DepDrop para aplicar as alterações
            depDrop.depdrop("init");
        });
    });
');
?>