<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Arquivo $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="arquivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'referencia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entidade')->textInput() ?>

    <?= $form->field($model, 'provinciaID')->textInput() ?>

    <?= $form->field($model, 'municipioID')->textInput() ?>

    <?= $form->field($model, 'biblioteca')->dropDownList([ 'Sim' => 'Sim', 'Não' => 'Não', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'meio_de_verificacao')->dropDownList([ 'Sim' => 'Sim', 'Não' => 'Não', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'arquivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'area')->textInput() ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tipo')->textInput() ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <?= $form->field($model, 'caminho')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'foto_da_capa')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extencao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tamanho_arquivo')->textInput() ?>

    <?= $form->field($model, 'data_upload')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
