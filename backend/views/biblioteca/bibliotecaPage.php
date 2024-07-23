<style>
.container {
    margin-top: -5px;
    overflow-x: hidden;
}

.card-header {
    background-color: #919733;
    color: #ffffff;
}

.btn.btn-primary.botao {
    background-color: #919733;
    color: #fff;
}

.biblioteca-container {
    display: flex;
    flex-wrap: wrap;
    /*padding: 0px;*/
    /*text-align: right;*/
    /*margin-left: 0%;*/
}

.biblioteca-item {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-left: 5px;
    width: calc(18% - 21.5px);;
    text-align: center;
    overflow: hidden;
    height: 298.7px;
    /*padding: -10px;*/
}

.biblioteca-item img {
    width: 80%;
    height: 67%;
    margin: 0px;
    padding: 0px -5px 0px 0px;
}

.biblioteca-item h3 {
    background-color: #919733;
    color: #fff;
    margin: 0;
    padding: 10px 0;
}

.biblioteca-item p {
    padding: 0 10px 0px;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 2;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 0px;
    margin-top: -3%;
}

.biblioteca-item a {
    display: block;
    background-color: #919733;
    color: #fff;
    padding: 10px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.biblioteca-item a:hover {
    background-color: #6b7427;
}

.search-filter-container {
    display: flex;
    align-items: center;
    padding: 15px;
    border-radius: 5px;
    color: #999900;
}

.search-section,
.filter-section {
    flex: 1;
    margin-right: -0.3%;
}

.filter-section .form-group {
    margin-right: 10px;
    flex: 1;
}

.search-section input {
    width: 99%;
    margin-right: 10px;
    margin-left: -2.3%;
}

.filter-section select {
    width: 100%;
    min-width: 140px;
}

.form-group {
    margin-bottom: 5px;
}

.btn-group {
    display: flex;
    width: 100%;
    align-items: flex-start; /* Alinha o texto na parte superior dos botões */
    margin-top: 5%;
}

.btn-group .botao {
    flex: 1;
    margin: 0;
    border-radius: 0;
    height: auto; /* Permite que a altura se ajuste ao conteúdo */
    padding: 0px 0px 0px 1px;
    white-space: nowrap; /* Mantém o texto em uma única linha */
    
}

.btn-group .botao:first-child {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 3px;
}

.btn-group .botao:last-child {
    border-top-right-radius: 4px;
    border-bottom-right-radius: 3px;
}

</style>

<link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<?php

use backend\models\Biblioteca;
use yii\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BibliotecaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = Yii::t('app', 'BIBLIOTECA');
?>
<div class="container">
    <h3 class="nao-imprimi" style="text-align: center !important;"><b><?= Html::encode($this->title) ?></b></h3>

    <div class="search-filter-container">
        <!-- Seção de Pesquisa -->
        <div class="search-section">
            <form action="<?= Url::to(['biblioteca/biblioteca']) ?>" method="get">
                <div class="form-group">
                    <input type="text" name="BibliotecaSearch[nome]" class="form-control" placeholder="pesquise aqui...">
                </div>
            </form>
        </div>

        <!-- Seção de Filtros -->
        <div class="filter-section">
            <form action="<?= Url::to(['biblioteca/biblioteca']) ?>" method="get" style="display: flex; align-items: center;">
                <div class="form-group">
                    <?= Html::dropDownList('BibliotecaSearch[tipo]', null, $searchModel->getTipoOptions(), ['class' => 'form-control', 'prompt' => 'Tipo']) ?>
                </div>
                <div class="form-group" style=" margin-right: 1.8%;">
                    <?= Html::dropDownList('BibliotecaSearch[organizacao]', null, $searchModel->getOrganizacaoOptions(), ['class' => 'form-control', 'prompt' => 'Organização']) ?>
                </div>
                <div class="form-group">
                    <?= Html::dropDownList('BibliotecaSearch[anoConcluido]', null, $searchModel->getAnoOptions(), ['class' => 'form-control', 'prompt' => 'Ano']) ?>
                </div>
                <div class="form-group">
                    <?= Html::dropDownList('BibliotecaSearch[estado]', null, $searchModel->getEstadoOptions(), ['class' => 'form-control', 'prompt' => 'Estado']) ?>
                </div>
                <div class="form-group">
                    <button type="submit" style="background-color: #999900;" class="btn btn-secondary btn-block">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="biblioteca-container">
        <?php foreach ($dataProvider->models as $model): ?>
        <div class="biblioteca-item" style="font-size: 12px; color: #999900">
                <img src="<?= Url::to('@web/biblioteca/' . $model->print) ?>" alt="Imagem">
                <hr><p><b><?= Html::encode($model->nome) ?></b></p>
                <div class="btn-group">
                    <a href="<?= Url::to(['biblioteca/viewpage', 'id' => $model->id]) ?>" class="btn btn-secondary botao">Detalhes</a>
                    <?php if (!empty($model->arquivo)): ?>
                        <a href="<?= Url::to('@web/biblioteca/' . $model->arquivo) ?>" class="btn btn-secondary botao" target="_blank">Abrir</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
