<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var backend\models\Comuna $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="comuna-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomeComuna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'municipioID')->dropDownList(
            ArrayHelper::map(\backend\models\Municipio::find()->all(), 'Id', 'nomeMunicipio'),
            ['prompt' => 'Selecione o Município',]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
