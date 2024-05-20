<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Contacto $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contacto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'funcaoID')->textInput() ?>

    <?= $form->field($model, 'instituicao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'e-mail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provinciaID')->textInput() ?>

    <?= $form->field($model, 'municipioID')->textInput() ?>

    <?= $form->field($model, 'comunaID')->textInput() ?>

    <?= $form->field($model, 'localidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pontofocal')->textInput() ?>

    <?= $form->field($model, 'actividades')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nivel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rotulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'privacidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
