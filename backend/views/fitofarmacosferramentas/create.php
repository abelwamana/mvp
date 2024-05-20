<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Fitofarmacosferramentas $model */

$this->title = Yii::t('app', 'Create Fitofarmacosferramentas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fitofarmacosferramentas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fitofarmacosferramentas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
