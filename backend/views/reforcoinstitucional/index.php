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

//use yii\grid\GridView; 


use backend\models\Reforcoinstitucional;
use backend\models\ReforcoinstitucionalSearch;
use kartik\grid\GridView;
use kartik\select2\Select2;
//use yii\bootstrap5\Alert;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use hail812\adminlte\widgets\Alert;

/** @var View $this */
/** @var ReforcoinstitucionalSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */
$this->title = Yii::t('app', 'Reforcoinstitucional');
$this->params['breadcrumbs'][] = $this->title;

$model = new Reforcoinstitucional;
?>
<div class="reforcoinstitucional-index">

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
            'hidden' => false,
        ],
        [
            'attribute' => 'respondente',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
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
        ],
        [
            'attribute' => 'municipioID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
            'value' => 'municipio.nomeMunicipio', // Access the related nomeProvincia attribute
        ],
        [
            'attribute' => 'comunaID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
            'value' => 'comuna.nomeComuna', // Access the related nomeProvincia attribute
        ],
        [
            'attribute' => 'localidadeID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
            'value' => 'localidade.nomeLocalidade', // Access the related nomeProvincia attribute
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
            'attribute' => 'entidadeApoiada',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'apoioCapacitacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temaAbordadoSessoes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nSessoesPublicoAlvo',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nSessoesPubliTrimestre',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nHorasSessoes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'participantesFormacaoHomem',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'participantesFormacaoMulher',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'participantesFormacaoTrimestre',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'anexoProgramaFormacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw', // Define o formato como HTML
            'value' => function ($model) {
                if ($model->getAnexoProgrForm()) {

                    return Html::a('Abrir', $model->getAnexoProgrForm(), ['target' => '_blank']);
                } else {
                    return 'Nenhum anexo disponível';
                }
            },
        ],
        [
            'attribute' => 'descricaoEquipamentos',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'qtdEquipEntregues',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'anexoTermoEntreEquipamento',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw', // Define o formato como HTML
            'value' => function ($model) {
                if ($model->getAnexoTermEntre()) {

                    return Html::a('Abrir', $model->getAnexoTermEntre(), ['target' => '_blank']);
                } else {
                    return 'Nenhum anexo disponível';
                }
            },
        ],
        [
            'attribute' => 'nAnimaisVacinadosCampanha',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'meiosEntreguEntiCampanhaVacinacaoDesc',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nmeiosDistriEntiCampanhaVacinacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'anexoTermoEntrMeiosCampanhaVacinacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw', // Define o formato como HTML
            'value' => function ($model) {
                if ($model->getAnexoTermEntreMeiosV()) {

                    return Html::a('Abrir', $model->getAnexoTermEntreMeiosV(), ['target' => '_blank']);
                } else {
                    return 'Nenhum anexo disponível';
                }
            },
        ],
        [
            'attribute' => 'trataGadoForamMapeadosHomem',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'trataGadoForamMapeadosMulher',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'trataGadoForamMapeadosTrim',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temaAbordadoFormaGado',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nSessoesRealiFormGado',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nSessoesRealiFormGadoTrimestre',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nTotalHorasFormacaoGado',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'participantesFormacaoGadoHomem',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'participantesFormacaoGadoMulher',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'participantesFormacaoGadoTrimestre',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'totalCabecaGado',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'anexoProgramaFormaGado',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw', // Define o formato como HTML
            'value' => function ($model) {
                if ($model->getAnexoProgGado()) {

                    return Html::a('Abrir', $model->getAnexoProgGado(), ['target' => '_blank']);
                } else {
                    return 'Nenhum anexo disponível';
                }
            },
        ],
        [
            'attribute' => 'distriKitVeterinaria',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'composicaoKitVeter',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nTotalKitDistribuido',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'anexoKitDistri',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw', // Define o formato como HTML
            'value' => function ($model) {
                if ($model->getAnexoKit()) {

                    return Html::a('Abrir', $model->getAnexoKit(), ['target' => '_blank']);
                } else {
                    return 'Nenhum anexo disponível';
                }
            },
        ],
        [
            'attribute' => 'desafiosImplementacaoONG',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'licoesAprendidasONG',
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
            'attribute' => 'estadoValidacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => $model->getEstadoreforcoinstitucional(),
            'filterInputOptions' => [
                'id' => 'status',
            ],
            'filterWidgetOptions' => [
                'theme' => Select2::THEME_BOOTSTRAP,
                'pluginOptions' => ['allowClear' => true,],
                'options' => ['placeholder' => Yii::t('app', 'Select...')
                ],
            ],
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
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
        [
            'label' => 'Ações',
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
        ],
    ];
    ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'], // offset from top
        'floatPageSummary' => true, // table page summary floats when you scroll
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
                    'title' => 'Adicionar Reforço Institucional',
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
        // set export properties
        'exportConfig' => [
            // 'html' => [],
            'csv' => [],
            // 'txt' => [],
            'xls' => [],
        // 'pdf' => [],
        //  'json' => [],
        ],
        'panel' => [
            'heading' => Yii::t('app', 'Reforço Institucional'),
            'type' => '',
            'before' => '<div class="btn-group">' .
            //Html::a(Yii::t('app', 'Criar Reforço Institucional'), ['create'], ['class' => 'btn btn-danger']).
            Html::beginForm(['validar-selecionados'], 'post', ['class' => 'form-inline']) .
            Html::submitButton('Validar Selecionados', ['class' => 'btn btn-primary botao']) .
            '</div>',
            //'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer' => true
        ],
        'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
        'persistResize' => true,
        'toggleDataOptions' => ['minCount' => 10],
            //'itemLabelSingle' => 'book',
            // 'itemLabelPlural' => 'books',
    ]);
    ?>
    <?= Html::endForm() ?>
</div>
