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

use backend\models\DoccomunicacaoSearch;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var DoccomunicacaoSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */
/** @var Created by: Agostinho Francisco Paixão do Rosário */
/** @varE - mail  : rosarioabderval@gmail.com */
/** @var Tel: +244 930 744 338 */
/** @var Esta afirmação é fiel e digna de toda aceitação: Cristo Jesus veio ao mundo para salvar os pecadores, dos quais eu sou o pior. */
/** @var 1 Timóteo 1:15 */
//$this->title = Yii::t('app', 'B.Documentos e Comunicação');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doccomunicacao-index">

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
            'hidden' => false,
            'value' => 'municipio.nomeMunicipio', // Access the related nomeProvincia attribute
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
            'attribute' => 'repondente',
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
            'attribute' => 'actividade',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'classificacaoDocumentoID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nomeDocumentoArtigo',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'areaTematica',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'descricaoDocumentoArtigo:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'audienciaProduto',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'qtdTotalProduto',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'estado',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'dataConclusao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'documentoDisponivel',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'documentoCumpreNormasPublicacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'documentoValidado',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'anexo',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw', // Define o formato como HTML
            'value' => function ($model) {
                if ($model->getAnexoLink()) {

                    return Html::a('Baixar', $model->getAnexoLink(), ['download' => true]);
                } else {
                    return 'Nenhum anexo disponível';
                }
            },
        ],
        [
            'attribute' => 'hiperlink',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'desafiosImplementacao:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'licoesAprendidas:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'dataMonitoria',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'tecnicoResponsavel',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'recomendacoes:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'estadoCumprimento',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'medidasMitigacaoONG:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'medidasMitigacaoEstado:ntext',
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
                    'title' => 'Adicionar doccomunicacao',
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
            'heading' => Yii::t('app', 'B.Documentos e Comunicação'),
            'type' => '',
            'before' => '<div class="btn-group">' .
            //Html::a(Yii::t('app', 'Criar doccomunicacao'), ['create'], ['class' => 'btn btn-danger']).
            Html::beginForm(['validar-selecionados'], 'post', ['class' => 'form-inline']) .
            Html::submitButton('Validar Selecionados', ['class' => 'btn btn-primary botao']) .
            '</div>',
            //'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer' => true
        ],
        'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
        'persistResize' => true,
        'toggleDataOptions' => ['minCount' => 10],
        'itemLabelSingle' => 'Doc',
        'itemLabelPlural' => 'Docs',
    ]);
    ?>




</div>
