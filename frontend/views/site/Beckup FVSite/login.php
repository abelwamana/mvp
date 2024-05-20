<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZY6DH1JE4Z"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ZY6DH1JE4Z');
</script>

<br><br>
<div class="site-login">
    <h1 class=" text-center"><?= Html::encode($this->title) ?></h1>

    <p class=" text-center">Por favor preencha os seguintes campos para efectuar o login:</p>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->label('Utilizador')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->label('Palavra-passe')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->label('Lembrar-me')->checkbox() ?>

              <!--  <div class="my-1 mx-0" style="color:#999;">
                    Se esqueceu da palavra passe pode <?= Html::a('Restabelecer', ['site/request-password-reset']) ?>.
                    <br>
                    Reenviar código de verificação? <?= Html::a('Reenviar', ['site/resend-verification-email']) ?>
                </div> -->

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<br>