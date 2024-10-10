<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ArquivoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="arquivo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'referencia') ?>

    <?= $form->field($model, 'entidade') ?>

    <?= $form->field($model, 'provinciaID') ?>

    <?= $form->field($model, 'municipioID') ?>

    <?php // echo $form->field($model, 'biblioteca') ?>

    <?php // echo $form->field($model, 'meio_de_verificacao') ?>

    <?php // echo $form->field($model, 'arquivo') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'descricao') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'ano') ?>

    <?php // echo $form->field($model, 'caminho') ?>

    <?php // echo $form->field($model, 'foto_da_capa') ?>

    <?php // echo $form->field($model, 'tipo_arquivo') ?>

    <?php // echo $form->field($model, 'tamanho_arquivo') ?>

    <?php // echo $form->field($model, 'data_upload') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
