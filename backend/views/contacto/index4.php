<style>
    .container{
        position: relative;
        width: 100%;
        max-width: 100%;
        /*overflow-x: hidden;*/
    }
    .expression {
        display: flex;
        align-items: center;
    }
    .custom-heading {
        color: #919733;
    }
    .btn.btn-success {
        background-color: #919733;
        color: #fff;
    }
    .card-header  {
        background-color: #919733;
        color: #ffffff;
    }
    .btn.btn-primary.botao {
        background-color: #919733;
        color: #fff;
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
        min-height: 20px;
    }
    kv-col-2 {
        width: 30% !important;
    }
    .custom-search-wrapper {
        position: relative;
        display: inline-block;
    }
    .custom-search-input {
        padding-left: 30px;
    }
    .custom-search-wrapper .fa-search {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(0, 0, 0, 0.5);
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\Contacto;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ContactoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'CONTACTOS';
?>
<div class="container">
    <h3 class="nao-imprimi" style="text-align: center !important;"><b><?= Html::encode($this->title) ?></b></h3>

    <div class="nao-mostra imprimi">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="col-6"  style="margin-left: -27px;">  
                <?= Html::a('<img style="width: 145%;" src="images/logo221.png">', ['/site/index']) ?>
            </div> 
            <div class="col-6 text-right"  style="margin-right: 3px;">  
                <img style="width: 7%; margin-right:-15px; position: relative;" src="images/logo24.png">
            </div>
        </div>
        <img style="width: 100%; max-width: 100%;" src="images/barra1.png">
    </div>
    <h3 class="nao-mostra imprimi" style="text-align: center !important;"><b><?= Html::encode($this->title) ?></b></h3>
    <div style="margin-top: 25px">       
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\CheckboxColumn', 'checkboxOptions' => function ($model, $key, $index, $column) { return ['value' => $model->Id]; }],
                ['attribute' => 'nome', 'header' => '<span style="color: black;">Nome</span>', 'contentOptions' => ['style' => 'min-width:300px; '], 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[nome]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'contacto', 'header' => '<span style="color: black;">Contacto</span>', 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[contacto]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'email', 'header' => '<span style="color: black;">E-mail</span>', 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[email]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'funcao', 'header' => '<span style="color: black;">Função</span>', 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[funcao]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'instituicao', 'header' => '<span style="color: black;">Instituição</span>', 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[instituicao]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'provinciaNome', 'value' => function ($model) { return $model->provincia ? $model->provincia->nomeProvincia : ''; }, 'header' => '<span style="color: black;">Província</span>', 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[provinciaNome]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'municipioNome', 'value' => function ($model) { return $model->municipio ? $model->municipio->nomeMunicipio : ''; }, 'header' => '<span style="color: black;">Município</span>', 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[municipioNome]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'comunaNome', 'value' => function ($model) { return $model->comuna ? $model->comuna->nomeComuna : ''; }, 'header' => '<span style="color: black;">Comuna</span>', 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[comunaNome]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'localidade', 'header' => '<span style="color: black;">Localidade</span>', 'contentOptions' => ['style' => 'white-space: nowrap;'], 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[localidade]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'pais', 'header' => '<span style="color: black;">Pais</span>', 'contentOptions' => ['style' => 'min-width:100px; '], 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[pais]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'pontofocal', 'header' => '<span style="color: black;">Ponto Focal</span>', 'contentOptions' => ['style' => 'white-space: nowrap;'], 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[pontofocal]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'actividades', 'header' => '<span style="color: black;">Actividades</span>', 'contentOptions' => ['style' => 'white-space: nowrap;'], 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[actividades]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['attribute' => 'entidade', 'header' => '<span style="color: black;">Entidade</span>', 'contentOptions' => ['style' => 'white-space: nowrap;'], 'filter' => '<div class="custom-search-wrapper"><i class="fa fa-search"></i><input type="text" name="ContactoSearch[entidade]" class="form-control custom-search-input" placeholder="Pesquisar"></div>'],
                ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}', 'buttons' => ['view' => function ($url, $model) { return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, ['title' => Yii::t('app', 'view')]); }, 'update' => function ($url, $model) { return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, ['title' => Yii::t('app', 'update')]); }, 'delete' => function ($url, $model) { return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, ['title' => Yii::t('app', 'delete'), 'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'), 'data-method' => 'post']); },]],
            ],
        ]); ?>
    </div>
</div>
