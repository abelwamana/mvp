<?php

use backend\models\Localidade;
use backend\models\Municipio;
use backend\models\Provincia;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\models\Meta;

$this->title = 'SGI FRESAN | Camões, I.P.';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mapa do Google</title>
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
        <style>
            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                max-width: 300px;
                margin: auto;
                text-align: center;
                font-family: arial;
                background-color: whitesmoke;
            }

            .title {
                color: grey;
                font-size: 18px;
            }

            .card1 {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                max-width: 300px;
                text-align: center;
                background-color: whitesmoke;
            }

            .margem{
                margin-top: 20px;
                margin-left: 10px;
                margin-right: 10px;
            }

        </style>
    </head>
    <body>
        <section class="container" style="background-color: white">
            <h3 class="section-sub-title" style="text-align: center !important;"><b>COMUNIDADE</b></h3><br>
            <div class="row col-12 text-center" style="margin-left: 0px;">
                <div class="card1 col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue"><b>Camponeses(as)</b></h3><br>
                    <img src="/images/resultado/iconografia indicadores-12.png" alt="Camponeses(as)" style="width:69%"><br><br>
                    <p class="margem" style="color: darkblue">Membros dos campos agrícolas, cooperativas, associações e redes apoiadas</p><br>
                    <p class="margem" style="text-align: center; color: #B0C4DE; font-size: 14px"><b>Agricultura Familiar (Componente I)</b></p>
                </div>
                <div class="card1 col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue"><b>Pastores(as)</b></h3><br>
                    <img src="/images/resultado/iconografia indicadores-04.png" alt="Pastores(as)" style="width:70.5%"><br><br>
                    <p class="margem" style="color: darkblue">Membros dos campos agropecuários e jangos agropastoris apoiados</p><br>
                    <p class="margem" style="text-align: left; color: #B0C4DE; font-size: 14px"><b>Agricultura Familiar (Componente I)</b></p>
                </div>
                <div class="card1 col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue"><b>Mulheres</b></h3><br>
                    <img src="/images/resultado/iconografia indicadores-22.png" alt="Mulheres" style="width:63%"><br><br>
                    <p class="margem" style="color: darkblue">Mulheres em idade reprodutiva, adolescentes e mães de < de 5 anos sensibilizadas</p><br>
                    <p class="margem" style="text-align: left; color: #B0C4DE; font-size: 14px"><b>Nutrição e Água (Componentes II)</b></p>
                </div>
                <div class="card1 col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue"><b>Crianças</b></h3><br>
                    <img src="/images/resultado/iconografia indicadores-19.png" alt="Camponeses" style="width:65.5%"><br><br>
                    <p class="margem" style="color: darkblue">Crianças menores de 5 anos beneficiadas por sessões de rastreio comunitário</p><br>
                    <p class="margem" style="text-align: left; color: #B0C4DE; font-size: 14px"><b>Nutrição e Água (Componentes II)</b></p>
                </div>
            </div>
            <br><br>
            <h3 class="section-sub-title" style="text-align: center !important;"><b>ETNIAS</b></h3>
            <div class="row col-12 text-center" style="margin-left: 0px;">
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Ambo</h3>
                </div><br><br><br><br>
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Ganguela</h3>
                </div><br><br><br><br>
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Herero</h3>
                </div><br><br><br><br>
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Humbe</h3>
                </div><br><br><br><br>
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Khoisan</h3>
                </div><br><br><br><br>
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Kicongo</h3>
                </div><br><br><br><br>
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Kimbundo</h3>
                </div><br><br><br><br>
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Kioko</h3>
                </div><br><br><br><br>
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Mbundo</h3>
                </div><br><br><br><br>
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Nyaneka</h3>
                </div><br><br><br><br>
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Umbundo</h3>
                </div><br><br><br><br>
                <div class="card col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue; font-size: 22px">Vátua</h3>
                </div><br><br><br><br>
            </div>
            <br><br>
            <h3 class="section-sub-title" style="text-align: center !important;"><b>AGENTES DE EXTENSÃO E FUNCIONÁRIOS PÚBLICOS</b></h3><br>
            <div class="row col-12 text-center" style="margin-left: 0px;">
                <div class="card1 col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue"><b>Tratadores de Gado</b></h3><br>
                    <img src="/images/resultado/Iconografia alternativa_icones alternativos_estacao zootecnica.png" alt="Tratadores de Gado"  style="width:70%"><br><br>
                    <p class="margem" style="color: darkblue">Tratadores de gado mapeados nas zonas de intervenção formados em pecuária</p><br>
                    <p class="margem" style="text-align: left; color: #B0C4DE; font-size: 14px"><b>Reforço Institucional (Componente III)</b></p>
                </div>
                <div class="card1 col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue"><b>ACS</b></h3><br>
                    <img src="/images/resultado/iconografia indicadores-07.png" alt="ACS" style="width:70%"><br><br>
                    <p class="margem" style="color: darkblue">Agentes comunitários de saúde capacitados em nutrição e alimentação</p><br>
                    <p class="margem" style="text-align: left; color: #B0C4DE; font-size: 14px"><b>Reforço Institucional (Componente III)</b></p>
                </div>
                <div class="card1 col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue"><b>Técnicos de Saúde</b></h3><br>
                    <img src="/images/resultado/iconografia indicadores-05.png" alt="Técnicos de Saúde" style="width:70%"><br><br>
                    <p class="margem" style="color: darkblue">Técnicos de saúde (sector público) capacitados em nutrição e alimentação</p><br>
                    <p class="margem" style="text-align: left; color: #B0C4DE; font-size: 14px"><b>Reforço Institucional (Componente III)</b></p>
                </div>
                <div class="card1 col-lg-3 col-md-6">
                    <h3 class="margem" style="color: darkblue"><b>Func. Públicos</b></h3><br>
                    <img src="/images/resultado/Iconografia principal_Contratacoes.png" alt="Funcionários Públicos" style="width:70%"><br><br>
                    <p class="margem" style="color: darkblue">Funcionários públicos formados em SAN, Clima e Emergência Pré-hospitalar</p><br>
                    <p class="margem" style="text-align: left; color: #B0C4DE; font-size: 14px"><b>Reforço Institucional (Componente III)</b></p>
                </div>
            </div>
            <br><br>
        </section>
    </body>
</html>
