<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Provincia;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var backend\models\Municipio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="municipio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomeMunicipio')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'provinciaID')->dropDownList(
            ArrayHelper::map(Provincia::find()->all(), 'Id', 'nomeProvincia'),
            ['prompt' => 'Selecione a Provincia',]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
