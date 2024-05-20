<?php

use backend\controllers\GrupoController;
use backend\models\Classificacaodocumentoartigo;
use backend\models\Comuna;
use backend\models\Culturasprovidas;
use backend\models\Finalidade;
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
use yii\helpers\Html;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;

/** @var View $this */
/** @var Grupo $model */
/** @var ActiveForm $form */
// Recupere todos os registros da tabela provincia
$provincias = Provincia::find()->all();
$provinciaArray = [];
foreach ($provincias as $provincia) {
    $provinciaArray[$provincia->Id] = $provincia->nomeProvincia;
}

// Recupere todos os registros da tabela Municipio
$municipios = Municipio::find()->all();
$municipiosArray = [];
foreach ($municipios as $municipio) {
    $municipiosArray[$municipio->Id] = $municipio->nomeMunicipio;
}

// Recupere todos os registros da tabela Municipio
$comunas = Comuna::find()->all();
$comunasArray = [];
foreach ($comunas as $comuna) {
    $comunasArray[$comuna->Id] = $comuna->nomeComuna;
}

// Recupere todos os registros da tabela Municipio
$localidades = Localidade::find()->all();
$localidadesArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($localidades as $localidade) {
    $localidadesArray[$localidade->Id] = $localidade->nomeLocalidade;
}

// Recupere todos os registros da tabela Municipio
$classificacaoDoc = Classificacaodocumentoartigo::find()->all();
$classificacaoDocArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($classificacaoDoc as $classificacao) {
    $classificacaoDocArray[$classificacao->Id] = $classificacao->NomeClassficacao;
}

$finalidades = Finalidade::find()->all();
$finalidadesArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($finalidades as $finalidade) {
    $finalidadesArray[$finalidade->Id] = $finalidade->finalidade;
}

$unidades = Unidade::find()->all();
$unidadeArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($unidades as $unidade) {
    $unidadeArray[$unidade->Id] = $unidade->unidade;
}

