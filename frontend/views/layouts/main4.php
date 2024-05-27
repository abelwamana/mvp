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
        <style>
            .minha-div {
                width: 20px; /* Largura desejada */
                height: 10px; /* Altura desejada */
                border: 1px solid black; /* Adicione uma borda para visualização */
            }
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0,0,0);
                background-color: rgba(0,0,0,0.4);
                padding-top: 60px;
            }

            .modal-content {
                background-color: #fefefe;
                margin: 5% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }
        </style>
        <?php $this->head() ?>
        <style type="text/css">

            /*            #google_translate_element {
                            display: none;
                        }
                        .goog-te-banner-frame {
                            display: none !important;
                        }
                        body {
                            position: static !important;
                            top: 0 !important;
                        }
                        #google_translate_element {
                            display: none;
                        }
                        body > .skiptranslate > iframe.skiptranslate {
                            display: none !important;
                            visibility: hidden !important;
                        }*/

            .current-page b {
                font-weight: bold;
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

                                <a href="?r=site/index"><img style="width: 185%;" src="images/logo221.png"></a>
                            </div>

                            <div class="col-6 text-right">

                                <?php if (Yii::$app->user->isGuest): ?>
                                    <a href="#" style="line-height: 20px; font-size: 17px;"><b><?= Html::a('Área de Membro', ['site/login']) ?></b></a><img style="width: 7%;" src="images/logo24.png"><br>
                                <?php else: ?>
                                    <?= Html::a('<b>Área de Membro</b><img style="width: 7%;" src="images/logo24.png">', Yii::$app->urlManagerBackend->createUrl(['site/index']), ['style' => 'line-height: 20px; font-size: 18px; text-decoration: none; color: black;']) ?>
                                    <!--<a href="#" style="line-height: 20px; font-size: 17px;"><b><?= Html::a('Sair', ['site/logout'], ['data-method' => 'post']) ?></b></a><img style="width: 7%;" src="images/logo24.png"><br>-->
                                <?php endif; ?>
                                <div style="height: 20px;">  
                                    <div id="google_translate_element" <!--class="boxTradutor"-->></div>
                                    <!--<a href="javascript:trocarIdioma('es')">PT</a>-->
                                    <a href="javascript:trocarIdioma('pt')" title="Português" style="font-size: 12px;">PT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
                                    <a href="javascript:trocarIdioma('en')" title="English" style="font-size: 12px; line-height: 5px;">EN </a>
                                    <a href="javascript:trocarIdioma('fr')" title="Français" style="font-size: 12px;">&nbsp;&nbsp;&nbsp;&nbsp;FR&nbsp;</a>
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

                                </div>
                                <div>

                                    <button id="subscribe-btn">Inscrever-se</button>

                                    <!-- Modal -->
                                    <div id="subscribe-modal" class="modal">
                                        <div class="modal-content">
                                            <span class="close">&times;</span>
                                            <form id="newsletter-form" method="post">
                                                <label for="email">Inscreva-se na nossa newsletter:</label>
                                                <input type="email" id="email" name="email" required>
                                                <button type="submit">Enviar</button>
                                            </form>
                                            <p id="modal-message" style="display:none;"></p>
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
                                                                                };

                                                                                xhr.send(formData);
                                                                            });
                                    </script>
                                </div>
                            </div>
                        </div><!-- 1st row end -->
                    </div>
                </div>    

                <div class=" container">
                    <div class="row">
                        <div class="col-md-12">

                            <nav class="menu2">
                                <ul class="active">
                                    <?php foreach ($menuItems as $item): ?>
                                        <li>
                                            <a href="<?= Url::to($item['url']) ?>"<?= ($currentUrl == Url::to($item['url']) || ($currentUrl == Yii::$app->homeUrl && $item['label'] == 'SGI FRESAN | Camões, I.P.')) ? ' class="current-page"' : '' ?>>
                                                <b><?= $item['label'] ?></b>
                                            </a>
                                        </li>
                                    <?php endforeach; ?> </ul>

                                <a class="toggle-nav2" href="#">☰</a>

<!--                                <form class="search-form2" action="<?= Url::to(['site/search-results']) ?>" method="get">
                                    <input type="text" name="query" placeholder="Digite sua busca...">
                                    <button type="submit">Pesquisar</button>
                                </form>-->
                            </nav>
                        </div><!-- Col end -->
                    </div><!-- 2nd row end -->
                    <img style="width: 100%;" src="images/barra1.png">

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
                        <a href="?r=site/index"><img style="width: 100%;" src="images/logofoot1.png"></a>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <p style="font-size: 10px; text-align: justify; line-height: 13px;">
                            <br><br>Este Website foi produzido com o apoio financeiro da União Europeia. O seu conteúdo é da exclusiva responsabilidade dos seus autores e não reflecte necessariamente a posição da União Europeia ou envolve a expressão de qualquer opinião da parte do Camões, I.P., da Cooperação Portuguesa ou do Ministério dos Negócios Estrangeiros. Nem o Camões, I.P. ou qualquer indivíduo agindo em nome do mesmo são responsáveis pela sua utilização.
                            &copy; 2024 SGI FRESAN |<a title="Site Oficial do Instituto de Camões" href="https://www.instituto-camoes.pt/" target="_blank" style="text-decoration: underline; color: darkblue;">Camões, I.P.</a><br><br><?= \yii\helpers\Html::a('Política de Privacidade', ['site/politica'], ['title' => 'Política de Privacidade', 'style' => 'text-decoration: underline; color: darkblue;']) ?>

                    </div>

                    <div class="col-xl-2 col-lg-2 col-md-2 col-sm-12 footer-menu text-left">
                        <br>
                        <img style="width: 50%;" src="images/footicon.png">
                        <b style="font-size: 16px;"><br>Siga-nos em:<br></b>
                        <a title="Site Oficial do FRESAN Angola" target="_blank" href="https://fresan-angola.org/">
                            <span class="social-icon"><i class="fas fa-globe w3-xlarge" style="color: darkblue;"></i></span>
                        </a>
                        <a title="Página do Facebook do FRESAN Angola" target="_blank" href="https://www.facebook.com/fresan.angola">
                            <span class="social-icon"><i class="fab fa-facebook w3-xlarge" style="color: darkblue;"></i></span>
                        </a>
                        <a title="Página do Twitter do FRESAN Angola" target="_blank" href="https://twitter.com/fresan_angola">
                            <span class="social-icon"><i class="fab fa-twitter w3-xlarge" style="color: darkblue;"></i></span>
                        </a>
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
