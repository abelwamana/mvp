<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Boaspraticas $model */

$this->title = 'Editar Boas Práticas: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Boaspraticas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="boaspraticas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'provinciasList' => $provinciasList,
    ]) ?>

</div>
