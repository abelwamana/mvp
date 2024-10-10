<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Recomendacoes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="recomendacoes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estrategia')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'entidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <?= $form->field($model, 'fotografia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ID_recomendacoes')->textInput() ?>

    <?= $form->field($model, 'ID_boas_praticas')->textInput() ?>

    <?= $form->field($model, 'ID_arquivo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
