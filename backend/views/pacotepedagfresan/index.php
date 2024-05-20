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

use backend\models\Pacotepedagfresan;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\PacotepedagfresanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var Created by: Agostinho Francisco Paixão do Rosário */
/** @varE - mail  : rosarioabderval@gmail.com */
/** @var Tel: +244 930 744 338 */
/** @var Esta afirmação é fiel e digna de toda aceitação: Cristo Jesus veio ao mundo para salvar os pecadores, dos quais eu sou o pior. */
/** @var 1 Timóteo 1:15 */
$this->title = Yii::t('app', 'Pacote Pedagógico da Nutrição / FRESAN');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pacotepedagfresan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

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
            'header' => '',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        [
            'attribute' => 'Id',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
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
            'hidden' => false,
            'value' => 'localidade.nomeLocalidade', // Access the related nomeProvincia attribute
        ],
        [
            'attribute' => 'receitaMwangole',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'painelAlimentacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'outroManualAlimentacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'primeiroReporte',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
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
            'hidden' => true,
        ],
        [
            'attribute' => 'entidade',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
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
            'attribute' => 'desafiosImplementacaoONG:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'licoesImplementacaoONG:ntext',
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
            'attribute' => 'constatacoesFeitasFresan',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'recomendacoesPrincipaisFresan:ntext',
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
        ],
        [
            'attribute' => 'estadoValidacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'criadoPor',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'actualizadoPor',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'createdAt',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'UpdatedAt',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'estadoValidacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'filterType' => GridView::FILTER_SELECT2,
            //'filter' => $model->getEstadoreforcoinstitucional(),
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
                'title' => 'Adicionar Pacote Pedagógico da Nutrição / FRESAN',
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
        'heading' => Yii::t('app', 'Pacote Pedagógico da Nutrição / FRESAN'),
        'type' => '',
        'before' => '<div class="btn-group">' .
        //Html::a(Yii::t('app', 'Criar pacotepedagfresan'), ['create'], ['class' => 'btn btn-danger']).
        Html::beginForm(['validar-selecionados'], 'post', ['class' => 'form-inline']) .
        Html::submitButton('Validar Selecionados', ['class' => 'btn btn-primary botao']) .
        '</div>',
        //'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        'footer' => false
    ],
    'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
    'persistResize' => false,
    'toggleDataOptions' => ['minCount' => 10],
    'itemLabelSingle' => 'PP',
    'itemLabelPlural' => 'PPs',
]);
?>




</div>
