<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\PasswordResetRequestForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Recuperar/Redefinir Palavra-Passe';
$this->params['breadcrumbs'][] = $this->title;
?>
<br><br><br>
<div class="container">
    <h3  class=" text-center"><?= Html::encode($this->title) ?></h3>

    <p class=" text-center">Será enviado para o email associado à sua conta o link para redefinir a palavra-passe.</p>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->label('')->textInput(['placeholder' => 'Escreva aqui o seu email'],['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                </div>
            <br><br><br>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<br>
<br>
