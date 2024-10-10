<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Recomendacoes $model */

$this->title = 'Editar Recomendação: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Recomendações', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="recomendacoes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
