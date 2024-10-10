<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Biblioteca $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Biblioteca'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="biblioteca-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Editar'), ['update', 'fileName' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'fileName' => $model->arquivo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Tem certeza que deseja eliminar este arquivo?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'convite',
            'actividade',
            'organizacao',
            'codigo',
            'titulo',
            'autores',
            'tema',
            'descricao:ntext',
            'classificacao',
            'tipo',
            'estado',
            'dataEstado',
            'anoConcluido',
            'numPagina',
            'responsavelGestorUIC',
            'usuarios:ntext',
            'informacaoPlanilha',
            'monitoriatemarquivo',
            'estaNoSiteFRESANLBC',
            'linkFresanLbc',
            'tipo_arquivo',
            'tamanho_arquivo',
            'data_upload',
        ],
    ]) ?>

</div>
