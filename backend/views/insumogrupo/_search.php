<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\InsumogrupoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="insumogrupo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'grupoID') ?>

    <?= $form->field($model, 'culturasID') ?>

    <?= $form->field($model, 'campanhaPrevisaoAbobora') ?>

    <?= $form->field($model, 'cultDistr') ?>

    <?php // echo $form->field($model, 'trimestreCulturaDistr') ?>

    <?php // echo $form->field($model, 'culturaColheita') ?>

    <?php // echo $form->field($model, 'trimestreCultColheita') ?>

    <?php // echo $form->field($model, 'destinoCultColheita') ?>

    <?php // echo $form->field($model, 'culturaBiofortificada') ?>

    <?php // echo $form->field($model, 'unidadeID') ?>

    <?php // echo $form->field($model, 'quantasVingaram') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
