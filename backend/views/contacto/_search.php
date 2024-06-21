<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ContactoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="contacto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'nome') ?>

    <?= $form->field($model, 'funcao') ?>

    <?= $form->field($model, 'instituicao') ?>

    <?= $form->field($model, 'contacto') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'pais') ?>

    <?php // echo $form->field($model, 'provinciaID') ?>

    <?php // echo $form->field($model, 'municipioID') ?>

    <?php // echo $form->field($model, 'comunaID') ?>

    <?php // echo $form->field($model, 'localidade') ?>

    <?php // echo $form->field($model, 'pontofocal') ?>

    <?php // echo $form->field($model, 'actividades') ?>

    <?php // echo $form->field($model, 'entidade') ?>

    <?php // echo $form->field($model, 'nivel') ?>

    <?php // echo $form->field($model, 'rotulo') ?>

    <?php // echo $form->field($model, 'observacao') ?>

    <?php // echo $form->field($model, 'privacidade') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
