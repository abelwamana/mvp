<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Profissionaissaude $model */

$this->title = Yii::t('app', 'Update Profissionaissaude: {name}', [
    'name' => $models->Id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profissionaissaudes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $models->Id, 'url' => ['view', 'Id' => $models->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="profissionaissaude-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
