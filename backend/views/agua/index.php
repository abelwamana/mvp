
<link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    /* Altere a cor de fundo do tipo 'info' do painel para a cor desejada */
    .card-header  {
        background-color: #919733; /* Substitua pelo código de cor desejado */
        color: #ffffff; /* Cor do texto para legibilidade */
    }
    .btn.btn-primary.botao {
        background-color: #919733; /* Cor de fundo do botão primário Bootstrap */
        color: #fff; /* Cor do texto para legibilidade */
        /* Outros estilos conforme necessário */
    }

</style>
<?php

use backend\models\AguaSearch;
use kartik\alert\Alert;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use kartik\file\FileInput;
USE yii\helpers\ArrayHelper;
use backend\models\Provincia;
use backend\models\Municipio;
use backend\models\Comuna;
use backend\controllers\AguaController;
use backend\models\Agua;

/** @var View $this */
/** @var AguaSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */
/** @var Created by: Agostinho Francisco Paixão do Rosário */
/** @varE - mail  : rosarioabderval@gmail.com */
/** @var Tel: +244 930 744 338 */
/** @var Esta afirmação é fiel e digna de toda aceitação: Cristo Jesus veio ao mundo para salvar os pecadores, dos quais eu sou o pior. */
/** @var 1 Timóteo 1:15 */
//$this->title = Yii::t('app', 'Agua');
$this->params['breadcrumbs'][] = 'Água'; //$this->title;
?>
<div class="agua-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);   ?>
    <?php
