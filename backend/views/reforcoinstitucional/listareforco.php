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

use backend\models\Reforcoinstitucional;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\bootstrap5\Alert;

/** @var yii\web\View $this */
/** @var backend\models\ReforcoinstitucionalSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

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
    $colorPluginOptions =  [
    'showPalette' => true,
    'showPaletteOnly' => true,
    'showSelectionPalette' => true,
    'showAlpha' => false,
    'allowEmpty' => false,
    'preferredFormat' => 'name',
    'palette' => [
        [
            "white", "black", "grey", "silver", "gold", "brown", 
        ],
        [
            "red", "orange", "yellow", "indigo", "maroon", "pink"
        ],
        [
            "blue", "green", "violet", "cyan", "magenta", "purple", 
        ],
    ]
];
    $gridColumns = [
        [
    'class'=>'kartik\grid\SerialColumn',
    'contentOptions'=>['class'=>'kartik-sheet-style'],
    'width'=>'36px',
    'pageSummary'=>'Total',
    'pageSummaryOptions' => ['colspan' => 6],
    'header'=>'',
    'headerOptions'=>['class'=>'kartik-sheet-style']
],

[
    'class' => 'kartik\grid\ExpandRowColumn',
    'width' => '50px',
    'value' => function ($model, $key, $index, $column) {
        return GridView::ROW_COLLAPSED;
    },
    // show row expanded for even numbered keys
    'detailUrl' => Url::to(['/reforcoinstitucional/index']),
    'value' => function ($model, $key, $index) {
        if ($key % 2 === 0) {
            return GridView::ROW_EXPANDED;
        }
        return GridView::ROW_COLLAPSED;
    },
    'headerOptions' => ['class' => 'kartik-sheet-style'] ,
    'expandOneOnly' => true
],

        
        
        
        
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
            'header' => '',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        [
            'attribute' => 'entidade',
            'vAlign' => 'middle',
            'hAlign' => 'center'
        ],
        [
            'attribute' => 'respondente',
            'vAlign' => 'middle',
            'hAlign' => 'center'
        ],
        [
            'attribute' => 'provinciaID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'value' => 'provincia.nomeProvincia', // Access the related nomeProvincia attribute
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
        'export' => [
            'fontAwesome' => true
        ],
        'exportConfig' => [
            'html' => [],
            'csv' => [],
            'txt' => [],
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
            'footer' => false
        ],
        'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
        'persistResize' => false,
        'toggleDataOptions' => ['minCount' => 10],
        'itemLabelSingle' => 'book',
        'itemLabelPlural' => 'books',
    ]);
    ?>
    <?= Html::endForm() ?>
</div>
