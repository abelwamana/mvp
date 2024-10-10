<?php

use yii\helpers\Html;

$this->title = 'SGI FRESAN | Camões, I.P.';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mapa do Google</title>

        <style>
            .w3-bar{
                width:100%;
                overflow:hidden
            }
            .w3-bar .w3-bar-item{
                padding:8px 16px;
                float:left;
                width:auto;
                border:none;
                display:block;
                outline:0
            }

            .w3-bar .w3-button{
                white-space:normal
            }

            .w3-red,.w3-hover-red:hover{
                color:#fff!important;
                background-color:#999900!important
            }

            .container10 {
                background-color: whitesmoke;
                padding: 16px;
                margin: 16px 0
            }

            .container10::after {
                content: "";
                clear: both;
                display: table;
            }

            .container10 img {
                float: left;
                margin-right: 20px;
            }

            .container10 span {
                font-size: 20px;
                margin-right: 15px;
            }

            @media (max-width: 500px) {
                .container10 {
                    text-align: center;
                }
                .container10 img {
                    margin: auto;
                    float: none;
                    display: block;
                }
            }
            .btn{
                margin-left: 5px;
                color: #919733;
                border-color: #919733;
                background-color: transparent;
                border-radius: 4px 4px 4px 4px;
                height:30px;
                padding: 2px 3px;
                float: right; /* Posiciona o botão à direita */
            }
            .btn:hover {
                color: white; /* Cor do texto ao passar o mouse */
                background-color: #919733; /* Cor de fundo ao passar o mouse */
                border-color: #919733; /* Cor da borda ao passar o mouse */
            }
        </style>
    </head>
    <body>

        <section class="container" style="background-color: white">
            <h3 class="section-sub-title" style="text-align: center !important;"><b>BOAS PRÁTICAS | FRESAN/Camões, I.P.</b></h3>
            <br>
            <div style="border-style: solid; border-color: #999900; border-width: 1.5px">
                 <p style="text-align: center">Na funcionalidade "Boas Práticas" encontra-se sistematizado um conjunto de <b>práticas inovadoras</b> que demonstram <b>potencial para o fortalecimento da resiliência e para a promoção da segurança alimentar e nutricional</b> no quadro do Programa FRESAN. Esta identificação e divulgação tem como propósito o reforço da dimensão de aprendizagem do Programa FRESAN. O esforço inicia-se numa fase em que o Programa se encontra perto da sua conclusão, ou seja, quando os resultados se tornam visíveis. A funcionalidade é dinâmica, no sentido em que se encontra em permanente actualização, e conta, na sua alimentação, com o apoio das instituições parceiras responsáveis pela implementação. Este conjunto de Boas Práticas constitui um dos legados importantes do Programa FRESAN para o futuro. A sua divulgação poderá alimentar o processo de formulação de novos programas ou acções a desenvolver no futuro, em Angola ou noutras localizações.
                </p>            </div>
        </section>
        <br>

        <div class="container">
            <div class="container">
                <div class="w3-bar" style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <button class="w3-bar-item w3-button tablink w3-red" onclick="openCity(event, 'agricultura')">Agricultura</button>
                        <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'nutricao')">Nutrição</button>
                        <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'agua')">Água</button>
                        <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'reforco')">Reforço Institucional</button>
                        <button class="w3-bar-item w3-button tablink" onclick="openCity(event, 'outras')">Outras</button>
                    </div>
                    <?= Html::a(Yii::t('app', '<i class="fas fa-plus"></i> Adicionar'), ['create'], ['class' => 'btn btn-secundary']) ?>
                </div>
            </div>


            <!-- Bloco Agricultura -->

            <div id="agricultura" class="container10 w3-container w3-border city">
                <?php foreach ($boaspraticas as $boapratica): ?>
                    <?php if (strpos($boapratica->area, 'Agricultura') !== false): ?>
                        <div>                            
                            <img src="/admin/images/boaspraticas/<?= $boapratica->fotografia ?>" alt="Boa Prática" style="width:50%">
                            <p style="color: #999900"><b><?= $boapratica->boapratica ?></b></p>
                            <p style="color: #999900">
                                Fonte: <?= $boapratica->entidadepropoente ?><br>
                                Entidade(s): <?= $boapratica->entidadeimplementadora ?><br>
                                 <?php
                                $localizacao = [];
                                if (!empty($boapratica->longitude)) {
                                    $localizacao[] = $boapratica->longitude;
                                }
                                if (!empty($boapratica->latitude)) {
                                    $localizacao[] = $boapratica->latitude;
                                }
                                if (!empty($boapratica->localidade)) {
                                    $localizacao[] = $boapratica->localidade;
                                }
                                if (!empty($boapratica->comuna)) {
                                    $localizacao[] = $boapratica->comuna->nomeComuna;
                                }

                                if (!empty($boapratica->municipio)) {
                                    $localizacao[] = $boapratica->municipio->nomeMunicipio;
                                }

                                if (!empty($boapratica->provincia)) {
                                    $localizacao[] = $boapratica->provincia->nomeProvincia;
                                }
                                ?>
                                Localização: <?= implode(', ', $localizacao) ?>  <br>
                                Área(s) de Intervenção: <?= $boapratica->area ?>
                            </p>
                            <p style="text-align: justify"><?= $boapratica->justificacao ?>  <?= Html::a(Yii::t('app', '<i class="fas fa-edit"></i> Editar'), ['update', 'Id' => $boapratica->Id], ['class' => 'btn btn-primary']) ?></p>

                            <?php if (strlen($boapratica->justificacao) < 358): ?>
                                <br><br><br><br>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Bloco Nutrição -->
            <div id="nutricao" class="container10 w3-container w3-border city" style="display:none">
                <?php foreach ($boaspraticas as $boapratica): ?>
                    <?php if (strpos($boapratica->area, 'Nutrição') !== false): ?>
                        <div>                            
                            <img src="/admin/images/boaspraticas/<?= $boapratica->fotografia ?>" alt="Boa Prática" style="width:50%">
                            <p style="color: #999900"><b><?= $boapratica->boapratica ?></b></p>
                            <p style="color: #999900">
                                Fonte: <?= $boapratica->entidadepropoente ?><br>
                                Entidade(s): <?= $boapratica->entidadeimplementadora ?><br>
                                 <?php
                                $localizacao = [];
                                if (!empty($boapratica->longitude)) {
                                    $localizacao[] = $boapratica->longitude;
                                }
                                if (!empty($boapratica->latitude)) {
                                    $localizacao[] = $boapratica->latitude;
                                }
                                if (!empty($boapratica->localidade)) {
                                    $localizacao[] = $boapratica->localidade;
                                }
                                if (!empty($boapratica->comuna)) {
                                    $localizacao[] = $boapratica->comuna->nomeComuna;
                                }

                                if (!empty($boapratica->municipio)) {
                                    $localizacao[] = $boapratica->municipio->nomeMunicipio;
                                }

                                if (!empty($boapratica->provincia)) {
                                    $localizacao[] = $boapratica->provincia->nomeProvincia;
                                }
                                ?>
                                Localização: <?= implode(', ', $localizacao) ?>  <br>
                                Área(s) de Intervenção: <?= $boapratica->area ?>
                            </p>
                            <p style="text-align: justify"><?= $boapratica->justificacao ?> <?= Html::a(Yii::t('app', '<i class="fas fa-edit"></i> Editar'), ['update', 'Id' => $boapratica->Id], ['class' => 'btn btn-primary']) ?></p>

                            <?php if (strlen($boapratica->justificacao) < 358): ?>
                                <br><br><br><br>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Bloco Nutrição -->
            <div id="agua" class="container10 w3-container w3-border city" style="display:none">
                <?php foreach ($boaspraticas as $boapratica): ?>
                    <?php if (strpos($boapratica->area, 'Água') !== false): ?>
                        <div>                            
                            <img src="/admin/images/boaspraticas/<?= $boapratica->fotografia ?>" alt="Boa Prática" style="width:50%">
                            <p style="color: #999900"><b><?= $boapratica->boapratica ?></b></p>
                            <p style="color: #999900">
                                Fonte: <?= $boapratica->entidadepropoente ?><br>
                                Entidade(s): <?= $boapratica->entidadeimplementadora ?><br>
                                <?php
                                $localizacao = [];
                                if (!empty($boapratica->longitude)) {
                                    $localizacao[] = $boapratica->longitude;
                                }
                                if (!empty($boapratica->latitude)) {
                                    $localizacao[] = $boapratica->latitude;
                                }
                                if (!empty($boapratica->localidade)) {
                                    $localizacao[] = $boapratica->localidade;
                                }
                                if (!empty($boapratica->comuna)) {
                                    $localizacao[] = $boapratica->comuna->nomeComuna;
                                }

                                if (!empty($boapratica->municipio)) {
                                    $localizacao[] = $boapratica->municipio->nomeMunicipio;
                                }

                                if (!empty($boapratica->provincia)) {
                                    $localizacao[] = $boapratica->provincia->nomeProvincia;
                                }
                                ?>
                                Localização: <?= implode(', ', $localizacao) ?>  <br> 
                               Área(s) de Intervenção: <?= $boapratica->area ?>
                            </p>
                            <p style="text-align: justify"><?= $boapratica->justificacao ?> <?= Html::a(Yii::t('app', '<i class="fas fa-edit"></i> Editar'), ['update', 'Id' => $boapratica->Id], ['class' => 'btn btn-primary']) ?></p>
                            <?php if (strlen($boapratica->justificacao) < 358): ?>
                                <br><br><br><br>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Bloco Nutrição -->
            <div id="reforco" class="container10 w3-container w3-border city" style="display:none">
                <?php foreach ($boaspraticas as $boapratica): ?>
                    <?php if (strpos($boapratica->area, 'Reforço Institucional') !== false): ?>
                        <div>                            
                            <img src="/admin/images/boaspraticas/<?= $boapratica->fotografia ?>" alt="Boa Prática" style="width:50%">
                            <p style="color: #999900"><b><?= $boapratica->boapratica ?></b></p>
                            <p style="color: #999900">
                                Fonte: <?= $boapratica->entidadepropoente ?><br>
                                Entidade(s): <?= $boapratica->entidadeimplementadora ?><br>
                                 <?php
                                $localizacao = [];
                                if (!empty($boapratica->longitude)) {
                                    $localizacao[] = $boapratica->longitude;
                                }
                                if (!empty($boapratica->latitude)) {
                                    $localizacao[] = $boapratica->latitude;
                                }
                                if (!empty($boapratica->localidade)) {
                                    $localizacao[] = $boapratica->localidade;
                                }
                                if (!empty($boapratica->comuna)) {
                                    $localizacao[] = $boapratica->comuna->nomeComuna;
                                }

                                if (!empty($boapratica->municipio)) {
                                    $localizacao[] = $boapratica->municipio->nomeMunicipio;
                                }

                                if (!empty($boapratica->provincia)) {
                                    $localizacao[] = $boapratica->provincia->nomeProvincia;
                                }
                                ?>
                                Localização: <?= implode(', ', $localizacao) ?>  <br>
                                Área(s) de Intervenção: <?= $boapratica->area ?>
                            </p>
                            <p style="text-align: justify"><?= $boapratica->justificacao ?> <?= Html::a(Yii::t('app', '<i class="fas fa-edit"></i> Editar'), ['update', 'Id' => $boapratica->Id], ['class' => 'btn btn-primary']) ?></p>

                            <?php if (strlen($boapratica->justificacao) < 358): ?>
                                <br><br><br><br>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Bloco outras -->
            <div id="outras" class="container10 w3-container w3-border city" style="display:none"> 
                <?php foreach ($boaspraticas as $boapratica): ?>
                    <?php if (strpos($boapratica->area, 'Outras') !== false): ?>
                        <div>                            
                            <img src="/admin/images/boaspraticas/<?= $boapratica->fotografia ?>" alt="Boa Prática" style="width:50%">
                            <p style="color: #999900"><b><?= $boapratica->boapratica ?></b></p>
                            <p style="color: #999900">
                                Fonte: <?= $boapratica->entidadepropoente ?><br>
                                Entidade(s): <?= $boapratica->entidadeimplementadora ?><br>
                                <?php
                                $localizacao = [];
                                if (!empty($boapratica->longitude)) {
                                    $localizacao[] = $boapratica->longitude;
                                }
                                if (!empty($boapratica->latitude)) {
                                    $localizacao[] = $boapratica->latitude;
                                }
                                if (!empty($boapratica->localidade)) {
                                    $localizacao[] = $boapratica->localidade;
                                }
                                if (!empty($boapratica->comuna)) {
                                    $localizacao[] = $boapratica->comuna->nomeComuna;
                                }

                                if (!empty($boapratica->municipio)) {
                                    $localizacao[] = $boapratica->municipio->nomeMunicipio;
                                }

                                if (!empty($boapratica->provincia)) {
                                    $localizacao[] = $boapratica->provincia->nomeProvincia;
                                }
                                ?>
                                Localização: <?= implode(', ', $localizacao) ?>  <br>
                                Área(s) de Intervenção: <?= $boapratica->area ?>
                            </p>
                            <p style="text-align: justify"><?= $boapratica->justificacao ?> <?= Html::a(Yii::t('app', '<i class="fas fa-edit"></i> Editar'), ['update', 'Id' => $boapratica->Id], ['class' => 'btn btn-primary']) ?></p>

                            <?php if (strlen($boapratica->justificacao) < 358): ?>
                                <br><br><br><br>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- Botão "Adicionar" alinhado à direita após a seção "Outras" -->
        <!--<div style="text-align: right; margin-top: 20px;">-->
        <!--</div>-->
        <script>
            function openCity(evt, cityName) {
                var i, x, tablinks;
                x = document.getElementsByClassName("city");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablink");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " w3-red";
            }
        </script>

    </body>
</html>
