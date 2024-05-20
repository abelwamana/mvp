<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\EventosSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="eventos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'primeiroReporte') ?>

    <?= $form->field($model, 'actualizacao') ?>

    <?= $form->field($model, 'respondente') ?>

    <?= $form->field($model, 'entidade') ?>

    <?php // echo $form->field($model, 'provinciaID') ?>

    <?php // echo $form->field($model, 'municipioID') ?>

    <?php // echo $form->field($model, 'descricaoTema') ?>

    <?php // echo $form->field($model, 'estadoDescricao') ?>

    <?php // echo $form->field($model, 'parceiro') ?>

    <?php // echo $form->field($model, 'dataRelacionadaEstadForum') ?>

    <?php // echo $form->field($model, 'tematicaAbordada') ?>

    <?php // echo $form->field($model, 'orador') ?>

    <?php // echo $form->field($model, 'localLink') ?>

    <?php // echo $form->field($model, 'publicoAlvo') ?>

    <?php // echo $form->field($model, 'participantesHomem') ?>

    <?php // echo $form->field($model, 'participantesMulher') ?>

    <?php // echo $form->field($model, 'anexoForum') ?>

    <?php // echo $form->field($model, 'desafiosONG') ?>

    <?php // echo $form->field($model, 'licoesONG') ?>

    <?php // echo $form->field($model, 'dataVisitaFresan') ?>

    <?php // echo $form->field($model, 'tecnicoResponsavelFresan') ?>

    <?php // echo $form->field($model, 'constantacoeFeitasFresan') ?>

    <?php // echo $form->field($model, 'recomendacoes') ?>

    <?php // echo $form->field($model, 'medidasMitigacaoONG') ?>

    <?php // echo $form->field($model, 'medidasMitigacaoEstado') ?>

    <?php // echo $form->field($model, 'userID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
