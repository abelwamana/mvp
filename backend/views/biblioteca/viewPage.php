<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\Biblioteca $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Biblioteca'), 'url' => ['biblioteca']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">

    <div class="img-container">
        <img src="<?= Url::to('@web/biblioteca/' . $model->print) ?>" alt="Imagem">
    </div>

<!--   <div class="btn-group" style="width: 100%; display: flex; justify-content: center; margin-top: 10px;">
        <a href="<?= Url::to(['biblioteca/view', 'id' => $model->id]) ?>" class="btn btn-primary" style="flex: 1;">Detalhes</a>
        <?php if (!empty($model->arquivo)): ?>
            <a href="<?= Url::to('@web/biblioteca/' . $model->arquivo) ?>" class="btn btn-secondary" target="_blank" style="flex: 1;">Abrir Documento</a>
            <a href="<?= Url::to(['biblioteca/download', 'id' => $model->id]) ?>" class="btn btn-success" style="flex: 1;">Download</a>
        <?php endif; ?>
    </div>-->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'autores',
            'tema',
            'descricao',
            'classificacao',
            'tipo',
            'estado',
            'dataEstado',
            'anoConcluido',
            'numPagina',
                    ],
    ]) ?>

</div>

<style>
/*    .biblioteca-view {
        text-align: center;  Centralizar conteúdo 
    }*/
    
/*     .container {
        position: relative;
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }*/
    
    .img-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
    }

    .img-container img {
        max-width: 100%;
        height: auto;
        max-height: 300px; 
    }

    .btn-group a {
        flex: 1; /* Fazer com que os botões ocupem o mesmo espaço */
        margin: 0 0px; /* Espaçamento entre os botões */
    }
</style>
