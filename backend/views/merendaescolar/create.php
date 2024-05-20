<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Merendaescolar $model */

$this->title = Yii::t('app', 'Create Merendaescolar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Merendaescolars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merendaescolar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
