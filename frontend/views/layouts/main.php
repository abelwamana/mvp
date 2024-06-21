<?php
/** @var \yii\web\View $this */

/** @var string $content */
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\helpers\Url;

AppAsset::register($this);
//$currentUrl = Url::to();
$currentUrl = Yii::$app->request->url;

$menuItems = [
    ['label' => 'SGI FRESAN | Camões, I.P.', 'url' => Url::to(['/site/index'])],
    ['label' => 'Missão', 'url' => Url::to(['site/missao'])],
    ['label' => 'Resultados', 'url' => Url::to(['site/resultado'])],
    ['label' => 'Galeria', 'url' => Url::to(['site/galeria'])],
    ['label' => 'Contactos', 'url' => Url::to(['site/contacto'])],
];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <!--          Google Analytics 
                <script async src="https://www.googletagmanager.com/gtag/js?id=304223682"></script>
                <script>
                    window.dataLayer = window.dataLayer || [];
                    function gtag() {
                        dataLayer.push(arguments);
                    }
                    gtag('js', new Date());
                    gtag('config', '304223682');
                </script>
                 End Google Analytics -->
        <!-- Google tag (gtag.js) -->
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-ZY6DH1JE4Z"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'G-ZY6DH1JE4Z');
        </script>
        <!-- Other head elements -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <style>
            .current-page b {
                font-weight: bold;
            }
            .minha-div {
                width: 20px; /* Largura desejada */
                height: 10px; /* Altura desejada */
                border: 1px solid black; /* Adicione uma borda para visualização */
            }
            .subscribe-btn{
                /*margin-top:20px;*/
                /*color: whitesmoke;*/
                margin-right: 1%;
                position: relative;
                margin-top: 0.6%;
                background-color: #eae018;
                border-color: #F5F5F5;
                border-radius: 15px;
                height: 20%;
                float: right;
                /*text-align: center;*/
                border: none;
                padding: 0px 5px 0px 5px;
                height: 18px;
                line-height: 0px;
                font-size: 80%;
                white-space: nowrap;
            }
            .subscribe-form{
                margin-right: 1%;
                position: relative;
                margin-top: 0.6%;
                background-color: #eae018;
                border-color: #F5F5F5;
                border-radius: 15px;
                height: 20%;

                text-align: center;
                border: none;
                padding: 0px 5px 0px 5px;
                height: 18px;
                line-height: 0px;
                font-size: 80%;
                white-space: nowrap;
            }

