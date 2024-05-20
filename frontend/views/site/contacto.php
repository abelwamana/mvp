<?php

/** @var yii\web\View $this */
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contactos';
$description = 'Contactos Fresan Camões I.P.';
?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZY6DH1JE4Z"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-ZY6DH1JE4Z');
</script>

<!--<div class="container">
    <div class="row">
        <div class="col-md-12">
            <nav class="menu2">
                <a class="toggle-nav2" href="#">&#9776;</a>
                <form class="search-form2">
                    <input type="text">
                    <button>Pesquisar</button>
                </form>
            </nav>
        </div> Col end 
    </div> 2nd row end 
    <img style="width: 100%;" src="images/barra1.png">
</div>-->

<div class="container">
  <div class="banner-carousel banner-carousel-1 mb-0" style="height: 200px;">
    <div class="banner-carousel-item" style="background-image:url(images/contacto/banner.png)">
      <div class="slider-content text-left">
        <div class="container">
            <div class="row align-items-center">
            <div class="col-md-12">
              <div class="row text-center">
                <div class="col-12">
                <br><br><br><br><h3 class="section-sub-title slide-title-box" style="color: white !important;">Entre em contacto</h3>
                </div>
            </div>
    <!--/ Title row end -->            
          </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<section id="main-container" class="main-container">
    <div class="container" style="background-color: white;">
        <br>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="ts-service-box-bg text-center h-100">
                    <br>
                    <span class="ts-service-icon icon-round">
                        <i class="fas fa-map-marker-alt mr-0"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4 style="color: #919739;">Escritórios</h4>
                        <p style="color: #919739;" class="notranslate"><b>Sede - </b>Huíla - Lubango<br>(+244) 929 680 377</p>
                        <p style="color: #919739;" class="notranslate">Cunene - Ondjiva<br>(+244) 940 819 616</p>
                        <p style="color: #919739;" class="notranslate">Namibe - Moçâmedes<br>(+244) 926 949 493</p>
                    </div>
                </div>
            </div><!-- Col 1 end -->

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="ts-service-box-bg text-center h-100">
                    <br>
                    <span class="ts-service-icon icon-round">
                        <i class="fa fa-envelope mr-0"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4 style="color: #919739;">E-mail</h4>
                        <p style="color: #919739;" class="notranslate">geral.fresan@gmail.com</p>
                    </div>
                </div>
            </div><!-- Col 2 end -->

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="ts-service-box-bg text-center h-100">
                    <br>
                    <span class="ts-service-icon icon-round">
                        <i class="fas fa-globe"></i>
                    </span>
                    <div class="ts-service-box-content">
                        <h4 style="color: #919739;">Acompanhe as Nossas Actividades</h4>
                        <a title="Site Oficial do FRESAN" target="_blank" href="https://fresan-angola.org/"><p style="color: darkblue;"><u>Em FRESAN Angola</u></p></a>
                    </div>
                </div>
            </div><!-- Col 3 end -->

        </div><!-- 1st row end -->

        <div class="gap-60"></div>

        <div class="row">
            <div class="col-md-12">
                
                <?= Html::img('logo2.jpeg');?>
                <h3 class="column-title">Deixe a sua mensagem</h3>
                <!-- contact form works with formspree.io  -->
                <!-- contact form activation doc: https://docs.themefisher.com/constra/contact-form/ -->
    

                <?php if (Yii::$app->session->hasFlash('sucesso')): ?>
                    <div class="alert alert-success">
                        <?= Yii::$app->session->getFlash('sucesso') ?>
                    </div>
                <?php endif; ?>
                <?php if (Yii::$app->session->hasFlash('erro')): ?>
                    <div class="alert alert-danger">
                        <?= Yii::$app->session->getFlash('erro') ?>
                    </div>
                <?php endif; ?>
                
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <?= $form->field($model, 'name')->label('Nome')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email')->label('E-mail') ?>

                <?= $form->field($model, 'subject')->label('Assunto') ?>

                <?= $form->field($model, 'body')->label('Mensagem')->textarea(['rows' => 6]) ?>

                <?=
                $form->field($model, 'verifyCode')->label('Código de Verificação')->widget(Captcha::class, [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ])
                ?>

                <div class="form-group">
                <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
<?php ActiveForm::end(); ?>
            </div>

        </div><!-- Content row -->
    </div><!-- Conatiner end -->
</section><!-- Main container end -->