$culturas = Culturasprovidas::find()->all();
$culturasArray = [];
// Percorra os resultados da consulta e crie o array manualmente
foreach ($culturas as $cultura) {
    $culturasArray[$cultura->Id] = $cultura->culturaPrevisao;
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
            //'classNext'=>'btn btn-info botao',
            //'transitionEffect'=>'slide',
            'steps' =>
            [
                [
                    'model' => $grupoModel,
                    'title' => 'Identificação da Actividade',
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
                                    'params' => [Html::getInputId($grupoModel, 'provinciaID')], // Use o ID do campo provinciaID
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
                                    'params' => [Html::getInputId($grupoModel, 'municipioID')], // Use o ID do campo municipioID
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
                                    'params' => [Html::getInputId($grupoModel, 'comunaID')], // Use o ID do campo municipioID
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
                        'actualizacaoID' => [
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
                        
                        'only' => ['primeiroReporte', 'actualizacaoID', 'provinciaID', 'municipioID', 'comunaID', 'localidadeID', 'latitude', 'longitude',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $grupoModel,
                    'title' => 'Caracterização do Apoio',
                    'description' => 'Secção 2',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'apoioAgricola' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('apoioAgricola'),
                                'prompt' => 'Selecione o Apoio Agrícola realizado',
                            ],
                        ],
                        'grupoExistia' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('grupoExistia'),
                                'prompt' => 'Grupo já existia?',
                            ],
                        ],
                        'metodologiaAgricola' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('metodologiaAgricola'),
                                'prompt' => 'Selecione a Metodologia Agrícola',
                            ],
                        ],
                        'outraMetodologiaAgricola' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('outraMetodologiaAgricola'),
                                'prompt' => 'Selecione Outra Metodologia Agricola caso exista',
                            ],
                        ],
                        'segueMetodologiaECA' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('segueMetodologiaECA'),
                                'prompt' => 'Segue Metodologia da ECA?',
                            ],
                        ],
                        'anoInicioApoio' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione o Ano de inicío do Apoio',
                                    'id' => 'my-anoInicioApoio',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'estagioFaseEncontra' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('estagioFaseEncontra'),
                                'prompt' => 'Selecione o Estágio / Fase em que se Encontra',
                            ],
                        ],
                        'validadaIDA' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('validadaIDA'),
                                'prompt' => 'Foi validada pelo IDA?',
                            ],
                        ],
                        'grupoEntregueEntPubl' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('grupoEntregueEntPubl'),
                                'prompt' => 'Grupo foi entregue a uma Entidade Pública?',
                            ],
                        ],
                        'dataGrupoEntregue' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Trimestre que o Grupo foi entregue',
                                    'id' => 'my-dataGrupoEntregue',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
   
                         'anexoAutoEntrega' => [
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
                       
                        'primeiraFinalidadeID' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => $finalidadesArray,
                                'prompt' => 'Selecione a 1º Finalidade',
                            ],
                        ],
                        'segundaFinalidadeID' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => $finalidadesArray,
                                'prompt' => 'Selecione a 2º Finalidade',
                            ],
                        ],
                        'terceiraFinalidadeID3' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => $finalidadesArray,
                                'prompt' => 'Selecione a 3º Finalidade',
                            ],
                        ],
                        'listaMembros' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('listaMembros'),
                                'prompt' => 'Tem Lista de membros?',
                            ],
                        ],
                        'only' => ['apoioAgricola',
                            'nomeGrupo',
                            'grupoExistia',
                            'metodologiaAgricola',
                            'outraMetodologiaAgricola',
                            'segueMetodologiaECA',
                            'anoInicioApoio',
                            'primeiroAnoAgriColheita',
                            'ultimoAnoAgriColheita',
                            'estagioFaseEncontra',
                            'validadaIDA',
                            'grupoEntregueEntPubl',
                            'dataGrupoEntregue',
                            'anexoAutoEntrega',
                            'primeiraFinalidadeID',
                            'segundaFinalidadeID',
                            'terceiraFinalidadeID3',
                            'beneficiariosHomem',
                            'beneficiariosMulher',
                            'listaMembros',
                            'representaQtsAF',
                            'bovinos',
                            'caprinos',
                            'ovinos',
                        ], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $grupoModel,
                    'title' => 'Boas Práticas e Elementos Recomendados (Sustentabilidade)',
                    'description' => 'Secção 3', 'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'temComissaoGestao' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('temComissaoGestao'),
                                'prompt' => 'Selecione a temComissaoGestao',
                            ],
                        ],
                        'temReguInterno' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('temReguInterno'),
                                'prompt' => 'Selecione a temReguInterno',
                            ],
                        ],
                        'temFacilitador' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('temFacilitador'),
                                'prompt' => 'Selecione a temFacilitador',
                            ],
                        ],
                        'temParcelasAprendizagem' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('temParcelasAprendizagem'),
                                'prompt' => 'Selecione a temParcelasAprendizagem',
                            ],
                        ],
                        'temCerco' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('temCerco'),
                                'prompt' => 'Selecione a temCerco',
                            ],
                        ],
                        'temPlacaIdentificacao' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('temPlacaIdentificacao'),
                                'prompt' => 'Selecione a temPlacaIdentificacao',
                            ],
                        ],
                        'temCadernoRegisto' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('temCadernoRegisto'),
                                'prompt' => 'Selecione a temCadernoRegisto',
                            ],
                        ],
                        'contribuicaoFundoManeio' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('contribuicaoFundoManeio'),
                                'prompt' => 'Selecione a Membros fazem contribuicaoFundoManeio',
                            ],
                        ],
                        'frequenciaContribuicoes' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('frequenciaContribuicoes'),
                                'prompt' => 'Selecione a frequenciaContribuicoes',
                            ],
                        ],
                        'fundoManeioSaldoPositivo' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('fundoManeioSaldoPositivo'),
                                'prompt' => 'Selecione a fundoManeioSaldoPositivo',
                            ],
                        ],
                        'temPlanoActividade' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('temPlanoActividade'),
                                'prompt' => 'Selecione a temPlanoActividade',
                            ],
                        ],
                        'frequenciaSessoes' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('frequenciaSessoes'),
                                'prompt' => 'Selecione a frequenciaSessoes',
                            ],
                        ],
                        'localReunioes' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('localReunioes'),
                                'prompt' => 'Selecione a localReunioes',
                            ],
                        ],
                        'implementaASAE' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('implementaASAE'),
                                'prompt' => 'Selecione a implementaASAE',
                            ],
                        ],
                        'produzBioInsecticida' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('produzBioInsecticida'),
                                'prompt' => 'Selecione a produzBioInsecticida',
                            ],
                        ],
                        'usaBioFertilizante' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('usaBioFertilizante'),
                                'prompt' => 'Selecione a usaBioFertilizante',
                            ],
                        ],
                        'integraSistemaAgrosilvopastoril' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('integraSistemaAgrosilvopastoril'),
                                'prompt' => 'Selecione a integraSistemaAgrosilvopastoril',
                            ],
                        ],
                        'metodologiaJangosPastoris' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('metodologiaJangosPastoris'),
                                'prompt' => 'Selecione a metodologiaJangosPastoris',
                            ],
                        ],
                        'assistTecnApoioProducao' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('assistTecnApoioProducao'),
                                'prompt' => 'Selecione a assistTecnApoioProducao',
                            ],
                        ],
                        'placaVisibilidade' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('placaVisibilidade'),
                                'prompt' => 'Selecione a placaVisibilidade',
                            ],
                        ],
                        'autoridadeTradEnvolvida' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('autoridadeTradEnvolvida'),
                                'prompt' => 'Selecione a autoridadeTradEnvolvida',
                            ],
                        ],
                        'administracaoEnvolvida' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('autoridadeTradEnvolvida'),
                                'prompt' => 'Selecione a autoridadeTradEnvolvida',
                            ],
                        ],
                        'isvEnvolvida' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('isvEnvolvida'),
                                'prompt' => 'Selecione a isvEnvolvida',
                            ],
                        ],
                        'idfEnvolvida' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('idfEnvolvida'),
                                'prompt' => 'Selecione a idfEnvolvida',
                            ],
                        ],
                        'idaEdaEnvolvida' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('idaEdaEnvolvida'),
                                'prompt' => 'Selecione a idaEdaEnvolvida',
                            ],
                        ],
                        'iiaEnvolvida' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('iiaEnvolvida'),
                                'prompt' => 'Selecione a iiaEnvolvida',
                            ],
                        ],
                        'iivEnvolvida' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('iivEnvolvida'),
                                'prompt' => 'Selecione a iivEnvolvida',
                            ],
                        ],
                        'primeiraPraticaInovadora' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('primeiraPraticaInovadora'),
                                'prompt' => 'Selecione a primeiraPraticaInovadora',
                            ],
                        ],
                        'segundaPraticaInovadora' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('segundaPraticaInovadora'),
                                'prompt' => 'Selecione a segundaPraticaInovadora',
                            ],
                        ],
                        'terceiraPraticaInovadora' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('terceiraPraticaInovadora'),
                                'prompt' => 'Selecione a terceiraPraticaInovadora',
                            ],
                        ],
                        'replicaPraticaInovadora' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('replicaPraticaInovadora'),
                                'prompt' => 'Selecione a replicaPraticaInovadora',
                            ],
                        ],
                        'nSessoeTeoPratTrimes' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione nSessoeTeoPratTrimes',
                                    'id' => 'my-nSessoeTeoPratTrimes',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
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
                        'only' => ['temComissaoGestao',
                            'temReguInterno',
                            'temFacilitador',
                            'temParcelasAprendizagem',
                            'temCerco',
                            'temPlacaIdentificacao',
                            'temCadernoRegisto',
                            'contribuicaoFundoManeio',
                            'frequenciaContribuicoes',
                            'membrosContribuemRegular',
                            'fundoManeioSaldoPositivo',
                            'temPlanoActividade',
                            'frequenciaSessoes',
                            'localReunioes',
                            'implementaASAE',
                            'produzBioInsecticida',
                            'usaBioFertilizante',
                            'integraSistemaAgrosilvopastoril',
                            'numEvenTrocExperCamponeses',
                            'metodologiaJangosPastoris',
                            'assistTecnApoioProducao',
                            'placaVisibilidade',
                            'autoridadeTradEnvolvida',
                            'administracaoEnvolvida',
                            'isvEnvolvida',
                            'idfEnvolvida',
                            'idaEdaEnvolvida',
                            'iiaEnvolvida',
                            'iivEnvolvida',
                            'outroEnvolvida',
                            'primeiraPraticaInovadora',
                            'segundaPraticaInovadora',
                            'terceiraPraticaInovadora',
                            'replicaPraticaInovadora',
                            'nLavrasPartiReplicaPraticaInovadora',
                            'principalConstrangimento',
                            'temas',
                            'tema1Ciclo',
                            'tema2Ciclo',
                            'tema3Ciclo',
                            'outroTema',
                            'nSessoeTeoPrat',
                            'nSessoeTeoPratTrimes',
                            'diaSessaoEca',
                            'percentParticipacao',
                            'areaTotalCampoAgro',
                            'areaCultivadaCampoAgro',
                            'areaInsPlantInovadorasCampoAgro',
                        ], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $grupoModel,
                    'title' => 'Irrigação',
                    'description' => 'Secção 4',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'pontoAguaDispoIrri' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('pontoAguaDispoIrri'),
                                'prompt' => 'Selecione  pontoAguaDispoIrri',
                            ],
                        ],
                        'previstConstrSistIrrig' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('previstConstrSistIrrig'),
                                'prompt' => 'Selecione  previstConstrSistIrrig',
                            ],
                        ],
                        'sistemaIrriUtilizad' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('sistemaIrriUtilizad'),
                                'prompt' => 'Selecione  sistemaIrriUtilizad',
                            ],
                        ],
                        'classificacacaoCampo' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('classificacacaoCampo'),
                                'prompt' => 'Selecione  classificacacaoCampo',
                            ],
                        ],
                        'houveExcedente' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('houveExcedente'),
                                'prompt' => 'Selecione  houveExcedente',
                            ],
                        ],
                        'culturasHouveExcedente' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'trimestreExcedente' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre de trimestreExcedente',
                                    'id' => 'my-dataVisitaFresan',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'destinoExcedente' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('destinoExcedente'),
                                'prompt' => 'Selecione  destinoExcedente',
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['pontoAguaDispoIrri',
                            'previstConstrSistIrrig',
                            'sistemaIrriUtilizad',
                            'areaIrrigada',
                            'classificacacaoCampo',
                            'houveExcedente',
                            'culturasHouveExcedente',
                            'qtdExcedente',
                            'trimestreExcedente',
                            'destinoExcedente',
                        ], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $insumoGrupo,
                    'type' => FormWizard::STEP_TYPE_TABULAR,
                    'title' => 'Culturas Promovidas e Recomendadas',
                    'description' => 'Secção 5',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'culturasID' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => $culturasArray,
                                'prompt' => 'Selecione a Cultura',
                            ],
                        ],
                        'trimestreCulturaDistr' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre ',
                                    'id' => 'my-trimestreCulturaDistr',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'trimestreCultColheita' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre ',
                                    'id' => 'my-trimestreCultColheita',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'destinoCultColheita' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumInsumoValues('destinoCultColheita'),
                                'prompt' => 'Selecione a Entidade destinoCultColheita',
                            ],
                        ],
                        'culturaBiofortificada' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumInsumoValues('culturaBiofortificada'),
                                'prompt' => 'Selecione a Entidade culturaBiofortificada',
                            ],
                        ],
                        'unidadeID' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => ArrayHelper::map(Unidade::find()->all(), 'Id', 'unidade'),
                                'prompt' => 'Selecione a unidade',
                            ]
                        ],
                        'only' => ['culturasID', 'campanhaPrevisaoAbobora', 'cultDistr', 'trimestreCulturaDistr', 'culturaColheita', 'trimestreCultColheita', 'destinoCultColheita', 'culturaBiofortificada', 'unidadeID', 'quantasVingaram'], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $fitofarmacosferramentas,
                    'type' => FormWizard::STEP_TYPE_TABULAR,
                    'title' => 'Fitofármacos, Fertilizantes, Correctivos e Inoculantes e Ferramentas, Equipamentos e Materiais ',
                    'description' => 'Secção 6',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'culturasID' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => $culturasArray,
                                'prompt' => 'Selecione a unidade',
                            ]
                        ],
                        'previsaoCampanha' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre ',
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
                        'only' => [
                            'nome',
                            'previsaoCampanha',
                            //  'previsaoCampanhaTrimestre',
                            'distribuido',
                            'unidadeID',
                        ], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $grupoModel,
                    'title' => 'Redes de Comercialização',
                    'description' => 'Secção 7',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'facilitaLigacoesEntreProdutores' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('facilitaLigacoesEntreProdutores'),
                                'prompt' => 'Selecione a facilitaLigacoesEntreProdutores',
                            ],
                        ],
                        'realizaEventosSobreProdutos' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('realizaEventosSobreProdutos'),
                                'prompt' => 'Selecione a realizaEventosSobreProdutos',
                            ],
                        ],
                        'apoioDistrProdCamponeses' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('apoioDistrProdCamponeses'),
                                'prompt' => 'Selecione a apoioDistrProdCamponeses',
                            ],
                        ],
                        'descricaoRede' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['facilitaLigacoesEntreProdutores', 'realizaEventosSobreProdutos', 'apoioDistrProdCamponeses', 'nRedes', 'dataApoios', 'tipoEvento', 'descricaoRede', 'coberturaGeograficaRede', 'comerciantesEnvolvidos', 'finalidadeRede', 'frequenciaRede', 'resultadoInicRede', 'desafios', 'licoesAprendidas',], // all fields except these will be added in the step
                    ]
                ],
                [
                    'model' => $grupoModel,
                    'title' => 'Banco de Sementes',
                    'description' => 'Secção 8',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'temBancoSementes' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('temBancoSementes'),
                                'prompt' => 'Selecione a temBancoSementes',
                            ],
                        ],
                        'fazMultiSementes' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('fazMultiSementes'),
                                'prompt' => 'Selecione a v',
                            ],
                        ],
                        'trimSementesBanco' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre trimSementesBanco',
                                    'id' => 'my-trimSementesBanco',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'trimestreSementesEntrCamponeses' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre trimestreSementesEntrCamponeses',
                                    'id' => 'my-trimestreSementesEntrCamponeses',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'trimestreSementesReembPelosCamponeses' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre trimestreSementesReembPelosCamponeses',
                                    'id' => 'my-trimestreSementesReembPelosCamponeses',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'trimestreSementesDisponiveisBanco' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre trimestreSementesDisponiveisBanco',
                                    'id' => 'my-trimestreSementesDisponiveisBanco',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'estadoBancoSementes' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('estadoBancoSementes'),
                                'prompt' => 'Selecione a estadoBancoSementes',
                            ],
                        ],
                        'temRegistoBancSementes' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('temRegistoBancSementes'),
                                'prompt' => 'Selecione a temRegistoBancSementes',
                            ],
                        ],
                        'resultadIniciBancoSem' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('resultadIniciBancoSem'),
                                'prompt' => 'Selecione a resultadIniciBancoSem',
                            ],
                        ],
                        'desafiosBancoSem' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'licoesAprendiBancSem' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['temBancoSementes',
                            'fazMultiSementes',
                            'culturasDispoBancSementes',
                            'qtdSementesEntrBancoKG',
                            'trimSementesBanco',
                            'totalSementesEntrCamponeses',
                            'trimestreSementesEntrCamponeses',
                            'totalSementesReembPelosCamponeses',
                            'trimestreSementesReembPelosCamponeses',
                            'qtdSementesDisponiveisBanco',
                            'trimestreSementesDisponiveisBanco',
                            'estadoBancoSementes',
                            'temRegistoBancSementes',
                            'camponesesRecebemSementesBanc',
                            'camponesesReebolsaSementesBanc',
                            'resultadIniciBancoSem',
                            'desafiosBancoSem',
                            'licoesAprendiBancSem',], // all fields except these will be added in the step
                    ],
                ],
                [
                    'model' => $grupoModel,
                    'title' => 'Cooperativas e Associações',
                    'description' => 'Secção 9',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'classifCooper' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('classifCooper'),
                                'prompt' => 'Selecione a classifCooper',
                            ],
                        ],
                        'membrCampoAgrFormal' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('membrCampoAgrFormal'),
                                'prompt' => 'Selecione a membrCampoAgrFormal',
                            ],
                        ],
                        'coopExistia' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('coopExistia'),
                                'prompt' => 'Selecione a coopExistia',
                            ],
                        ],
                        'coopLegalizada' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('coopLegalizada'),
                                'prompt' => 'Selecione a coopLegalizada',
                            ],
                        ],
                        'coopLegalFresan' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('coopLegalFresan'),
                                'prompt' => 'Selecione a coopLegalFresan',
                            ],
                        ],
                        'tipoApoioDadoProjec' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('tipoApoioDadoProjec'),
                                'prompt' => 'Selecione a tipoApoioDadoProjec',
                            ],
                        ],
                        'realizaFormacao' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('realizaFormacao'),
                                'prompt' => 'Selecione a realizaFormacao',
                            ],
                        ],
                        'orgaosSociaisDefinidos' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('orgaosSociaisDefinidos'),
                                'prompt' => 'Selecione a orgaosSociaisDefinidos',
                            ],
                        ],
                        'trimesSessoesFormacoes' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre trimesSessoesFormacoes',
                                    'id' => 'my-trimesSessoesFormacoes',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'nReunioesOrgSocTrimestre' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre nReunioesOrgSocTrimestre',
                                    'id' => 'my-nReunioesOrgSocTrimestre',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'membrosFazemContrReg' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('membrosFazemContrReg'),
                                'prompt' => 'Selecione a membrosFazemContrReg',
                            ],
                        ],
                        'coopTemFundoManeioPositivo' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('coopTemFundoManeioPositivo'),
                                'prompt' => 'Selecione a coopTemFundoManeioPositivo',
                            ],
                        ],
                        'propositoApoiarTransformacao' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('propositoApoiarTransformacao'),
                                'prompt' => 'Selecione a propositoApoiarTransformacao',
                            ],
                        ],
                        'realizaTransforDescriProduto' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'propositoApoiarArmazen' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('propositoApoiarArmazen'),
                                'prompt' => 'Selecione a propositoApoiarArmazen',
                            ],
                        ],
                        'propositoApoiarFactorProd' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('propositoApoiarFactorProd'),
                                'prompt' => 'Selecione a propositoApoiarFactorProd',
                            ],
                        ],
                        'propositoApoiarComercializacao' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('propositoApoiarComercializacao'),
                                'prompt' => 'Selecione a propositoApoiarComercializacao',
                            ],
                        ],
                        'propositoApoiarMembroCaixaCom' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('propositoApoiarMembroCaixaCom'),
                                'prompt' => 'Selecione a propositoApoiarMembroCaixaCom',
                            ],
                        ],
                        'desafiosCooperativas' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'licoesAprendidasCooperativas' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['classifCooper',
                            'membrCampoAgrFormal', 'homemCoop', 'mulherCoop', 'coopExistia',
                            'coopLegalizada',
                            'coopLegalFresan',
                            'tipoApoioDadoProjec',
                            'realizaFormacao',
                            'temaSessoesFormacao',
                            'nSessoesFormacoes',
                            'trimesSessoesFormacoes',
                            'orgaosSociaisDefinidos',
                            'nReunioesOrgSoc',
                            'nReunioesOrgSocTrimestre',
                            'membrosFazemContrReg',
                            'coopTemFundoManeioPositivo',
                            'propositoApoiarTransformacao',
                            'realizaTransforDescriProduto',
                            'propositoApoiarArmazen',
                            'propositoApoiarFactorProd',
                            'propositoApoiarComercializacao',
                            'propositoApoiarMembroCaixaCom',
                            'desafiosCooperativas',
                            'licoesAprendidasCooperativas',], // all fields except these will be added in the step
                    ]
                ],
                [
                    'model' => $grupoModel,
                    'title' => 'Projectos Piloto',
                    'description' => 'Secção 10',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'tecnologiaProjectoPioto' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('tecnologiaProjectoPioto'),
                                'prompt' => 'Selecione a tecnologiaProjectoPioto',
                            ],
                        ],
                        'pontoSituacaoProjecto' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('pontoSituacaoProjecto'),
                                'prompt' => 'Selecione a pontoSituacaoProjecto',
                            ],
                        ],
                        'resultadoInicPiloto' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('resultadoInicPiloto'),
                                'prompt' => 'Selecione a resultadoInicPiloto',
                            ],
                        ],
                        'desafiosPiloto' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'licoesAprendidasPiloto' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['tecnologiaProjectoPioto',
                            'nCamponesesHomens',
                            'nCamponesesMulheres',
                            'kitClassificacao',
                            'kitDistribuidoDescric',
                            'nKitEntregue',
                            'pontoSituacaoProjecto',
                            'comercializacao',
                            'qtdProdComercializadoKG',
                            'resultadoInicPiloto',
                            'desafiosPiloto',
                            'licoesAprendidasPiloto',], // all fields except these will be added in the step
                    ]
                ],
                [
                    'model' => $grupoModel,
                    'title' => 'Educação Alimentar e Nutricional (EAN)',
                    'description' => 'Secção 11',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'realizadaSinsibilizacoesEAN' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('realizadaSinsibilizacoesEAN'),
                                'prompt' => 'Selecione a realizadaSinsibilizacoesEAN',
                            ],
                        ],
                        'realizadasSensibilizacoesCulinarias' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('realizadasSensibilizacoesCulinarias'),
                                'prompt' => 'Selecione a realizadasSensibilizacoesCulinarias',
                            ],
                        ],
                        'realizadoRastreios' => [
                            'containerOptions' => [
                                'class' => 'form-group'
                            ],
                            'options' => [
                                'type' => 'dropdown',
                                'itemsList' => GrupoController::getEnumValues('realizadoRastreios'),
                                'prompt' => 'Selecione a realizadoRastreios',
                            ],
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['realizadaSinsibilizacoesEAN',
                            'realizadasSensibilizacoesCulinarias',
                            'realizadoRastreios',], // all fields except these will be added in the step
                    ]
                ],
                [
                    'model' => $grupoModel,
                    'title' => 'ONG - Desafios e Lições Aprendidas',
                    'description' => 'Secção 12',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'desafiosAprendidasONG' => [
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
                        'only' => ['desafiosAprendidasONG',
                            'licoesAprendidasONG',], // all fields except these will be added in the step
                    ]
                ],
                [
                    'model' => $grupoModel,
                    'title' => 'Missões de Monitoria UIC FRESAN/Camões, I.P.',
                    'description' => 'Secção 13',
                    'formInfoText' => 'Preencha todos os campos',
                    'fieldConfig' => [
                        'dataVisitaUIC' => [
                            'widget' => DatePicker::class,
                            'options' => [
                                'options' => [
                                    'placeholder' => 'Selecione O trimestre de participantes na formacao',
                                    'id' => 'my-dataVisitaUIC',
                                    'class' => 'form-control',
                                ],
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd', // Formato desejado: ano-mês-dia
                                // Outras opções do plugin, se necessário
                                ],
                            ],
                        ],
                        'constatacoesFeitasUIC' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'recomendacoesFeitasUIC' => [
                            'options' => [
                                'type' => 'textarea',
                                'class' => 'form-control',
                                'cols' => 25,
                                'rows' => 10
                            ]
                        ],
                        'template' => "{label}\n{input}\n{error}\n{hint}",
                        'only' => ['dataVisitaUIC',
                            'tecnicoResponsavelUIC',
                            'constatacoesFeitasUIC',
                            'recomendacoesFeitasUIC',], // all fields except these will be added in the step
                    ]
                ],
                [
                    'model' => $grupoModel,
                    'title' => 'Compromisso e Progresso',
                    'description' => 'Secção 14',
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
                            'medidasMitigacaoEstado'],
                    ],
                ],
            ],
        ]);
$grupoModel->userID = Yii::$app->user->identity->id; // pega o id do usuario logado e armazena para guardar junto com o formulario
//if ($insumoGrupo instanceof Grupo && !is_null($insumoGrupo->grupoID)) {
//    $insumoGrupo->grupoID = $grupoModel->Id;
//}
//
//if ($fitofarmacosferramentas instanceof Grupo && !is_null($fitofarmacosferramentas->grupoID)) {
//    $fitofarmacosferramentas->grupoID = $grupoModel->Id;
//}

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