/*            .email{
                                color: white;
                                background-color: #999900;
                border-color: #999900;
                border-radius: 3px 3px 3px 3px;
            }*/
            @media (max-width: 1200px) { /* Define a largura máxima da tela em 600px para dispositivos móveis */

                .subscribe-btn {
                    font-size: 74%; /* Reduz o tamanho do texto para 50% */
                    float: left;
                    text-align: left;
                }
                .subscribe-form {
                    font-size: 74%; /* Reduz o tamanho do texto para 50% */

                }

            }
             .emailSubscriber {
                    width: 84%;
                    margin-left: 1%;
                    font-size: 16px;
                    width: 14%;
                    border-color: #999900 !important;
                    border-radius: 3px;
                    height: 30px !important;
                }
            @media (max-width: 510px) { /* Define a largura máxima da tela em 600px para dispositivos móveis */
                .emailSubscriber {
                    width: 32% !important;
                    /*border-color: #999900 !important;*/
                       }
            }
            
        </style> 
    </head>
    <body class="d-flex flex-column h-100">
        <?php $this->beginBody() ?>

        <!--  Menu start -->

        <!-- Header start -->


        <header id="header" class="header-one">    

            <div id="top-bar" class=" logo-area top-bar">

                <!--/ Content row end -->
            </div>

            <div class="site-navigation">
                <div class="action-style-box" style="background-color: white">
                    <div class="container">

                        <div class="row">

                            <div class="col-6">
                                <?= Html::a('<img class="logo1" style="width: 110%; height: auto;" src="images/comboio.jpg" alt="Logo FRESAN">', ['site/index']) ?>
                            </div>

                            <div class="col-6 text-right" style="padding: 20px 20px 20px 20px;">
                                <!--<button class="subscribe-btn" style="margin-right: 1%; margin-top: 4.4%;" id="subscribe-btn"><b>SUBSCREVER NEWSLATTER</b></button>-->

                                <div id="google_translate_element"></div>
                                <!--<a href="javascript:trocarIdioma('es')">PT</a>-->
                                <a class="idioma1" href="javascript:trocarIdioma('pt')" title="Português" style="font-size: 12px;">PT&nbsp;</a>
                                <a class="idioma1" href="javascript:trocarIdioma('en')" title="English" style="font-size: 12px; line-height: 5px;">EN</a>
                                <a class="idioma1" href="javascript:trocarIdioma('fr')" title="Français" style="font-size: 12px;">&nbsp;FR&nbsp;&nbsp;&nbsp;</a>
                                <!-- <a href="javascript:trocarIdioma('en')">EN</a>-->
                                <!-- <a href="javascript:trocarIdioma('pt')">FR</a>-->

                                <!-- O Javascript deve vir depois -->
                                <script type="text/javascript">
                                    var comboGoogleTradutor = null; //Varialvel global

                                    function googleTranslateElementInit() {
                                        new google.translate.TranslateElement({
                                            pageLanguage: 'pt',
                                            includedLanguages: 'en,fr,pt',
                                            layout: google.translate.TranslateElement.InlineLayout.HORIZONTAL
                                        }, 'google_translate_element');

                                        comboGoogleTradutor = document.getElementById("google_translate_element").querySelector(".goog-te-combo");
                                    }

                                    function changeEvent(el) {
                                        if (el.fireEvent) {
                                            el.fireEvent('onchange');
                                        } else {
                                            var evObj = document.createEvent("HTMLEvents");

                                            evObj.initEvent("change", false, true);
                                            el.dispatchEvent(evObj);
                                        }
                                    }

                                    function trocarIdioma(sigla) {
                                        if (comboGoogleTradutor) {
                                            comboGoogleTradutor.value = sigla;
                                            changeEvent(comboGoogleTradutor);//Dispara a troca
                                        }
                                    }
                                </script>
                                <script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

                                <?php if (Yii::$app->user->isGuest): ?>
                                    <a href="#" style="line-height: 20px; font-size: 17px;"><b><?= Html::a('<i class="fas fa-solid fa-user fa-xs" style="color: #003399;"></i><img style="width: 7%;" src="images/logo24.png" alt="marcador">', ['site/login']) ?></b></a>
                                <?php else: ?>
                                    <?= Html::a('<i class="fas fa-solid fa-user fa-xs" style="color: #003399;"></i><img style="width: 7%;" src="images/logo24.png" alt="marcador">', Yii::$app->urlManagerBackend->createUrl(['site/index']), ['style' => 'line-height: 20px; font-size: 18px; text-decoration: none; color: black;']) ?>
                                <?php endif; ?>
                            </div>

                        </div><!-- 1st row end -->

                    </div>
                </div>    

                <div class=" container">
                    <br>
                    <div class="row">
                        <!--  <form class="search-form2">
                                      
                                      <script async src="https://cse.google.com/cse.js?cx=96011e60715304fcd">
                                      </script>
                                      <div class="gcse-search"></div>
                                  </form>-->
                        <!--                       <button class="subscribe-btn" id="subscribe-btn">
                                                                    <b>SUBSCREVER NEWSLETTER</b>
                                                                </button>-->
                        <div class="col-md-12">                            
                            <nav class="menu2">
                                <ul class="active">
                                    <?php foreach ($menuItems as $item): ?>
                                        <li>
                                            <a href="<?= Url::to($item['url']) ?>"<?= ($currentUrl == Url::to($item['url']) || ($currentUrl == Yii::$app->homeUrl && $item['label'] == 'SGI FRESAN | Camões, I.P.')) ? ' class="current-page"' : '' ?>>
                                                <b style="font-size: large"><?= $item['label'] ?></b>
                                            </a>
                                        </li>
                                    <?php endforeach; ?> 
                                    <!--<div class="subscribe">-->
                                    <button class="subscribe-btn" id="subscribe-btn">
                                        <b>SUBSCREVER NEWSLETTER</b>
                                    </button>
                                    <!--</div>-->


                                </ul>
                                <div>

                                    <!-- Modal -->
                                    <div id="subscribe-modal" class="modal">
                                        <div class="modal-content">
                                            <span class="close" type="submit">&times;</span>
                                            <form id="newsletter-form" class="newsletter-form text-center" method="post">
                                                <label for="email">INSCREVA-SE NA NOSSA NEWSLETTER:</label><br>
                                                <input type="email" id="email" name="email" class="emailSubscriber" placeholder="Escreva seu email" required>
                                                <button class="subscribe-form" type="submit"><b>SUBSCREVER</b></button>
                                            </form>
                                            <p id="modal-message" class="modal-message text-center" style="display:none; margin-top: 10px;"></p>
                                        </div>
                                    </div>

                                    <script>
                                    // Script para abrir o modal
                                    document.getElementById('subscribe-btn').onclick = function () {
                                        document.getElementById('subscribe-modal').style.display = 'block';
                                    }

                                    // Script para fechar o modal
                                    document.getElementsByClassName('close')[0].onclick = function () {
                                        document.getElementById('subscribe-modal').style.display = 'none';
                                    }

                                    // Fechar o modal quando o usuário clicar fora dele
                                    window.onclick = function (event) {
                                        var modal = document.getElementById('subscribe-modal');
                                        if (event.target == modal) {
                                            modal.style.display = 'none';
                                        }
                                    }

                                    // Script para enviar o formulário via AJAX
                                    document.getElementById('newsletter-form').addEventListener('submit', function (event) {
                                        event.preventDefault(); // Evita o comportamento padrão do formulário

                                        var form = event.target;
                                        var formData = new FormData(form);

                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST', 'subscribe.php', true);

                                        xhr.onload = function () {
                                            var modalMessage = document.getElementById('modal-message');

                                            if (xhr.status >= 200 && xhr.status < 300) {
                                                modalMessage.innerHTML = xhr.responseText;
                                            } else {
                                                modalMessage.innerHTML = 'Erro: ' + xhr.responseText;
                                            }

                                            modalMessage.style.display = 'block';
                                            form.reset();
                                        };

                                        xhr.send(formData);
                                    });
                                    </script>
                                </div>

                                <a class="toggle-nav2" href="#">☰</a>

                                <!--                                <form class="search-form2">
                                                                    <input type="text">
                                                                    <button>Pesquisar</button>
                                                                </form>-->
                            </nav>
                        </div><!-- Col end -->
                    </div><!-- 2nd row end -->
                    <img style="width: 100%;" src="images/barra1.png" alt="separador">

                </div>
            </div> <!--/ Navigation end -->

        </header>
        <!--/ Header end -->

        <!-- Menu area End-->

        <!-- início Conteúdo de cada página -->
        <?= $content ?>
        <!-- fim Conteúdo de cada página -->

        <!-- Início Rodapé -->
        <div class="copyright" style="background-color: white;">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                        <?= Html::a('<img style="width: 100%;" src="images/logofoot1.png" alt="Logo FRESAN">', ['site/index']) ?>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <p class="politica1" style="font-size: 10px; text-align: justify; line-height: 13px;">
                            <br>Este Website foi produzido com o apoio financeiro da União Europeia. O seu conteúdo é da exclusiva responsabilidade dos seus autores e não reflecte necessariamente a posição da União Europeia ou envolve a expressão de qualquer opinião da parte do Camões, I.P., da Cooperação Portuguesa ou do Ministério dos Negócios Estrangeiros. Nem o Camões, I.P. ou qualquer indivíduo agindo em nome do mesmo são responsáveis pela sua utilização.
                            &copy; 2024 SGI FRESAN | <a title="Site Oficial do Instituto de Camões" href="https://www.instituto-camoes.pt/" target="_blank" style="text-decoration: underline; color: #003399blue;">Camões, I.P.</a><br><?= \yii\helpers\Html::a('Política de Privacidade', ['site/politica'], ['title' => 'Política de Privacidade', 'style' => 'text-decoration: underline; color: #003399blue;']) ?>

                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 footer-menu text-left">
                        <img class="foot1" style="width: 40%;" src="images/footicon.png" alt="separador">
                        <p class="siga1" style="font-size: 16px;">Siga-nos em:<br>
                            <a title="Site Oficial do FRESAN Angola" target="_blank" href="https://fresan-angola.org/">
                                <span class="social-icon"><i class="fas fa-globe w3-xlarge" style="color: #003399blue;"></i></span>
                            </a>
                            <a title="Página do Facebook do FRESAN Angola" target="_blank" href="https://www.facebook.com/fresan.angola">
                                <span class="social-icon"><i class="fab fa-facebook w3-xlarge" style="color: #003399blue;"></i></span>
                            </a>
                            <a title="Página do Twitter do FRESAN Angola" target="_blank" href="https://twitter.com/fresan_angola">
                                <span class="social-icon"><i class="fab fa-twitter w3-xlarge" style="color: #003399blue;"></i></span>
                            </a></p>
                    </div>
                </div><!-- Row end -->
            </div>

            <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
                <button class="btn btn-primary" title="Topo">
                    <i class="fa fa-angle-double-up"></i>
                </button>
            </div>
        </div><!-- Copyright end -->
        <!-- Fim Rodapé -->

        <?php $this->endBody() ?>
    </body>
</html>
<?php
$this->endPage();
