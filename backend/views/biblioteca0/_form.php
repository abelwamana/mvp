<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Biblioteca $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="biblioteca-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nome_arquivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_arquivo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tamanho_arquivo')->textInput() ?>

    <?= $form->field($model, 'data_upload')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
