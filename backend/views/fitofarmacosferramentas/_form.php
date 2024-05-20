<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Fitofarmacosferramentas $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="fitofarmacosferramentas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'grupoID')->textInput() ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'previsaoCampanha')->textInput() ?>

    <?= $form->field($model, 'distribuido')->textInput() ?>

    <?= $form->field($model, 'unidadeID')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
