<style>
    .container{
        position: relative;
        width: 95%;
        max-width: 95%;
        /*margin-right: 5%;*/
        overflow-x: hidden;  /*esconde o scroll horizontal*/
        /*overflow-y: auto;  permite o scroll vertical quando necessário*/
    }
    /* Altere a cor de fundo do tipo 'info' do painel para a cor desejada */
    .expression {
        display: flex;
        align-items: center;
    }
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
    kv-col-2 {

        width: 30% !important;
    }
    .custom-search-wrapper {
        position: relative;
        display: inline-block;
    }

    .custom-search-input {
        padding-left: 30px; /* Espaço para o ícone */
    }

    .custom-search-wrapper .fa-search {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(0, 0, 0, 0.5); /* Cor do ícone */
    }

</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
    ?>
    <h3 class="nao-imprimi" style="text-align: center !important;"><b><?= Html::encode($this->title) ?></b></h3>
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
    <h3 class="nao-mostra imprimi" style="text-align: center !important;"><b><?= Html::encode($this->title) ?></b></h3>
    <div style="margin-top: 25px">       
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'checkboxOptions' => function ($model, $key, $index, $column) {
                        return ['value' => $model->Id];
                    },
                ],
//            [
//                'class' => 'kartik\grid\SerialColumn',
//                'contentOptions' => ['class' => 'kartik-sheet-style'],
//                'width' => '36px',
//                'header' => '',
//                'headerOptions' => ['class' => 'kartik-sheet-style'],
//            ],
                [
                    'attribute' => 'Id',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">ID</span>',
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[Id]" class="form-control custom-search-input" placeholder="Pesquisar">
                 </div>',
                ],
                [
                    'attribute' => 'nome',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Nome</span>', // Persona
                    'contentOptions' => ['style' => 'min-width:300px; '],
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[nome]" class="form-control custom-search-input" placeholder="Pesquisar">
                 </div>',
                ],
                [
                    'attribute' => 'contacto',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Contacto</span>',
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[contacto]" class="form-control custom-search-input" placeholder="Pesquisar">
                 </div>',
                ],
                [
                    'attribute' => 'email',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">E-mail</span>',
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[email]" class="form-control custom-search-input" placeholder="Pesquisar">
                 </div>',
                ],
                [
                    'attribute' => 'funcao',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Função</span>',
//                    'contentOptions' => ['style' => 'white-space: nowrap;'], // Evita quebra de linha
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[funcao]" class="form-control custom-search-input" placeholder="Pesquisar">
                 </div>',
                ],
                [
                    'attribute' => 'instituicao',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'headerOptions' => ['style' => 'color: black; width: 100px !important;'], // Cor do texto do título da coluna
                    'header' => '<span style="color: black;">Instituição</span>',
//                    'contentOptions' => ['style' => 'white-space: nowrap;'], // Evita quebra de linha
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[instituicao]" class="form-control custom-search-input" placeholder="Pesquisar">
                 </div>',
                ],
                // Inside the GridView widget
                [
                    'attribute' => 'provinciaNome',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'value' => 'provincia.nomeProvincia',
                    'header' => '<span style="color: black;">Província</span>',
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[provinciaNome]" class="form-control custom-search-input" placeholder="Pesquisar">
                    </div>',
                ],
                [
                    'attribute' => 'municipioNome',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'value' => 'municipio.nomeMunicipio',
                    'header' => '<span style="color: black;">Município</span>',
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[municipioNome]" class="form-control custom-search-input" placeholder="Pesquisar">
                    </div>',
                ],
                [
                    'attribute' => 'comunaNome',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
//                    'value' => 'comuna.nomeComuna',
                    'value' => function ($model) {
                        return $model->comuna ? $model->comuna->nomeComuna : '';
                    },
                    'header' => '<span style="color: black;">Comuna</span>',
                    'filter' => '<div class="custom-search-wrapper">
                  <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[comunaNome]" class="form-control custom-search-input" placeholder="Pesquisar">
                 </div>',
                ],
                [
                    'attribute' => 'localidade',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Localidade</span>',
                    'contentOptions' => ['style' => 'white-space: nowrap;'], // Evita quebra de linha
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[localidade]" class="form-control custom-search-input" placeholder="Pesquisar">
                     </div>',
                ],
                [
                    'attribute' => 'pais',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Pais</span>',
                    'contentOptions' => ['style' => 'min-width:100px; '],
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[pais]" class="form-control custom-search-input" placeholder="Pesquisar">
                    </div>',
                ],
                [
                    'attribute' => 'pontofocal',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Ponto Focal</span>',
                    'contentOptions' => ['style' => 'white-space: nowrap;'], // Evita quebra de linha
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[pontofocal]" class="form-control custom-search-input" placeholder="Pesquisar">
                     </div>',
                ],
                [
                    'attribute' => 'actividades',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Actividades</span>',
                    'contentOptions' => ['style' => 'white-space: nowrap;'], // Evita quebra de linha
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[actividades]" class="form-control custom-search-input" placeholder="Pesquisar">
                     </div>',
                ],
                [
                    'attribute' => 'entidade',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Entidade</span>',
                    'contentOptions' => ['style' => 'white-space: nowrap;'], // Evita quebra de linha
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[entidade]" class="form-control custom-search-input" placeholder="Pesquisar">
                 </div>',
                ],
                [
                    'attribute' => 'nivel',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Nível</span>',
                    'contentOptions' => ['style' => 'white-space: nowrap;'], // Evita quebra de linha
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[nivel]" class="form-control custom-search-input" placeholder="Pesquisar">
                     </div>',
                ],
                [
                    'attribute' => 'rotulo',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Rótulo</span>',
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                        <input type="text" name="ContactoSearch[rotulo]" class="form-control custom-search-input" placeholder="Pesquisar">
                 </div>',
                ],
                [
                    'attribute' => 'privacidade',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Privacidade</span>',
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[privacidade]" class="form-control custom-search-input" placeholder="Pesquisar">
                  </div>',
                ],
                [
                    'attribute' => 'estado',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Estado</span>',
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[estado]" class="form-control custom-search-input" placeholder="Pesquisar">
                     </div>',
                ],
                [
                    'attribute' => 'usuario',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'header' => '<span style="color: black;">Usuário</span>',
                    'filter' => '<div class="custom-search-wrapper">
                    <i class="fa fa-search"></i>
                    <input type="text" name="ContactoSearch[usuario]" class="form-control custom-search-input" placeholder="Pesquisar">
                     </div>',
                ],
