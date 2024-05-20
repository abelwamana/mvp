<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Comuna $model */

$this->title = Yii::t('app', 'Update Comuna: {name}', [
    'name' => $model->Id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comunas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="comuna-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
