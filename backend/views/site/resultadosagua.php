
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
<?php
//<!--Metas-->
//
//<!--Metas de Agricultura-->
//$totalEcas= \backend\controllers\SiteController::getTotalECAs();
if (isset($results)) {
    //print_r($results);
    $totalEcas = 0; // Inicializa a soma total
    $totalcamponesesApoiados = 0;
    $totalcamponesesApoiadosMasculino = 0;
    $totalcamponesesApoiadosFeminino = 0;

    //Total de Ecas por provincia
    $totalEcaNamibe = 0;
    $totalEcaHuila = 0;
    $totalEcaCunene = 0;
    //Fim Total de Ecas por provincia
    //
    //Total de Camponeses por Provincia
    $totalCamponesesNamibe = 0;
    $totalCamponesesHuila = 0;
    $totalCamponesesCunene = 0;
    //Fim Total de Camponeses por Provincia
    //
    //Total de Participantes de formacao para prestacao de servico por Provincia
    $totalPartiForNamibe = 0;
    $totalPartiForHuila = 0;
    $totalPartiForCunene = 0;
    //Fim Total de Participantes de formacao para prestacao de servico por Provincia
    //
    //Total de  famílias camponesas apoiadas em práticas e materiais de armazenamento por Provincia
    $totalFamiCampApoiNamibe = 0;
    $totalFamiCampApoiHuila = 0;
    $totalFamiCampApoiCunene = 0;
    //Fim Total de  famílias camponesas apoiadas em práticas e materiais de armazenamento por Provincia
    //print_r($results);
    //Foreach para Agricultura
    foreach ($results['grupo'] as $grupo) {
        // Verificar se o atributo "estadoValidacao" é igual a "Publicado"
        if ($grupo->estadoValidacao === 'Publicado') {
            $totalEcas++;
            // Calcular a soma de nCamponesesHomens e nCamponesesMulheres
            $somacamponesesApoiados = $grupo->nCamponesesHomens + $grupo->nCamponesesMulheres;
            $totalcamponesesApoiados += $somacamponesesApoiados;

            $somacamponesesApoiadosMasculino = $grupo->nCamponesesHomens;
            $totalcamponesesApoiadosMasculino += $somacamponesesApoiadosMasculino;

            $somacamponesesApoiadosFeminino = $grupo->nCamponesesMulheres;
            $totalcamponesesApoiadosFeminino += $somacamponesesApoiadosFeminino;

            //somar ecas, TotalCamponeses por provincia
            $provincia = $grupo->provinciaID; // Substitua 'provincia' pelo nome do campo que contém a província

            if ($provincia == 1) {
                $totalEcaNamibe++;
                $totalCamponesesNamibe += $somacamponesesApoiados;
            } elseif ($provincia == 2) {
                $totalEcaHuila++;
                $totalCamponesesHuila += $somacamponesesApoiados;
            } elseif ($provincia == 3) {
                $totalEcaCunene++;
                $totalCamponesesCunene += $somacamponesesApoiados;
            }
        }
    }
    //Foreach para Agua
    $totalBenTranSoc = 0;
    $totalInfraEstrHidraulica = 0;

    //Total de Ben Trans Social por Provincia
    $totalBenTraSocNamibe = 0;
    $totalBenTraSocHuila = 0;
    $totalBenTraSocCunene = 0;

    //Total de Infra estrutura por Provincia
    $totaInfraestNamibe = 0;
    $totalInfraestHuila = 0;
    $totalInfraestCunene = 0;

    //Pessoas, Animal, Irrigados
    $totalPessoa = 0;
    //Total Pessoa por provincia
    $totalPessoaNamibe = 0;
    $totalPessoaHuila = 0;
    $totalPessoaCunene = 0;

    $totalAnimal = 0;
    //Total Animal Por provinci
    $totaAnimalNamibe = 0;
    $totalAnimalHuila = 0;
    $totalAnimalCunene = 0;
    $totalIrrigados = 0;

    //Total Irrigado por Provincia
    $totaIrrigadosNamibe = 0;
    $totalIrrigadosHuila = 0;
    $totalIrrigadosCunene = 0;

    $totalGrupoAguas = 0;
    //Total grupos de água por Provincia
    $totalGrupoAguaNamibe = 0;
    $totalGrupoAguaHuila = 0;
    $totalGrupoAguaCunene = 0;

    foreach ($results['Agua'] as $agua) {
        // Verificar se o atributo "estadoValidacao" é igual a "Publicado"
        if ($agua->estadoValidacao === 'Publicado') {

            // Calcular a soma de nCamponesesHomens e nCamponesesMulheres
            $somaBenTransSociais = $agua->benHomemTransSocial + $agua->benMulherTransSocial;
            $totalBenTranSoc += $somaBenTransSociais;

            $provincia = $agua->provinciaID;

            if (!empty($agua->infraEstrutura)) {
                $totalInfraEstrHidraulica++;

                $somaPessoa = $agua->benHomem + $agua->benMulher;
                $totalPessoa += $somaPessoa;

                $somaAnimal = $agua->totalSuino + $agua->totalCaprino + $agua->totalBovino;
                $totalAnimal += $somaAnimal;

                $somaIrrigado = $agua->totalHaIrrigados;
                $totalIrrigados += $somaIrrigado;

                if (strtoupper($agua->grupoGestAgua) === "SIM") {
                    $totalGrupoAguas++;
                }
            }
            if (!empty($agua->infraEstrutura) && $provincia == 1) {
                $totaInfraestNamibe++;
            }
            if (!empty($agua->infraEstrutura) && $provincia == 2) {
                $totalInfraestHuila++;
            }
            if (!empty($agua->infraEstrutura) && $provincia == 3) {
                $totalInfraestCunene++;
            }
//----------------------------------------------------
            //somar ecas, TotalCamponeses por provincia

            if ($provincia == 1) {
                $totalBenTraSocNamibe += $somaBenTransSociais;
                $totalPessoaNamibe += $somaPessoa;
                $totaAnimalNamibe += $somaAnimal;
                $totaIrrigadosNamibe += $somaIrrigado;
            } elseif ($provincia == 2) {
                $totalBenTraSocHuila += $somaBenTransSociais;
                $totalPessoaHuila += $somaPessoa;
                $totalAnimalHuila += $somaAnimal;
                $totalIrrigadosHuila += $somaIrrigado;
            } elseif ($provincia == 3) {
                $totalBenTraSocCunene += $somaBenTransSociais;
                $totalPessoaCunene += $somaPessoa;
                $totalAnimalCunene += $somaAnimal;
                $totalIrrigadosCunene += $somaIrrigado;
            }
        }
    }
}


