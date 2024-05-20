<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Meta $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="meta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomeMeta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipoMetaID')->textInput() ?>

    <?= $form->field($model, 'valorMeta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
