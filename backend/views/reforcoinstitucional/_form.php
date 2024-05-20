<script>


</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php

use backend\controllers\ReforcoinstitucionalController;
use backend\models\Comuna;
use backend\models\Localidade;
use backend\models\Municipio;
use backend\models\Provincia;
use backend\models\Reforcoinstitucional;
use buttflattery\formwizard\FormWizard;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use kartik\depdrop\DepDropAsset;
use kartik\file\FileInput;
use kartik\select2\Select2;
use kartik\select2\Select2Asset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

DepDropAsset::register($this);
Select2Asset::register($this);

// Criar uma instância de JsExpression com código JavaScript
// ... Seu código continua aqui


/** @var View $this */
/** @var Reforcoinstitucional $model */
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
//
//
//
// Recupere todos os registros da tabela Municipio
$municipios = Municipio::find()->all();
$municipiosArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($municipios as $municipio) {
    $municipiosArray[$municipio->Id] = $municipio->nomeMunicipio;
}
//fim recuperar provincias
//
//
//
// Recupere todos os registros da tabela Municipio
$comunas = Comuna::find()->all();
$comunasArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($comunas as $comuna) {
    $comunasArray[$comuna->Id] = $comuna->nomeComuna;
}
//fim recuperar provincias
//
//
//
// Recupere todos os registros da tabela Municipio
$localidades = Localidade::find()->all();
$localidadesArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($localidades as $localidade) {
    $localidadesArray[$localidade->Id] = $localidade->nomeLocalidade;
}
//fim recuperar provincias
//print_r(Municipio::getDefProvincias(1));
//print_r(Municipio::getProvincias(2));
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
                                    'id' => 'my-actualizacao',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                       
                        'only' => ['primeiroReporte', 'actualizacao', 'provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'latitude', 'longitude',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Formações a Entidades Públicas',
                    'description' => 'Secção 2',
                    'fieldConfig' => [
                        'entidadeApoiada' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => ReforcoinstitucionalController::getEnumEntidadeApoiadaValues('entidadeApoiada'),
                                'prompt' => 'Selecione a Entidade Apoiada',
                            ],
                        ],
                        'nSessoesPubliTrimestre' => [
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
                        'participantesFormacaoTrimestre' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre de participantes na formacao',
                                    'id' => 'my-formacaoTrimestre',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'anexoProgramaFormacao' => [
                            'widget' => FileInput::classname(),
                            'options' => [
                                'options' => [
                                    'multiple' => false,
                                    'accept' => 'file/*',
                                    'pluginOptions' => [
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => false,
                                        'browseClass' => 'btn btn-primary btn-block',
                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                        'browseLabel' => 'Anexar Ficheiro',
                                        'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                                        'overwriteInitial' => false
                                    ],
                                ],
                            ],
                        ],
                        'only' => ['entidadeApoiada', 'apoioCapacitacao', 'temaAbordadoSessoes', 'nSessoesPublicoAlvo', 'nSessoesPubliTrimestre', 'nHorasSessoes', 'participantesFormacaoHomem', 'participantesFormacaoMulher', 'participantesFormacaoTrimestre', 'anexoProgramaFormacao'], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Equipamentos/Insumos entregues a Entidades Públicas',
                    'description' => 'Secção 3',
                    'fieldConfig' => [
                        'descricaoEquipamentos' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'anexoTermoEntreEquipamento' => [
                            'widget' => FileInput::classname(),
                            'options' => [
                                'options' => [
                                    'multiple' => false,
                                    'accept' => 'file/*',
                                    'pluginOptions' => [
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => false,
                                        'browseClass' => 'btn btn-primary btn-block',
                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                        'browseLabel' => 'Anexar Ficheiro',
                                        'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                                        'overwriteInitial' => false
                                    ],
                                ],
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['descricaoEquipamentos', 'qtdEquipEntregues', 'anexoTermoEntreEquipamento'], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Campanha de Vacinação',
                    'description' => 'Secção 4',
                    'fieldConfig' => [
                        'anexoTermoEntrMeiosCampanhaVacinacao' => [
                            'widget' => FileInput::classname(),
                            'options' => [
                                'options' => [
                                    'multiple' => false,
                                    'accept' => 'file/*',
                                    'pluginOptions' => [
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => false,
                                        'browseClass' => 'btn btn-primary btn-block',
                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                        'browseLabel' => 'Anexar Ficheiro',
                                        'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                                        'overwriteInitial' => false
                                    ],
                                ],
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['nAnimaisVacinadosCampanha', 'meiosEntreguEntiCampanhaVacinacaoDesc', 'nmeiosDistriEntiCampanhaVacinacao', 'anexoTermoEntrMeiosCampanhaVacinacao'], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Mapeamento de Tratadores de Gado',
                    'description' => 'Secção 5',
                    'fieldConfig' => [
                        'trataGadoForamMapeadosTrim' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre de participantes na formacao',
                                    'id' => 'my-trataGadoForamMapeadosTrim',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['trataGadoForamMapeadosHomem', 'trataGadoForamMapeadosMulher', 'trataGadoForamMapeadosTrim',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Formação de Tratadores de Gado',
                    'description' => 'Secção 6',
                    'fieldConfig' => [
                        'nSessoesRealiFormGadoTrimestre' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre de participantes na formacao',
                                    'id' => 'my-tnSessoesRealiFormGadoTrimestre',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'participantesFormacaoGadoTrimestre' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre de participantes na formacao',
                                    'id' => 'my-participantesFormacaoGadoTrimestre',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'anexoProgramaFormaGado' => [
                            'widget' => FileInput::classname(),
                            'options' => [
                                'options' => [
                                    'multiple' => false,
                                    'accept' => 'file/*',
                                    'pluginOptions' => [
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => false,
                                        'browseClass' => 'btn btn-primary btn-block',
                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                        'browseLabel' => 'Anexar Ficheiro',
                                        'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                                        'overwriteInitial' => false
                                    ],
                                ],
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['temaAbordadoFormaGado',
                            'nSessoesRealiFormGado',
                            'nSessoesRealiFormGadoTrimestre',
                            'nTotalHorasFormacaoGado',
                            'participantesFormacaoGadoHomem',
                            'participantesFormacaoGadoMulher',
                            'participantesFormacaoGadoTrimestre',
                            'totalCabecaGado',
                            'anexoProgramaFormaGado'], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Kits Veterinários Distribuídos',
                    'description' => 'Secção 7',
                    'fieldConfig' => [
                        'descricaoEquipamentos' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'anexoKitDistri' => [
                            'widget' => FileInput::classname(),
                            'options' => [
                                'options' => [
                                    'multiple' => false,
                                    'accept' => 'file/*',
                                    'pluginOptions' => [
                                        'showCaption' => false,
                                        'showRemove' => false,
                                        'showUpload' => false,
                                        'browseClass' => 'btn btn-primary btn-block',
                                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                        'browseLabel' => 'Anexar Ficheiro',
                                        'allowedFileExtensions' => ['jpg', 'gif', 'png'],
                                        'overwriteInitial' => false
                                    ],
                                ],
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['distriKitVeterinaria',
                            'composicaoKitVeter',
                            'nTotalKitDistribuido',
                            'anexoKitDistri'], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'ONG - Desafios e Lições Aprendidas',
                    'description' => 'Secção 8',
                    'fieldConfig' => [
                        'desafiosImplementacaoONG' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'licoesAprendidasONG' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['desafiosImplementacaoONG',
                            'licoesAprendidasONG'], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Missões de Monitoria UIC FRESAN/Camões, I.P.',
                    'description' => 'Secção 9',
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
                        'only' => ['medidasMitigacaoONG', 'medidasMitigacaoEstado',],
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
        $("#select2-reforcoinstitucional-provinciaid-container").on("change", function() {
            // Obtenha o valor selecionado
            var provinciaID = $(this).val();

            // Atualize o URL do DepDrop com o valor de provinciaID
            var depDrop = $("#reforcoinstitucional-municipioid");
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
<?php
$this->registerJs('
    $(document).ready(function() {
        // Capture o evento de mudança no Select2 da comundaID
        $("#reforcoinstitucional-comunaid").on("change", function() {
            // Obtenha o valor selecionado
            var comunaID = $(this).val();

            // Atualize o URL do DepDrop com o valor de localidadeID
            var depDrop = $("#reforcoinstitucional-localidadeid");
            depDrop.data("depdrop").settings.params = { localidadeId: localidadeID };

            // Recrie o DepDrop para aplicar as alterações
            depDrop.depdrop("init");
        });
    });
');
?>


