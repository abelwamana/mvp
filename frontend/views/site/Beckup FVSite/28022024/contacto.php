<?php

/** @var yii\web\View $this */
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

?>
<div class="container">
    <div class="banner-carousel banner-carousel-1 mb-0" style="height: 200px;">
        <div class="banner-carousel-item" style="background-image:url(images/contacto/banner.png)">
            <div class="slider-content text-left">
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-md-12">
                            <div class="row text-center">
                                <div class="col-12">
                                    <h3 class="section-sub-title" style="color: white !important;">Entre em contacto</h3>
                                </div>
                            </div>
                            / Title row end             
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
                        <p style="color: #919739;" class="notranslate">Cunene - Ondjiva<br>(+244) 940 819 616</p>
                        <p style="color: #919739;" class="notranslate">Huíla - Lubango<br>(+244) 929 680 377</p>
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
                <h3 class="column-title">Deixe a sua mensagem</h3>
                <!-- contact form works with formspree.io  -->
                <!-- contact form activation doc: https://docs.themefisher.com/constra/contact-form/ -->
                <!--        <form id="contact-form" action="#" method="post" role="form" style="background-color: whitesmoke;">
                          <div class="error-container"></div>
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Nome</label>
                                <input class="form-control form-control-name" name="name" id="name" placeholder="" type="text" required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>E-mail</label>
                                <input class="form-control form-control-email" name="email" id="email" placeholder="" type="email"
                                  required>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <label>Assunto</label>
                                <input class="form-control form-control-subject" name="subject" id="subject" placeholder="" required>
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Mensagem</label>
                            <textarea class="form-control form-control-message" name="message" id="message" placeholder="" rows="10"
                              required></textarea>
                          </div>
                          <div class="text-right"><br>
                              
                            <button class="btn btn-primary solid blank" type="submit">Enviar</button>
                          </div>
                          
                        </form>-->

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
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
<?php ActiveForm::end(); ?>
            </div>

        </div><!-- Content row -->
    </div><!-- Conatiner end -->
</section><!-- Main container end -->

