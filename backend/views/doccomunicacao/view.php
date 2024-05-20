<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Doccomunicacao $model */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Doccomunicacaos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="doccomunicacao-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'Id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'Id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'provinciaID',
            'municipioID',
            'primeiroReporte',
            'actualizacao',
            'repondente',
            'entidade',
            'actividade',
            'classificacaoDocumentoID',
            'nomeDocumentoArtigo',
            'areaTematica',
            'descricaoDocumentoArtigo:ntext',
            'audienciaProduto',
            'qtdTotalProduto',
            'estado',
            'dataConclusao',
            'documentoDisponivel',
            'documentoCumpreNormasPublicacao',
            'documentoValidado',
            'anexo',
            'hiperlink',
            'desafiosImplementacao:ntext',
            'licoesAprendidas:ntext',
            'dataMonitoria',
            'tecnicoResponsavel',
            'recomendacoes:ntext',
            'estadoCumprimento',
            'medidasMitigacaoONG:ntext',
            'medidasMitigacaoEstado:ntext',
            'userID',
        ],
    ]) ?>

</div>
