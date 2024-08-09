<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/** @var yii\web\View $this */
/** @var backend\models\Contacto $model */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contactos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contacto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'Id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Eliminar'), ['delete', 'Id' => $model->Id], [
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
            'nome',
            'funcao',
            'instituicao',
            'contacto',
            'email:email',
            'pais',
            [
                'attribute' => 'provinciaID',
                 'value' => function ($model) {
                        return $model->provincia ? $model->provincia->nomeProvincia : '';
                    },
            ],
            [
                'attribute' => 'municipioID',
                'value' => function ($model) {
                        return $model->municipio ? $model->municipio->nomeMunicipio : '';
                    },
            ],
            [
                'attribute' => 'comunaID',
                 'value' => function ($model) {
                        return $model->comuna ? $model->comuna->nomeComuna : '';
                    },
            ],
            'localidade',
            'pontofocal',
            'actividades',
            'entidade',
            'nivel',
            'rotulo',
            'observacao:ntext',
            'estado',
        ],
    ]) ?>

</div>
