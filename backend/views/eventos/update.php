<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Eventos $model */

$this->title = Yii::t('app', 'Update Eventos: {name}', [
    'name' => $models->Id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Eventos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $models->Id, 'url' => ['view', 'Id' => $models->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="eventos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
