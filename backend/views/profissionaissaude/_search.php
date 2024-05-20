<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ProfissionaissaudeSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="profissionaissaude-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'provinciaID') ?>

    <?= $form->field($model, 'municipioID') ?>

    <?= $form->field($model, 'comunaID') ?>

    <?= $form->field($model, 'localidadeID') ?>

    <?php // echo $form->field($model, 'nomeFormacao') ?>

    <?php // echo $form->field($model, 'NTotHoras') ?>

    <?php // echo $form->field($model, 'NSessoes') ?>

    <?php // echo $form->field($model, 'NSessoesTrimestre') ?>

    <?php // echo $form->field($model, 'ParticipantesTrimHomem') ?>

    <?php // echo $form->field($model, 'ParticipantesTrimMulher') ?>

    <?php // echo $form->field($model, 'anexo') ?>

    <?php // echo $form->field($model, 'primeiroReporte') ?>

    <?php // echo $form->field($model, 'actualizacao') ?>

    <?php // echo $form->field($model, 'respondente') ?>

    <?php // echo $form->field($model, 'entidade') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'desafiosImplementacaoONG') ?>

    <?php // echo $form->field($model, 'licoesImplementacaoONG') ?>

    <?php // echo $form->field($model, 'dataVisitaFresan') ?>

    <?php // echo $form->field($model, 'tecnicoResponsavelFresan') ?>

    <?php // echo $form->field($model, 'constatacoesFeitasFresan') ?>

    <?php // echo $form->field($model, 'recomendacoesPrincipaisFresan') ?>

    <?php // echo $form->field($model, 'medidasMitigacaoONG') ?>

    <?php // echo $form->field($model, 'medidasMitigacaoEstado') ?>

    <?php // echo $form->field($model, 'userID') ?>

    <?php // echo $form->field($model, 'estadoValidacao') ?>

    <?php // echo $form->field($model, 'criadoPor') ?>

    <?php // echo $form->field($model, 'actualizadoPor') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'UpdatedAt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
