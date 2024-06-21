<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\EventSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'summary') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'area') ?>

    <?= $form->field($model, 'start') ?>

    <?php // echo $form->field($model, 'end') ?>

    <?php // echo $form->field($model, 'duracao') ?>

    <?php // echo $form->field($model, 'provinciaID') ?>

    <?php // echo $form->field($model, 'municipioID') ?>

    <?php // echo $form->field($model, 'comunaID') ?>

    <?php // echo $form->field($model, 'local') ?>

    <?php // echo $form->field($model, 'coordenadas') ?>

    <?php // echo $form->field($model, 'entidadeOrganizadora') ?>

    <?php // echo $form->field($model, 'convocadoPor') ?>

    <?php // echo $form->field($model, 'participantes') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
