<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Unidade $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="unidade-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'unidade')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
