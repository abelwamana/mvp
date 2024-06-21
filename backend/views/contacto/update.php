<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Contacto $model */

$this->title = Yii::t('app', 'Editar Contacto: {name}', [
    'name' => $model->nome,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contactos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Actualizar Contacto');
?>
<div class="contacto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
