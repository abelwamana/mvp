<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Demostracoesculinarias $model */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Demostracoesculinarias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="demostracoesculinarias-view">

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
            'comunaID',
            'localidadeID',
            'nDemostracaoCulinaria',
            'nDemostracaoCulinariaTrimestre',
            'beneficiariosDemoCuliHomem',
            'beneficiariosDemoCuliMulher',
            'anexoEvidenciaDemonsCulinaria',
            'primeiroReporte',
            'actualizacao',
            'respondente',
            'entidade',
            'latitude',
            'longitude',
            'desafiosImplementacaoONG:ntext',
            'licoesImplementacaoONG:ntext',
            'dataVisitaFresan',
            'tecnicoResponsavelFresan',
            'constatacoesFeitasFresan',
            'recomendacoesPrincipaisFresan:ntext',
            'medidasMitigacaoONG',
            'medidasMitigacaoEstado',
            'nomeGrupoID',
            'userID',
            'estadoValidacao',
            'criadoPor',
            'actualizadoPor',
            'createdAt',
            'UpdatedAt',
        ],
    ]) ?>

</div>
