<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entidade')->dropDownList([ 'ADRA/C4' => 'ADRA/C4', 'CODESPA/C2' => 'CODESPA/C2', 'CODESPA/C4' => 'CODESPA/C4', 'COSPE/C1' => 'COSPE/C1', 'CUAMM/C2' => 'CUAMM/C2', 'CUAMM/C4' => 'CUAMM/C4', 'FEC/C2' => 'FEC/C2', 'FEC/C4' => 'FEC/C4', 'NCA/C1' => 'NCA/C1', 'UIC' => 'UIC', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
