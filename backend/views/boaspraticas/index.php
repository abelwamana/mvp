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
        color: #fff; /* Cor do texto para legibilidade */
        /* Outros estilos conforme necessário */
    }
    .btn-sm
    {
        padding: 2px 3px;
    }
    .btn-danger
    {
        width: 22px;
    }

</style>

<?php

use backend\models\Boaspraticas;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\BoaspraticasSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Boas Práticas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="boaspraticas-index">

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
            'Id',
            'boapratica:ntext',
            'justificacao',
            'area',
            [
                'attribute' => 'provinciaID',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model) {
                    return $model->provinciaID ? $model->provincia->nomeProvincia : '';
                },
            ],
            [
                'attribute' => 'municipioID',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model) {
                    return $model->municipioID ? $model->municipio->nomeMunicipio : '';
                },
            ],
            [
                'attribute' => 'comunaID',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model) {
                    return $model->comunaID ? $model->comuna->nomeComuna : '';
                },
            ],
            'localidade',
            'latitude',
            'longitude',
            'entidadepropoente',
            'entidadeimplementadora',
            'fotografia',
            'recomendacoesID',
            'estrategia_de_sustentabilidadeID',
            'arquivoID',
            'aprovado',
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view} {update} {delete} {approve}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'title' => 'Ver',
                            'aria-label' => 'Ver',
                            'class' => 'btn btn-info btn-sm', // Cor para "Ver"
                        ]);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<i class="fas fa-edit"></i>', $url, [
                            'title' => 'Editar',
                            'aria-label' => 'Editar',
                            'class' => 'btn btn-warning btn-sm', // Cor para "Editar"
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class="fas fa-trash"></i>', $url, [
                            'title' => 'Deletar',
                            'aria-label' => 'Deletar',
                            'class' => 'btn btn-danger btn-sm', // Cor para "Deletar"
                            'data-pjax' => '0',
                            'data' => [
                                'confirm' => 'Tem certeza que deseja deletar esta boa prática?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'approve' => function ($url, $model, $key) {
                        if (Yii::$app->user->can('Permissão de Administrador') && !$model->aprovado) {
                            return Html::a('<i class="fas fa-check"></i>', $url, [
                                        'title' => 'Aprovar',
                                        'aria-label' => 'Aprovar',
                                        'class' => 'btn btn-success btn-sm', // Cor para "Aprovar"
                                        'data-pjax' => '0',
                                        'data' => [
                                            'confirm' => 'Tem certeza que deseja aprovar esta boa prática?',
                                            'method' => 'post',
                                        ],
                            ]);
                        }
                        return '';
                    },
                ],
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
                    if ($action === 'approve') {
                        return ['approve', 'Id' => $model->Id];
                    }
                },
            ],
        ];
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
                        'title' => 'Adicionar Boa Prática',
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
                'xls' => [],
            ],
            'panel' => [
//        'heading' => Yii::t('app', 'biblioteca'),
                'type' => '',
                'before' => '<div class="btn-group">' .
                '</div>',
                'footer' => false
            ],
            'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
            'persistResize' => false,
            'toggleDataOptions' => ['minCount' => 10],
            'itemLabelSingle' => 'Boa Prática',
            'itemLabelPlural' => 'Boas Práticas',
        ]);
        ?>



    </div>    
</div>