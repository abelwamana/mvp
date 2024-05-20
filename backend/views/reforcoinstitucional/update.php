<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Reforcoinstitucional $model */

$this->title = Yii::t('app', 'Update Reforcoinstitucional: {name}', [
    'name' => $models->Id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reforcoinstitucionals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $models->Id, 'url' => ['view', 'Id' => $models->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="reforcoinstitucional-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
