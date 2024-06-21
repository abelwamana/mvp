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
                'value' => $model->provincia->nomeProvincia,
            ],
            [
                'attribute' => 'municipioID',
                'value' => $model->municipio->nomeMunicipio,
            ],
            [
                'attribute' => 'comunaID',
                'value' => $model->comuna->nomeComuna,
            ],
            'localidade',
            'pontofocal',
            'actividades',
            'entidade',
            'nivel',
            'rotulo',
            'observacao:ntext',
            'privacidade',
            'estado',
        ],
    ]) ?>

</div>
