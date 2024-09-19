<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Biblioteca $model */

$this->title = Yii::t('app', 'Editar Arquivo: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Biblioteca'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editar');
?>
<div class="biblioteca-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formU', [
        'model' => $model,
    ]) ?>

</div>
