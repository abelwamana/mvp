<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BoaspraticasSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="boaspraticas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'boapratica') ?>

    <?= $form->field($model, 'justificacao') ?>

    <?= $form->field($model, 'area') ?>

    <?= $form->field($model, 'provinciaID') ?>

    <?php // echo $form->field($model, 'municipioID') ?>

    <?php // echo $form->field($model, 'comunaID') ?>

    <?php // echo $form->field($model, 'localidade') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'entidadepropoente') ?>

    <?php // echo $form->field($model, 'entidadeimplementadora') ?>

    <?php // echo $form->field($model, 'fotografia') ?>

    <?php // echo $form->field($model, 'recomendacoesID') ?>

    <?php // echo $form->field($model, 'estrategia_de_sustentabilidadeID') ?>

    <?php // echo $form->field($model, 'arquivoID') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
