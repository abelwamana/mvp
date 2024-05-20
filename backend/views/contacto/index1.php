<style>
    .container{
        position: relative;
        width: 100%;
        max-width: 100%;
        /*overflow-x: hidden;  esconde o scroll horizontal*/
        overflow-y: auto; /* permite o scroll vertical quando necessário */
    }
    /* Altere a cor de fundo do tipo 'info' do painel para a cor desejada */
    .custom-heading {
        color: #919733; /* Defina a cor desejada para o texto do heading */
    }
    .btn.btn-success {
        background-color: #919733; /* Cor de fundo do botão primário Bootstrap */
        color: #fff; /* Cor do texto para legibilidade */
        /* Outros estilos conforme necessário */
    }
    .card-header  {
        background-color: #919733; /* Substitua pelo código de cor desejado */
        color: #ffffff; /* Cor do texto para legibilidade */
    }
    .btn.btn-primary.botao {
        background-color: #919733; /* Cor de fundo do botão primário Bootstrap */
        color: #fff; /* Cor do texto para legibilidade */
        border-radius: 4px 0px 0px 4px;
        position: relative;
    }
    .btn.btn-outline-secondary{
        margin-left: -5px;
        border-radius: 0px 4px 4px 0px;
    }
    .nao-mostra {
        display: none;
    }
    @media print {
        .nao-imprimi {
            display: none !important;
        }
        .imprimi {
            display: block;
        }
    }
        .table td {
        min-height: 20px; /* ou qualquer outra altura desejada */
    }
</style>
<?php

use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Contacto;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContactoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="container">
    <?php
    $this->title = 'CONTACTOS';
    $this->params['breadcrumbs'][] = $this->title;
    ?>
    
    <!--<div class="contacto-index">-->

    <div class="nao-mostra imprimi">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="col-6"  style="margin-left: -27px;">  
                <?=
                Html::a(
                        '<img style="width: 145%;" src="images/logo221.png">',
                        ['/site/index']
                );
                ?>

            </div> 
            <div class="col-6 text-right"  style="margin-right: 3px; ">  
                <img style="width: 7%;
                     margin-right:-15px;
                     position: relative;" src="images/logo24.png">

            </div>
            <!--<div class="col-6" style="margin-right: -588px; position: relative" >  </div>-->
        </div>

        <img style="width: 100%;
             max-width: 100%;" src="images/barra1.png">
    </div>
<h3 class="imprimi" style="text-align: center !important;"><b><?= Html::encode($this->title) ?></b></h3>
    <div class="nao-imprimi">  <p>

            <?=
            Html::a('<i class="fas fa-plus"></i>', ['create'], [
                'class' => 'btn btn-primary botao',
                'title' => 'Adicionar Contacto',
            ])
            ?>
            <?=
            Html::a('<i class="fas fa-redo"></i>', ['index'], [
                'class' => 'btn btn-outline-secondary',
                'title' => 'Reiniciar a Tabela',
                'data-pjax' => 0,
            ])
            ?>
        </p></div>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model, $key, $index, $grid) {
            return ['style' => 'height: 10px;'];
        }, // 
//         'tableOptions' => ['style' => 'height: 10px;'], // Defina a altura desejada aqui
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->Id];
                },
            ],
            [
                'attribute' => 'Id',
                'contentOptions' => ['style' => 'vertical-align: middle; text-align: center;'],
                'headerOptions' => ['style' => 'text-align: center;'],
                'contentOptions' => ['class' => 'custom-table-cell'],
                'header' => '<span style="color: black;">ID</span>',
            ],
            [
                'attribute' => 'nome',
                'contentOptions' => ['style' => 'vertical-align: middle;text-align: center;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Nome</span>',
            ],
            [
                'attribute' => 'funcaoID',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Função</span>',
            ],
            [
                'attribute' => 'instituicao',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Instituição</span>',
            ],
            [
                'attribute' => 'contacto',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Contacto</span>',
            ],
            [
                'attribute' => 'email',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">E-mail</span>',
            ],
            [
                'attribute' => 'pais',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">País</span>',
            ],
            [
                'attribute' => 'provinciaID',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Província</span>',
            ],
            [
                'attribute' => 'municipioID',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Município</span>',
            ],
            [
                'attribute' => 'comunaID',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Comuna</span>',
            ],
            [
                'attribute' => 'localidade',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Localidade</span>',
            ],
            [
                'attribute' => 'pontofocal',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Ponto Focal</span>',
            ],
            [
                'attribute' => 'actividades',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Nome</span>',
            ],
            [
                'attribute' => 'entidade',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Entidade</span>',
            ],
            [
                'attribute' => 'nivel',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Nível</span>',
            ],
            [
                'attribute' => 'rotulo',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Rótulo</span>',
            ],
            [
                'attribute' => 'privacidade',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Privacidade</span>',
            ],
            [
                'attribute' => 'estado',
                'contentOptions' => ['style' => 'vertical-align: middle;'],
                'headerOptions' => ['style' => 'color: black; text-align: center;'],
                'header' => '<span style="color: black;">Estado</span>',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
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
        ],
        'pager' => [
            'class' => 'yii\widgets\LinkPager',
            'firstPageLabel' => 'Primeiro',
            'lastPageLabel' => 'Último',
            'prevPageLabel' => 'Anterior',
            'nextPageLabel' => 'Próximo',
            'maxButtonCount' => 5,
        ],
        'options' => [
            'class' => 'grid-view',
        ],
        'summary' => '',
    ]);
    ?>

</div>
</div>

