<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\DoccomunicacaoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="doccomunicacao-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'provinciaID') ?>

    <?= $form->field($model, 'municipioID') ?>

    <?= $form->field($model, 'primeiroReporte') ?>

    <?= $form->field($model, 'actualizacao') ?>

    <?php // echo $form->field($model, 'repondente') ?>

    <?php // echo $form->field($model, 'entidade') ?>

    <?php // echo $form->field($model, 'actividade') ?>

    <?php // echo $form->field($model, 'classificacaoDocumentoID') ?>

    <?php // echo $form->field($model, 'nomeDocumentoArtigo') ?>

    <?php // echo $form->field($model, 'areaTematica') ?>

    <?php // echo $form->field($model, 'descricaoDocumentoArtigo') ?>

    <?php // echo $form->field($model, 'audienciaProduto') ?>

    <?php // echo $form->field($model, 'qtdTotalProduto') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'dataConclusao') ?>

    <?php // echo $form->field($model, 'documentoDisponivel') ?>

    <?php // echo $form->field($model, 'documentoCumpreNormasPublicacao') ?>

    <?php // echo $form->field($model, 'documentoValidado') ?>

    <?php // echo $form->field($model, 'anexo') ?>

    <?php // echo $form->field($model, 'hiperlink') ?>

    <?php // echo $form->field($model, 'desafiosImplementacao') ?>

    <?php // echo $form->field($model, 'licoesAprendidas') ?>

    <?php // echo $form->field($model, 'dataMonitoria') ?>

    <?php // echo $form->field($model, 'tecnicoResponsavel') ?>

    <?php // echo $form->field($model, 'recomendacoes') ?>

    <?php // echo $form->field($model, 'estadoCumprimento') ?>

    <?php // echo $form->field($model, 'medidasMitigacaoONG') ?>

    <?php // echo $form->field($model, 'medidasMitigacaoEstado') ?>

    <?php // echo $form->field($model, 'userID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
