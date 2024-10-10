<?php

use yii\helpers\Html;

$this->title = 'SGI FRESAN | Camões, I.P.';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            <h3 class="section-sub-title" style="text-align: center !important;"><b>RECOMENDAÇÕES | FRESAN/Camões, I.P.</b></h3>
            <br>
            <div style="border-style: solid; border-color: #999900; border-width: 1.5px">
                 <p style="text-align: center">As Recomendações resultam de um processo de reflexão em torno das práticas em desenvolvimento no quadro do FRESAN/Camões. São, sobretudo, recomendações para o futuro, dado que nesta fase já não haverá tempo para a sua implementação no quadro do FRESAN. Poderão constituir um contributo importante para o processo de formulação de novos programas e projectos, por forma a melhorar a sua eficiência e eficácia. As recomendações incluídas nesta funcionalidade foram identificadas nas actas de reuniões de Comité de Direcção do Programa, de Coordenação Geral, das Áreas Técnicas do FRESAN/Camões. Como no caso das Boas Práticas, as Recomendações estão associadas às diferentes áreas temáticas do FRESAN.</p>
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
                   
                </div>
            </div>


            <!-- Bloco Agricultura -->

            <div id="agricultura" class="container10 w3-container w3-border city">
                <?php foreach ($recomendacoes as $recomendacao): ?>
                    <?php if (strpos($recomendacao->area, 'Agricultura') !== false): ?>
                        <div>                            
                            <img src="/mvp/admin/recomendacoes/<?= $recomendacao->fotografia ?>" alt="Recomendações" style="width:50%">
                            <p style="color: #999900"><b><?= $recomendacao->recomendacao ?></b></p>
                            <p style="color: #999900">
                                Fonte: <?= $recomendacao->contexto ?><br>
                                Data: <?= $recomendacao->data ?><br>
                                 Área(s) de Intervenção: <?= $recomendacao->area ?><br>
                            <p style="text-align: justify"> <b>Recomendação:</b> <?= $recomendacao->justificacao ?>  <br></p>
                            </p>

                            <?php if (strlen($recomendacao->justificacao) < 358): ?>
                                <br><br><br>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Bloco Nutrição -->
            <div id="nutricao" class="container10 w3-container w3-border city" style="display:none">
                <?php foreach ($recomendacoes as $recomendacao): ?>
                    <?php if (strpos($recomendacao->area, 'Nutrição') !== false): ?>
                        <div>                            
                            <img src="/mvp/admin/recomendacoes/<?= $recomendacao->fotografia ?>" alt="Recomendações" style="width:50%">
                            <p style="color: #999900"><b><?= $recomendacao->recomendacao ?></b></p>
                            <p style="color: #999900">
                                Fonte: <?= $recomendacao->contexto ?><br>
                                Data: <?= $recomendacao->data ?><br>
                                Área(s) de Intervenção: <?= $recomendacao->area ?><br>
                                <p style="text-align: justify"> <b>Recomendação:</b> <?= $recomendacao->justificacao ?>  <br></p>
                            </p>

                            <?php if (strlen($recomendacao->justificacao) < 358): ?>
                                <br><br><br>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Bloco Nutrição -->
            <div id="agua" class="container10 w3-container w3-border city" style="display:none">
                <?php foreach ($recomendacoes as $recomendacao): ?>
                    <?php if (strpos($recomendacao->area, 'Água') !== false): ?>
                        <div>                            
                           <img src="/mvp/admin/recomendacoes/<?= $recomendacao->fotografia ?>" alt="Recomendações" style="width:50%">
                            <p style="color: #999900"><b><?= $recomendacao->recomendacao ?></b></p>
                            <p style="color: #999900">
                                Fonte: <?= $recomendacao->contexto ?><br>
                                Data: <?= $recomendacao->data ?><br>
                                Área(s) de Intervenção: <?= $recomendacao->area ?><br>
                                <p style="text-align: justify"> <b>Recomendação:</b> <?= $recomendacao->justificacao ?>  <br></p>
                            </p>

                            <?php if (strlen($recomendacao->justificacao) < 338): ?>
                                <br><br><br>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Bloco Nutrição -->
            <div id="reforco" class="container10 w3-container w3-border city" style="display:none">
                <?php foreach ($recomendacoes as $recomendacao): ?>
                    <?php if (strpos($recomendacao->area, 'Reforço Institucional') !== false): ?>
                        <div>                            
                             <img src="/mvp/admin/recomendacoes/<?= $recomendacao->fotografia ?>" alt="Recomendações" style="width:50%">
                            <p style="color: #999900"><b><?= $recomendacao->recomendacao ?></b></p>
                            <p style="color: #999900">
                                Fonte: <?= $recomendacao->contexto ?><br>
                                Data: <?= $recomendacao->data ?><br>
                                Área(s) de Intervenção: <?= $recomendacao->area ?><br>
                                <p style="text-align: justify"> <b>Recomendação:</b> <?= $recomendacao->justificacao ?>  <br></p>
                            </p>

                            <?php if (strlen($recomendacao->justificacao) < 358): ?>
                                <br><br><br>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <!-- Bloco outras -->
            <div id="outras" class="container10 w3-container w3-border city" style="display:none"> 
                <?php foreach ($recomendacoes as $recomendacao): ?>
                    <?php if (strpos($recomendacao->area, 'Outras') !== false): ?>
                        <div>                            
                            <img src="/admin/recomendacoes/<?= $recomendacao->fotografia ?>" alt="Recomendações" style="width:50%">
                            <p style="color: #999900"><b><?= $recomendacao->recomendacao ?></b></p>
                            <p style="color: #999900">
                                Fonte: <?= $recomendacao->contexto ?><br>
                                Data: <?= $recomendacao->data ?><br>
                                Área(s) de Intervenção: <?= $recomendacao->area ?><br>
                                <b>Recomendação:</b> <?= $recomendacao->justificacao ?>  <br>
                            </p>

                            <?php if (strlen($recomendacao->justificacao) < 358): ?>
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
