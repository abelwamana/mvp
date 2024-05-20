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

use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var Created by: Agostinho Francisco Paixão do Rosário */
/** @varE - mail  : rosarioabderval@gmail.com */
/** @var Tel: +244 930 744 338 */
/** @var Esta afirmação é fiel e digna de toda aceitação: Cristo Jesus veio ao mundo para salvar os pecadores, dos quais eu sou o pior. */
/** @var 1 Timóteo 1:15 */
$this->title = Yii::t('app', 'Administrar usuários');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php
    $gridColumns = [
        [
            'class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function ($model, $key, $index, $column) {
                return ['value' => $model->id];
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
            'attribute' => 'id',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'username',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'auth_key',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'password_hash',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'password_reset_token',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'email',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'status',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'created_at',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'updated_at',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'verification_token',
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
            'attribute' => 'nomeCompleto',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
//        [
//            'attribute' => 'estadoValidacao',
//            'vAlign' => 'middle',
//            'hAlign' => 'center',
//            'filterType' => GridView::FILTER_SELECT2,
//            //'filter' => $model->getEstadoreforcoinstitucional(),
//            'filterInputOptions' => [
//                'id' => 'status',
//            ],
//            'filterWidgetOptions' => [
//                'theme' => Select2::THEME_BOOTSTRAP,
//                'pluginOptions' => ['allowClear' => true,],
//                'options' => ['placeholder' => Yii::t('app', 'Select...')
//                ],
//            ],
//        ],
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
                Html::a('<i class="fas fa-plus"></i>', ['signup'], [
                    'class' => 'btn btn-primary botao',
                    'title' => 'Adicionar user',
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
        'panelTemplate' => '{toolbar} {items} ' . Html::tag('div', '{summary} {pager}', ['style' => 'padding: 10px']),
        'panel' => [
            'heading' => Yii::t('app', 'Reforço Institucional'),
            'type' => '',
            'before' => '<div class="btn-group">' .
            //Html::a(Yii::t('app', 'Criar Reforço Institucional'), ['create'], ['class' => 'btn btn-danger']).
            Html::beginForm(['validar-selecionados'], 'post', ['class' => 'form-inline']) .
            Html::submitButton('Validar Selecionados', ['class' => 'btn btn-primary botao']) .
            Html::endForm() .
       
            '</div>',
            //'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer' => true
        ],
        'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
        'persistResize' => true,
        'toggleDataOptions' => ['minCount' => 10],
        'itemLabelSingle' => 'book',
        'itemLabelPlural' => 'books',
    ]);
    ?>




</div>
