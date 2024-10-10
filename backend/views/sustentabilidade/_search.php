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

    <?= $form->field($model, 'estrategia') ?>

    <?= $form->field($model, 'entidade') ?>

    <?= $form->field($model, 'ano') ?>

    <?= $form->field($model, 'fotografia') ?>

    <?php // echo $form->field($model, 'documento') ?>

    <?php // echo $form->field($model, 'ID_recomendacoes') ?>

    <?php // echo $form->field($model, 'ID_boas_praticas') ?>

    <?php // echo $form->field($model, 'ID_arquivo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
