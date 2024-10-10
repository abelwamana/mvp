<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\RecomendacoesSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="recomendacoes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'recomendacao') ?>

    <?= $form->field($model, 'entidade') ?>

    <?= $form->field($model, 'contexto') ?>

    <?= $form->field($model, 'problema_a_resolver') ?>

    <?php // echo $form->field($model, 'justificacao') ?>

    <?php // echo $form->field($model, 'ID_Boas_Praticas') ?>

    <?php // echo $form->field($model, 'ID_arquivo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
