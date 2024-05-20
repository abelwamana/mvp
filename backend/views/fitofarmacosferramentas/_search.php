<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\FitofarmacosferramentasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="fitofarmacosferramentas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'grupoID') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'previsaoCampanha') ?>

    <?= $form->field($model, 'distribuido') ?>

    <?php // echo $form->field($model, 'unidadeID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