$metaECA = Meta::find()->where(['nomeMeta' => 'ECA'])->one()->valorMeta;
$metacamponesesApoiados = Meta::find()->where(['nomeMeta' => 'camponeses apoiados'])->one()->valorMeta;
$metaaPartiFormAgri = Meta::find()->where(['nomeMeta' => 'participantes formacao apoio agricultores'])->one()->valorMeta;
$metaaApoioFamilias = Meta::find()->where(['nomeMeta' => 'participantes formacao apoio familias'])->one()->valorMeta;
$metaBenTransSoci = Meta::find()->where(['nomeMeta' => 'beneficiarios de transferencias sociais'])->one()->valorMeta;
$metaInfraestrutura = Meta::find()->where(['nomeMeta' => 'pequenas infra-estruturas'])->one()->valorMeta;
//<!--Fim Metas de agricultura-->
//<!--Metas de Nutricao-->
//
//<!--Fim Metas de Nutricao-->
//
//<!--Metas de Reforço Institucional-->
//<!--Fim Metas de Reforço Institucional-->
//<!--Fim Metas-->
?>




<style>
    .expression {
        display: flex;
        align-items: center;
    }

    .cunene {
        width: 1em;
        height: 1em;
        background-color: #919734;
        margin-right: 0.1em; /* Espaço entre o quadrado e o texto */
    }
    .huila {
        width: 1em;
        height: 1em;
        background-color: #C5CC32;
        margin-right: 0.1em; /* Espaço entre o quadrado e o texto */
    }
    .namibe {
        width: 1em;
        height: 1em;
        background-color: #EAE018;
        margin-right: 0.1em; /* Espaço entre o quadrado e o texto */
    }
</style>



<section class="container" style="background-color: white">
                <h3 class="section-sub-title" style="text-align: center !important;"><b>INDICADORES DO QUADRO LÓGICO | ÁGUA</b></h3>
                <br>
                </section>

 <!-- Água -->
