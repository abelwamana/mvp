<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Finalidade $model */

$this->title = Yii::t('app', 'Update Finalidade: {name}', [
    'name' => $model->Id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Finalidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="finalidade-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
