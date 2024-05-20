<style>
    /* Ocultar o texto original do botão */
    .formwizard_restore {
        font-size: 0; /* Torna o texto do botão invisível */
    }

    /* Adicionar o novo texto após o botão */
    .formwizard_restore::after {
        content: "Restaurar valores";
        font-size: 16px; /* Defina o tamanho da fonte desejado */
    }
</style>
<?php

use backend\controllers\AguaController;
use backend\models\Agua;
use backend\models\Comuna;
use backend\models\Grupo;
use backend\models\Localidade;
use backend\models\Municipio;
use backend\models\Provincia;
use backend\models\Unidade;
use buttflattery\formwizard\FormWizard;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\helpers\Html;
use kartik\widgets\DepDrop;
use kartik\file\FileInput;

/** @var View $this */
/** @var Agua ($models */
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

$unidades = Unidade::find()->all();
$unidadeArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($unidades as $unidade) {
    $unidadeArray[$unidade->Id] = $unidade->unidade;
}

$grupos = Grupo::find()->all();
$grupoArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($grupos as $grupo) {
    $grupoArray[$grupo->Id] = $grupo->nomeGrupo;
}
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
                    'fieldOrder' => ['primeiroReporte', 'actualizacao'], //ordenamento dos campos da tabela
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
                                    'placeholder' => 'Selecione a província'
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
                        'primeiroReporte' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione a data do primeiro reporte',
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
                                    'placeholder' => 'Selecione a data da actualização',
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
                    'title' => 'Caracterização Infraestrutura',
                    'formInfoText' => 'Preencha todos os campos',
                    'description' => 'Secção 2',
                    'fieldConfig' => [
                        'infraEstrutura' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('infraEstrutura'),
                                'prompt' => 'Selecione a Infra Estrutura',
                            ],
                        ],
                        'fonteHidraulica' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('fonteHidraulica'),
                                'prompt' => 'Selecione a Fonte Hidraulica',
                            ],
                        ],
                        'fonteHidraulicaAlternativa' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('fonteHidraulicaAlternativa'),
                                'prompt' => 'Selecione a Fonte Hidraulica Alternativa',
                            ],
                        ],
                        'servicoAssociado' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('servicoAssociado'),
                                'prompt' => 'Selecione o servico Associado',
                            ],
                        ],
                        'novaConstrucao' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('novaConstrucao'),
                                'prompt' => 'Selecione  a nova Construcao',
                            ],
                        ],
                        'fimAQueSeDestina' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('novaConstrucao'),
                                'prompt' => 'Selecione  fimAQueSeDestina',
                            ],
                        ],
                        'capacidadeUnidadeID' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => $unidadeArray,
                                'prompt' => 'Selecione a Comuna',
                            ]
                        ],
                        'realizadoTesteQualidadeAgua' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('realizadoTesteQualidadeAgua'),
                                'prompt' => 'Selecione  realizadoTesteQualidadeAgua',
                            ],
                        ],
                        'entidadeResponsavelConstrucao' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('entidadeResponsavelConstrucao'),
                                'prompt' => 'Selecione a entidade Responsável pela Construção',
                            ],
                        ],
                        'sistemExtracaoAgua' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('sistemExtracaoAgua'),
                                'prompt' => 'Selecione  o Sistema de Extracção e Distribuição de Água',
                            ],
                        ],
                        'nomeCampoAssociadoGrupoID' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => ArrayHelper::map(Grupo::find()
                                                ->select('nomeGrupo')
                                                ->distinct()
                                                ->asArray()
                                                ->all(),  'Id', 'nomeGrupo'), //$grupoArray,
                                'prompt' => 'Selecione o grupo/ campo associado',
                            ]
                        ],
                        'temPlacaVisibilidade' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('temPlacaVisibilidade'),
                                'prompt' => 'Selecione Tem Placa de Visibilidade',
                            ],
                        ],
                        'infraAssociadaCampo' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('infraAssociadaCampo'),
                                'prompt' => 'Selecione infraestrutura associada ao Campo',
                            ],
                        ],
                        'anexoFichaTecnInfraExtr' => [
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
                        'only' => ['infraEstrutura',
                            'fonteHidraulica',
                            'fonteHidraulicaAlternativa',
                            'servicoAssociado',
                            'novaConstrucao',
                            'fimAQueSeDestina',
                            'capacidadeInfraestrutura',
                            'capacidadeUnidadeID',
                            'realizadoTesteQualidadeAgua',
                            'entidadeResponsavelConstrucao',
                            'anosGarantia',
                            'sistemExtracaoAgua',
                            'especificacoesTecnInfraExtru',
                            'temPlacaVisibilidade',
                            'infraAssociadaCampo',
                            'nomeCampoAssociadoGrupoID',
                            'anexoFichaTecnInfraExtr',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Estado da construção/reabilitação',
                    'description' => 'Secção 3',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'estadoObra' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('estadoObra'),
                                'prompt' => 'Selecione o estado da Obra',
                            ],
                        ],
                        'imagemInfra' => [
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
                        'dataConclusaoObra' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione a data de Conclusão da Obra',
                                    'id' => 'my-dataConclusaoObra',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'pontoFoiEntregueObra' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('pontoFoiEntregueObra'),
                                'prompt' => 'Selecione o ponto que Foi Entregue a Obra',
                            ],
                        ],
                        'anexoActaEntrega' => [
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
                        'only' => ['estadoObra',
                            'imagemInfra',
                            'dataConclusaoObra',
                            'pontoFoiEntregueObra',
                            'anexoActaEntrega',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Nºde beneficiários directos (e indirectos)',
                    'description' => 'Secção 4',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'benCorresponTotalPopulacao' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('benCorresponTotalPopulacao'),
                                'prompt' => 'Selecione se beneficiários Correspom ao Total da População',
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => [
                            'benHomem',
                            'benMulher',
                            'totalAFAbrangidos',
                            'benCorresponTotalPopulacao',
                            'totalSuino',
                            'totalCaprino',
                            'totalBovino',
                            'totalHaIrrigados',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Comissão de Gestão do Ponto de Água',
                    'description' => 'Secção 5',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'grupoGestAgua' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('grupoGestAgua'),
                                'prompt' => 'Selecione o grupoGestAgua',
                            ],
                        ],
                        'orientacoesMetodologia' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('orientacoesMetodologia'),
                                'prompt' => 'Selecione o orientacoesMetodologia',
                            ],
                        ],
                        'comissaoRealizaReuniosFreq' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('comissaoRealizaReuniosFreq'),
                                'prompt' => 'Selecione o comissaoRealizaReuniosFreq',
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['grupoGestAgua',
                            'orientacoesMetodologia',
                            'comissaoRealizaReuniosFreq',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Manutenção do Ponto de Água',
                    'description' => 'Secção 6',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'grupoFazContribuicoes' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('grupoFazContribuicoes'),
                                'prompt' => 'Selecione o grupoFazContribuicoes',
                            ],
                        ],
                        'grupoTemPlanoManutencaoPrev' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('grupoTemPlanoManutencaoPrev'),
                                'prompt' => 'Selecione o grupoTemPlanoManutencaoPrev',
                            ],
                        ],
                        'grupoTemPlanoManutencaoUrgen' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('grupoTemPlanoManutencaoUrgen'),
                                'prompt' => 'Selecione o grupoTemPlanoManutencaoUrgen',
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['grupoFazContribuicoes',
                            'grupoTemPlanoManutencaoPrev',
                            'grupoTemPlanoManutencaoUrgen',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Nº de Membros da Comissão de Gestão',
                    'description' => 'Secção 7',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'grupoFazParteACA' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('grupoFazParteACA'),
                                'prompt' => 'Selecione o grupoFazParteACA',
                            ],
                        ],
                        'grupoEstaAssociadoBMAS' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('grupoEstaAssociadoBMAS'),
                                'prompt' => 'Selecione o grupoEstaAssociadoBMAS',
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['comissaoHomem',
                            'comissaoMulher',
                            'grupoFazParteACA',
                            'grupoEstaAssociadoBMAS',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Acompanhamento',
                    'description' => 'Secção 8',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'existeAcompaMuniEneAgua' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('existeAcompaMuniEneAgua'),
                                'prompt' => 'Selecione o existeAcompaMuniEneAgua',
                            ],
                        ],
                        'nTecniParticipamReunioes' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('existeAcompaMuniEneAgua'),
                                'prompt' => 'Selecione o existeAcompaMuniEneAgua',
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['existeAcompaMuniEneAgua',
                            'nTecniAcompanham',
                            'nTecniParticipamReunioes',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Transferências Sociais',
                    'description' => 'Secção 9',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'metodologiaAdoptada' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => AguaController::getEnumValues('metodologiaAdoptada'),
                                'prompt' => 'Selecione o metodologiaAdoptada',
                            ],
                        ],
                        'valorDiarioBeneUnidadeID' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => $unidadeArray,
                                'prompt' => 'Selecione o valorDiarioBeneUnidadeID',
                            ]
                        ],
                        'anexoTermoPagamento' => [
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
                        'only' => ['metodologiaAdoptada',
                            'criteriosUtilizadoParaSeleBenef',
                            'benHomemTransSocial',
                            'benMulherTransSocial',
                            'totalAFCorrespondenteTransSocial',
                            'valorDiarioBene',
                            'valorDiarioBeneUnidadeID',
                            'nDiasTrabalho',
                            'totalEntregueTranBen',
                            'anexoTermoPagamento',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'ONG - Desafios e Lições Aprendidas',
                    'description' => 'Secção 10',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'desafiosONG' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'licoesAprendidadasONG' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['desafiosONG',
                            'licoesAprendidadasONG',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Missões de Monitoria UIC FRESAN/Camões, I.P.',
                    'description' => 'Secção 11',
                    'formInfoText' => 'Preencha todos os campos',
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
                            'recomendacoes',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $models,
                    'title' => 'Compromisso e Progresso',
                    'description' => 'Secção 12',
                    'formInfoText' => 'Preencha todos os campos',
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
                            'medidasMitigacaoEstado',],
                    ],
                ],
            ],
        ]);
$models->userID = Yii::$app->user->identity->id; // pega o id do usuario logado e armazena para guardar junto com o formulario
?>