<section class="container" style="background-color: whitesmoke;">
                    <div class="row"> 
                              <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                                                  <br>
                                                  <div class="text-center">
                                                      <div style="border-style: solid; border-color: #888C00; border-width: 1.5px;">
                                                                <p style="text-align: center; color: #888C00; line-height: 28px"><b>MELHORIA DO ACESSO À ÁGUA [COMPONENTE II]</b><br>
                                                                <img style="width: 10%;" src="images/resultado/elemento4.png"><br>Melhorar o acesso à água da população vulnerável</p>
                                                      </div>
                                                        <img style="width: 35%;" src="images/resultado/iconografia indicadores-05.png">
                                                        <img style="width: 35%;" src="images/resultado/iconografia indicadores-06.png">
                                                      </div>
                                              </div>
                                              <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                                                <br>
                                                <img style="width: 36.2%;" src="images/resultado/acesso.png"><b style="color: darkblue; font-size: 23px;">&nbsp;24% de 40%</b><p style="color: darkblue;">de pessoas com acesso a fontes de água melhoradas no âmbito do projecto</p>
                                                  <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>60 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 60,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
                                                    <div class=" row">
                                                      <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>N.A.</b></div>
                                                      <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>N.A.</b></div>
                                                      <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>N.A.</b></div>
                                                    </div>
                                              </div>
                                              <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                                                <br>
                                                <img style="width: 20.2%;" src="images/resultado/icones soltos_25_rendimentos.png"><b style="color: darkblue; font-size: 23px;">&nbsp;2.380 de 2.000</b><p style="color: darkblue;">beneficiários de ajuda através de transferências sociais (H: 1.479; M: 901)</p>
                                                <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>>100 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
                                                  <div class=" row">
                                                    <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>686</b></div>
                                                    <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>1.144</b></div>
                                                    <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>550</b></div>
                                                  </div>
                                            </div>

                                            <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                                                  <br>
                                                  <img style="width: 19.7%;" src="images/resultado/iconografia indicadores-26.png"><b style="color: darkblue; font-size: 23px;">&nbsp;371 de 500</b><p style="color: darkblue;">pequenas infra-estruturas hidráulicas construídas ou reabilitadas</p>
                                                    <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>74 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 74,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
                                                      <div class=" row">
                                                        <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>173</b></div>
                                                        <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>126</b></div>
                                                        <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>72</b></div>
                                                      </div>
                                              </div>
                                              <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                                                <br>
                                                <img style="width: 28.2%;" src="images/resultado/consumidores.png"><b style="color: darkblue; font-size: 23px;">&nbsp;153.873 de 180.000</b><p style="color: darkblue;">pessoas beneficiárias das pequenas infra-estruturas hidráulicas</p>
                                                  <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>85 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 85,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
                                                    <div class=" row">
                                                      <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>112.711</b></div>
                                                      <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>29.598</b></div>
                                                      <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>11.564</b></div>
                                                    </div>
                                              </div>
                                              <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                                                <br>
                                                <img style="width: 26.9%;" src="images/resultado/animal.png"><b style="color: darkblue; font-size: 23px;">&nbsp;143.721</b><p style="color: darkblue;">animais beneficiários das pequenas infra-estruturas hidráulicas</p>
                                                  <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>&nbsp;</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
                                                    <div class=" row">
                                                      <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>90.804</b></div>
                                                      <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>8.648</b></div>
                                                      <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>44.269</b></div>
                                                    </div>
                                                  </div>
                                              <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                                                <br>
                                                <img style="width: 24%;" src="images/resultado/hectares.png"><b style="color: darkblue; font-size: 23px;">&nbsp;84</b><p style="color: darkblue;">hectares beneficiários das pequenas infra-estruturas hidráulicas</p>
                                                  <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>&nbsp;</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
                                                    <div class=" row">
                                                      <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>38 ha</b></div>
                                                      <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>17 ha</b></div>
                                                      <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>29 ha</b></div>
                                                    </div>
                                            
                          
</section>
<!-- Água -->


    <!-- Agricultura -->
 <h3 class="section-sub-title" style="text-align: center !important;"><br><b>INFORMAÇÕES SUPLEMENTARES</b></h3>

    <p style="text-align: center; color: #DED000; text-shadow: 0px 0px 0px rgba(4, 4, 0, 0.5); "><b>[Em breve poderá encontrar aqui mais detalhes]</b></p>
    