// Verifica se há mensagens flash de erro
    if (Yii::$app->session->hasFlash('error')) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-danger', // Classe CSS para estilo de erro
            ],
            'body' => Yii::$app->session->getFlash('error'), // Exibe a mensagem flash de erro
        ]);
    }
    if (Yii::$app->session->hasFlash('success')) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-success', // Classe CSS para estilo de erro
            ],
            'body' => Yii::$app->session->getFlash('success'), // Exibe a mensagem flash de erro
        ]);
    }
    ?>
    <?php
    $gridColumns = [
        [
            'class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function ($model, $key, $index, $column) {
                return ['value' => $model->Id];
            },
        ],
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'header' => '#',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        [
            'attribute' => 'Id',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'primeiroReporte',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'actualizacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'respondente',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'entidade',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'provinciaID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
            'value' => 'provincia.nomeProvincia', // Access the related nomeProvincia attribute
            'filter' => ArrayHelper::map(Provincia::find()->all(), 'Id', 'nomeProvincia'),
        ],
        [
            'attribute' => 'municipioID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
            'value' => 'municipio.nomeMunicipio', // Access the related nomeProvincia attribute
            'filter' => ArrayHelper::map(Municipio::find()->all(), 'Id', 'nomeMunicipio'),
        ],
        [
            'attribute' => 'comunaID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
            'value' => 'comuna.nomeComuna', // Access the related nomeProvincia attribute
            'filter' => ArrayHelper::map(Comuna::find()->all(), 'Id', 'nomeComuna'),
        ],
        [
            'attribute' => 'localidadeID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true, 'value' => 'localidade.nomeLocalidade', // Access the related nomeProvincia attribute
            'filter' => ArrayHelper::map(\backend\models\Localidade::find()->all(), 'Id', 'nomeLocalidade'),
        ],
        [
            'attribute' => 'latitude',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'longitude',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'infraEstrutura',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'fonteHidraulica',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'fonteHidraulicaAlternativa',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'servicoAssociado',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'novaConstrucao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'fimAQueSeDestina',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'capacidadeInfraestrutura',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'capacidadeUnidadeID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
            'value' => function ($model) {
                return $model->unidade ? $model->unidade->unidade : 'N/A';
                //return $model->grupo->nomeGrupo ? $model->grupo->nomeGrupo : 'N/A';;
            },
        ],
        [
            'attribute' => 'realizadoTesteQualidadeAgua',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'entidadeResponsavelConstrucao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'anosGarantia',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'sistemExtracaoAgua',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'especificacoesTecnInfraExtru:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temPlacaVisibilidade',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'infraAssociadaCampo',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nomeCampoAssociadoGrupoID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'anexoFichaTecnInfraExtr',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw', // Define o formato como HTML
            'value' => function ($model) {
                if ($model->getAnexofichaInfra()) {

                    return Html::a('Abrir', $model->getAnexofichaInfra(), ['target' => '_blank']);
                } else {
                    return 'Nenhum anexo disponível';
                }
            },
        ],
        [
            'attribute' => 'estadoObra',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'imagemInfra',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw', // Define o formato como HTML
            'value' => function ($model) {
                if ($model->getAnexImagemInfra()) {

                    return Html::a('Abrir', $model->getAnexImagemInfra(), ['target' => '_blank']);
                } else {
                    return 'Nenhum anexo disponível';
                }
            },
        ],
        [
            'attribute' => 'dataConclusaoObra',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'pontoFoiEntregueObra',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'anexoActaEntrega',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw', // Define o formato como HTML
            'value' => function ($model) {
                if ($model->getAnexoActa()) {

                    return Html::a('Abrir', $model->getAnexoActa(), ['target' => '_blank']);
                } else {
                    return 'Nenhum anexo disponível';
                }
            },
        ],
        [
            'attribute' => 'benHomem',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'benMulher',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'totalAFAbrangidos',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'benCorresponTotalPopulacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'totalSuino',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'totalCaprino',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'totalBovino',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'totalHaIrrigados',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'grupoGestAgua',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'orientacoesMetodologia',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'comissaoRealizaReuniosFreq',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'grupoFazContribuicoes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'grupoTemPlanoManutencaoPrev',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'grupoTemPlanoManutencaoUrgen',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'comissaoHomem',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'comissaoMulher',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'grupoFazParteACA',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'grupoEstaAssociadoBMAS',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'existeAcompaMuniEneAgua',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nTecniAcompanham',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nTecniParticipamReunioes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'metodologiaAdoptada',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'criteriosUtilizadoParaSeleBenef:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'benHomemTransSocial',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'benMulherTransSocial',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'totalAFCorrespondenteTransSocial',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'valorDiarioBene',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'valorDiarioBeneUnidadeID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
            'value' => function ($model) {
                return $model->unidade ? $model->unidade->unidade : 'N/A';
                //return $model->grupo->nomeGrupo ? $model->grupo->nomeGrupo : 'N/A';;
            },
        ],
        [
            'attribute' => 'nDiasTrabalho',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'totalEntregueTranBen',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'anexoTermoPagamento',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw', // Define o formato como HTML
            'value' => function ($model) {
                if ($model->getTermoPag()) {

                    return Html::a('Abrir', $model->getTermoPag(), ['target' => '_blank']);
                } else {
                    return 'Nenhum anexo disponível';
                }
            },
        ],
        [
            'attribute' => 'desafiosONG',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'licoesAprendidadasONG',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'dataVisitaFresan',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'tecnicoResponsavelFresan',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'constantacoeFeitasFresan',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'recomendacoes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'medidasMitigacaoONG',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'medidasMitigacaoEstado',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'userID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
            'value' => function ($model) {
                return $model->user ? $model->user->username : 'N/A';
                //return $model->grupo->nomeGrupo ? $model->grupo->nomeGrupo : 'N/A';;
            },
        ],
        [
            'attribute' => 'estadoValidacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
        // 'format' => 'raw', // Define o formato como HTML
        //'filterType' => GridView::,
        // 'filter' => $model->getEstadoreforcoinstitucional(),
//            'filterInputOptions' => [
//                'id' => 'status',
//            ],
//            'filterWidgetOptions' => [
//                //'theme' => Select2::THEME_BOOTSTRAP,
//                'pluginOptions' => ['allowClear' => true,],
//                'options' => ['placeholder' => Yii::t('app', 'Select...')
//                ],
//            ],
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    return ['view', 'Id' => $model->Id];
                }
                if ($action === 'update') {
                    return ['update', 'Id' => $model->Id];
                }
                if ($action === 'delete') {
                    return ['delete', 'Id' => $model->Id];
                }
            },
        ],
        //gerar os 3 botoes em funcao da permissao do usuario, se for Admin gera todos os botoes
        [
            'label' => 'Ações',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw',
            'value' => function ($model) {
                $acoes = $model->getAcoesBotoes();
                $buttons = '';
                foreach ($acoes as $acao) {
                    $buttons .= Html::a($acao['label'], $acao['url'], [
                                'class' => $acao['class'],
                                'onclick' => 'showSuccessAlert();', // Chama a função para exibir o alerta
                            ]) . ' ';
                }
                return $buttons;
            },
        ]
            ]
    ;
    ?>





    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'],
        'floatPageSummary' => true,
        'pjax' => true,
        'responsive' => true,
        'bordered' => true,
        'condensed' => true,
        'hover' => true,
        //'showPageSummary' => true,
        'hover' => true,
        // set export properties
        // set your toolbar
        'toolbar' => [
            [
                'content' =>
                Html::a('<i class="fas fa-plus"></i>', ['create'], [
                    'class' => 'btn btn-primary botao',
                    'title' => 'Adicionar agua',
                ]) . ' ' .
                Html::a('<i class="fas fa-redo"></i>', ['index'], [
                    'class' => 'btn btn-outline-secondary',
                    'title' => 'Reiniciar a Tabela',
                    'data-pjax' => 0,
                ]),
                'options' => ['class' => 'btn-group mr-2 me-2']
            ],
            '{export}',
            '{toggleData}',
        ],
        'exportConfig' => [
            // 'html' => [],
            'csv' => [],
            // 'txt' => [],
            'xls' => [],
        // 'pdf' => [],
        //  'json' => [],
        ],
      'panel' => [
    'heading' => Yii::t('app', 'Água'),
    'type' => '',
    'before' => '<div class="btn-group">' .
        (Yii::$app->user->can("Permissao Validador de dados") || Yii::$app->user->can("Permissão de Administrador") ? 
        Html::beginForm(['validar-selecionados'], 'post', ['class' => 'form-inline']) .
        Html::submitButton('Validar Selecionados', ['class' => 'btn btn-success']) .
        Html::endForm() : '') .
        (Yii::$app->user->can("Perfil Aprovação de dados") || Yii::$app->user->can("Permissão de Administrador") ? 
        Html::beginForm(['aprovar-selecionados'], 'post', ['class' => 'form-inline']) .
        Html::submitButton('Aprovar Selecionados', ['class' => 'btn btn-primary']) .
        Html::endForm() : '') .
        (Yii::$app->user->can("Perfil Lancamento")|| Yii::$app->user->can("Permissão de Administrador") ? 
        Html::beginForm(['publicar-selecionados'], 'post', ['class' => 'form-inline']) .
        Html::submitButton('Publicar Selecionados', ['class' => 'btn btn-info']) .
        Html::endForm() : '') .
        '</div>',
    'footer' => true
],


        'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
        'persistResize' => true,
        'toggleDataOptions' => ['minCount' => 10],
        'itemLabelSingle' => 'Item',
        'itemLabelPlural' => 'Items',
    ]);
    ?>




</div>