//            [
//                'attribute' => 'estadoValidacao',
//                'vAlign' => 'middle',
//                'hAlign' => 'center',
//                'filterType' => GridView::FILTER_SELECT2,
//                'filterInputOptions' => [
//                    'id' => 'status',
//                ],
//                'filterWidgetOptions' => [
//                    'theme' => Select2::THEME_BOOTSTRAP,
//                    'pluginOptions' => ['allowClear' => true,],
//                    'options' => ['placeholder' => Yii::t('app', 'Select...')],
//                ],
//            ],
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
            ],
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
                        'title' => 'Adicionar Contactos',
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
//     'pdf' => [],
            //  'json' => [],
            ],
            'panel' => [
//                'heading' => Yii::t('app', '[Pesquise no espaço em branco abaixo da categoria]'),
                'type' => '',
//        'before' => '<div class="btn-group">' .
//        //Html::a(Yii::t('app', 'Criar capacitacao'), ['create'], ['class' => 'btn btn-danger']).
//        Html::beginForm(['validar-selecionados'], 'post', ['class' => 'form-inline']) .
//        Html::submitButton('Validar Selecionados', ['class' => 'btn btn-primary botao']) .
//        '</div>',
//        //'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
//        'footer' => true
            ],
            'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
            'persistResize' => true,
            'toggleDataOptions' => ['minCount' => 10],
            'itemLabelSingle' => 'Contacto',
            'itemLabelPlural' => 'Contactos',
        ]);
        ?>

    </div>
</div>

