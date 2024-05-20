<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var backend\models\Localidade $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="localidade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomeLocalidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comunaID')->dropDownList(
            ArrayHelper::map(backend\models\Comuna::find()->all(), 'Id', 'nomeComuna'),
            ['prompt' => 'Selecione a Comuna',]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
