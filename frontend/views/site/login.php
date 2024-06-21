<style>
    .senha{
        border: 0;
        margin-top: -19.1%;
        margin-left: 90%;
        position: relative;
        z-index: 2;
        padding: 0px 5px 0px 5px;
    }

    /*@media screen and (max-width: 1200px) {
    .senha{
                margin-top: -15.1% !important;            
            }
    }
    
    @media screen and (max-width: 990px) {
    .senha{
                margin-top: 5% !important;            
            }
    }
    
    
    @media screen and (min-width: 500px) {
    .senha{
                margin-top: -45% !important;            
            }
    }
    @media screen and (min-width: 768px) {
    .senha{
                margin-top: -45%;            
            }
    }*/

    /* Extra small devices (phones, 600px and down) */
    @media only screen and (min-width: 500px) {
        .senha{
            margin-top: -25.1%;
        }

    }
    @media only screen and (min-width: 550px) {
        .senha{
            margin-top: -22.1%;
        }

    }

    /* Small devices (portrait tablets and large phones, 600px and up) */
    @media only screen and (min-width: 600px) {

        .senha{
            margin-top: -20.1%;
        }
    }

    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (min-width: 768px) {

        .senha{
            margin-top: -16.1%;
        }
    }/*
    
     Large devices (laptops/desktops, 992px and up) 
    */
    @media only screen and (min-width: 992px) {

        .senha{
            margin-top: -30.1%;
        }
    }/*
    
     Extra large devices (large laptops and desktops, 1200px and up) 
    */
    @media only screen and (min-width: 1200px) {

        .senha{
            margin-top: -22.1%;
        }
    }

    @media only screen and (min-width: 1500px) {

        .senha{
            margin-top: -18.1%;
        }
    }


</style>

<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
$description = 'Login da plataforma privada do SGI FRESAN Camões I.P.';
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
<div class="container">
    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

    <p class="text-center">Por favor preencha os seguintes campos para efectuar o login:</p>

    <div class="row justify-content-center">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->label('Utilizador')->textInput(['autofocus' => true]) ?>

               <?=
            $form->field($model, 'password', [
                'inputOptions' => ['class' => 'form-control', 'id' => 'password']
            ])->label('Palavra-passe')->passwordInput(['class' => 'form-control'])
            ?>
            <button type="button" class=" senha btn btn-outline-secondary" id="toggle-password" style=""><i class="fas fa-eye"></i></button>

            <div style="margin-left: 8px;"> <?= $form->field($model, 'rememberMe')->label('Lembrar-me')->checkbox() ?></div>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <div class="my-1 mx-0" style="margin-left:-2px !important; color:#999900;">
                    <?= Html::a('Recuperar/Redefinir Palavra-passe', ['user/request-password-reset']) ?>.
                    <br>
                    <!-- Reenviar código de verificação? <?= Html::a('Reenviar', ['user/resend-verification-email']) ?>-->
                </div> 

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var togglePasswordButton = document.getElementById('toggle-password');
    var passwordInput = document.getElementById('password');

    togglePasswordButton.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePasswordButton.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            passwordInput.type = 'password';
            togglePasswordButton.innerHTML = '<i class="fas fa-eye"></i>';
        }
    });
});
</script>
