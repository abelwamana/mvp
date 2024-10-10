<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Arquivo $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Arquivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="arquivo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'referencia',
            'entidade',
            'provinciaID',
            'municipioID',
            'biblioteca',
            'meio_de_verificacao',
            'arquivo',
            'area',
            'descricao:ntext',
            'tipo',
            'ano',
            'caminho',
            'foto_da_capa',
            'tipo_arquivo',
            'tamanho_arquivo',
            'data_upload',
        ],
    ]) ?>

</div>
