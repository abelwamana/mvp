<style>
    .container{
        position: relative;
        width: 100%;
        max-width: 100%;
        /*margin-right: 5%;*/
        overflow-x: hidden;   /*esconde o scroll horizontal*/
        /*overflow-y: auto;  permite o scroll vertical quando necessário*/
    }
    /* Altere a cor de fundo do tipo 'info' do painel para a cor desejada */
    .card-header  {
        background-color: #919733; /* Substitua pelo código de cor desejado */
        color: #ffffff; /* Cor do texto para legibilidade */
    }
    .btn.btn-primary.botao {
        background-color: #919733; /* Cor de fundo do botão primário Bootstrap */
        color: #fff; /* Cor do texto pause kartik\grid\GridView;ra legibilidade */
        /* Outros estilos conforme necessário */
    }

</style>

<link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<?php

use backend\models\Biblioteca;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\grid\GridView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\BibliotecaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var Created by: Agostinho Francisco Paixão do Rosário */
/** @varE - mail  : rosarioabderval@gmail.com */
/** @var Tel: +244 930 744 338 */
/** @var Esta afirmação é fiel e digna de toda aceitação: Cristo Jesus veio ao mundo para salvar os pecadores, dos quais eu sou o pior. */
/** @var 1 Timóteo 1:15 */
$this->title = Yii::t('app', 'BIBLIOTECA');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="biblioteca-index">

        <h3 class="nao-imprimi" style="text-align: center !important;"><b><?= Html::encode($this->title) ?></b></h3>

<?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

        <?php
        $gridColumns = [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->id];
                },
            ],
//    [
//    'class' => 'kartik\grid\SerialColumn',
//    'contentOptions' => ['class' => 'kartik-sheet-style'],
//    'width' => '36px',
//    'header' => '',
//    'headerOptions' => ['class' => 'kartik-sheet-style']
//    ],          
//    [
//  'attribute'=> 'id',
//  'vAlign'=> 'middle',
//  'hAlign'=> 'center',
//  'hidden'=> false,
//],
            [
                'attribute' => 'convite',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'actividade',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'organizacao',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'codigo',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'nome',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'autores',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'tema',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'descricao',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'classificacao',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'tipo',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'estado',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'dataEstado',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'anoConcluido',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'numPagina',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'responsavelGestorUIC',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'usuarios',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'informacaoPlanilha',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'monitoriatemarquivo',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'estaNoSiteFRESANLBC',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'linkFresanLbc',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => false,
            ],
            [
                'attribute' => 'print',
                'format' => 'raw',
                'value' => function ($model) {
                     if ($model->print) {
                    return Html::a(Html::img(Url::to('@web/' . $model->print), ['width' => '100']), ['biblioteca/download', 'id' => $model->id], [
                        'data-method' => 'post',
                        'data-pjax' => '0',
                    ]);
                    } else {
                    return 'Sem Imagem';
                }
                },
            ],
            [
                'attribute' => 'arquivo',
                'format' => 'raw',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model) {
                    return Html::a($model->arquivo, ['biblioteca/download', 'id' => $model->id], [
                        'data-method' => 'post',
                        'data-pjax' => '0',
                    ]);
                },
            ],
//            [
//        'label' => 'Arquivo',
//        'format' => 'raw',
//        'value' => function ($model) {
//            return Html::a('Download', ['biblioteca/download', 'id' => $model->id], [
//                'data-method' => 'post', // Para evitar que o link seja interpretado como GET
//                'data-pjax' => '0',      // Para garantir que não seja carregado via PJAX
//            ]);
//        },
//    ],
//[
//  'attribute'=> 'tipo_arquivo',
//  'vAlign'=> 'middle',
//  'hAlign'=> 'center',
//  'hidden'=> false,
//],
//[
//  'attribute'=> 'tamanho_arquivo',
//  'vAlign'=> 'middle',
//  'hAlign'=> 'center',
//  'hidden'=> false,
//],
            [
                'attribute' => 'data_upload',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => true,
            ],
//    [
//    'attribute' => 'estadoValidacao',
//    'vAlign' => 'middle',
//    'hAlign' => 'center',
//    'filterType' => GridView::FILTER_SELECT2,
//    //'filter' => $model->getEstadoreforcoinstitucional(),
//    'filterInputOptions' => [
//    'id' => 'status',
//    ],
//    'filterWidgetOptions' => [
//    'theme' => Select2::THEME_BOOTSTRAP,
//    'pluginOptions' => ['allowClear' => true,],
//    'options' => ['placeholder' => Yii::t('app', 'Select...')
//    ],
//    ],
//    ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return ['view', 'id' => $model->id];
                    }
                    if ($action === 'update') {
                        return ['update', 'id' => $model->id];
                    }
                    if ($action === 'delete') {
                        return ['delete', 'id' => $model->id];
                    }
                },
            ],
//    [
//    'label' => 'Ações',
//    'format' => 'raw',
//    'value' => function ($model) {
//    $acoes = $model->getAcoesBotoes();
//    $buttons = '';
//    foreach ($acoes as $acao) {
//    $buttons .= Html::a($acao['label'], $acao['url'], [
//    'class' => $acao['class'],
//    'onclick' => 'showSuccessAlert();', // Chama a função para exibir o alerta
//    ]) . ' ';
//    }
//    return $buttons;
//    },
//    ]     
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
                        'title' => 'Adicionar biblioteca',
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
//        'heading' => Yii::t('app', 'biblioteca'),
                'type' => '',
                'before' => '<div class="btn-group">' .
//            //Html::a(Yii::t('app', 'Criar biblioteca'), ['create'], ['class' => 'btn btn-danger']).
//            Html::beginForm(['validar-selecionados'], 'post', ['class' => 'form-inline']) .
//            Html::submitButton('Validar Selecionados', ['class' => 'btn btn-primary botao']) .
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



    </div>    
</div>
