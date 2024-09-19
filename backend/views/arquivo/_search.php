<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\BibliotecaSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="biblioteca-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'convite') ?>

    <?= $form->field($model, 'actividade') ?>

    <?= $form->field($model, 'organizacao') ?>

    <?= $form->field($model, 'codigo') ?>

    <?php // echo $form->field($model, 'titulo') ?>

    <?php // echo $form->field($model, 'autores') ?>

    <?php // echo $form->field($model, 'tema') ?>

    <?php // echo $form->field($model, 'descricao') ?>

    <?php // echo $form->field($model, 'classificacao') ?>

    <?php // echo $form->field($model, 'tipo') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'dataEstado') ?>

    <?php // echo $form->field($model, 'anoConcluido') ?>

    <?php // echo $form->field($model, 'numPagina') ?>

    <?php // echo $form->field($model, 'responsavelGestorUIC') ?>

    <?php // echo $form->field($model, 'usuarios') ?>

    <?php // echo $form->field($model, 'informacaoPlanilha') ?>

    <?php // echo $form->field($model, 'monitoriatemarquivo') ?>

    <?php // echo $form->field($model, 'estaNoSiteFRESANLBC') ?>

    <?php // echo $form->field($model, 'linkFresanLbc') ?>

    <?php // echo $form->field($model, 'tipo_arquivo') ?>

    <?php // echo $form->field($model, 'tamanho_arquivo') ?>

    <?php // echo $form->field($model, 'data_upload') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
