<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Insumogrupo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="insumogrupo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grupoID')->textInput() ?>

    <?= $form->field($model, 'culturasID')->textInput() ?>

    <?= $form->field($model, 'campanhaPrevisaoAbobora')->textInput() ?>

    <?= $form->field($model, 'cultDistr')->textInput() ?>

    <?= $form->field($model, 'trimestreCulturaDistr')->textInput() ?>

    <?= $form->field($model, 'culturaColheita')->textInput() ?>

    <?= $form->field($model, 'trimestreCultColheita')->textInput() ?>

    <?= $form->field($model, 'destinoCultColheita')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'culturaBiofortificada')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unidadeID')->textInput() ?>

    <?= $form->field($model, 'quantasVingaram')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
