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

/** @var \frontend\models\ResetPasswordForm $model */
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Nova Palavra-Passe';
$this->params['breadcrumbs'][] = $this->title;
?>
<br><br>
<div class="container">
    <h3  class=" text-center"><?= Html::encode($this->title) ?></h3>

    <p class=" text-center">Por favor escreva sua nova palavra-passe:</p>

    <div class="row justify-content-center"">
        <div class="col-lg-5">
<?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <?=
            $form->field($model, 'password', [
                'inputOptions' => ['class' => 'form-control', 'id' => 'password']
            ])->label('Palavra-passe')->passwordInput(['class' => 'form-control'])
            ?>
            <button type="button" class=" senha btn btn-outline-secondary" id="toggle-password" style=""><i class="fas fa-eye"></i></button>


            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<br>
<br>
<br>
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

