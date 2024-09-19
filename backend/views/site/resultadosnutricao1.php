
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
                <h3 class="section-sub-title" style="text-align: center !important;"><b>INDICADORES DO QUADRO LÓGICO | NUTRIÇÃO</b></h3>
                <br>
                </section>

 <!--/ Nutrição -->
    <section class="container" style="background-color: white;">
                    <div class="row">

                    <div class="col-xl-4 col-lg-6 col-md-7 evento">
                    <br><br>
                              <div class="text-center">
                                <div style="border-style: solid; border-color: #888C00; border-width: 1.5px;">
                                          <p style="text-align: center; color: #888C00; line-height: 28px"><b>MELHORIA DA NUTRIÇÃO [COMPONENTE II]</b><br>
                                          <img style="width: 10%;" src="images/resultado/elemento4.png"><br>Melhorar o consumo alimentar e a qualidade da alimentação da população vulnerável</p>
                                  </div>
                                    <img style="width: 35%;" src="images/resultado/iconografia indicadores-05.png">
                                    <img style="width: 33%;" src="images/resultado/Iconografia principal_nutricao.png">
                                  </div>
                                </div>  
                                <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                                  <br>
                                  <img style="width: 18.9%;" src="images/resultado/iconografia indicadores-21.png"><b style="color: lightsteelblue; font-size: 23px;">&nbsp;em análise</b><p style="color: darkblue;">reduzido à prevalência da vulnerabilidade à insegurança alimentar e nutricional</p>
                                    <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
                                      <div class=" row">
                                        <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Cunene<br>em análise</b></div>
                                        <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Huíla<br>em análise</b></div>
                                        <div class="col-4" style="text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Namibe<br>em análise</b></div>
                                      </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                                      <br>
                                      <img style="width: 22.9%;" src="images/resultado/iconografia indicadores-19.png"><b style="color: lightsteelblue; font-size: 23px;">&nbsp;em análise</b><p style="color: darkblue;">reduzido à prevalência da malnutrição crónica nas crianças com idade < 5 anos</p>
                                        <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
                                          <div class=" row">
                                            <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Cunene<br>em análise</b></div>
                                            <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Huíla<br>em análise</b></div>
                                            <div class="col-4" style="text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Namibe<br>em análise</b></div>
                                          </div>
                                        </div> 
                                        
                            <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                              <br>
                              <img style="width: 46.6%;" src="images/resultado/icones soltos_20_agricultura_.png"><b style="color: lightsteelblue; font-size: 23px;">&nbsp;em análise</b><p style="color: darkblue;">de beneficiários aumentaram o consumo e a diversidade de alimentos nutritivos</p>
                                <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
                                  <div class=" row">
                                    <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Cunene<br>em análise</b></div>
                                    <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Huíla<br>em análise</b></div>
                                    <div class="col-4" style="text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Namibe<br>em análise</b></div>
                                  </div>
                                </div>  
                                <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                                  <br>
                                  <img style="width: 35%;" src="images/resultado/icones soltos_09_familia.png"><b style="color: lightsteelblue; font-size: 23px;">&nbsp;em análise</b><p style="color: darkblue;">agregados familiares que consomem alimentos nutritivos promovidos pelo projecto</p>
                                    <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
                                      <div class=" row">
                                        <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Cunene<br>em análise</b></div>
                                        <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Huíla<br>em análise</b></div>
                                        <div class="col-4" style="text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Namibe<br>em análise</b></div>
                                      </div>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
                                      <br>
                                      <img style="width: 21.5%;" src="images/resultado/iconografia indicadores-22.png"><b style="color: darkblue; font-size: 23px;">&nbsp;73.944 de 60.000</b><p style="color: darkblue;">mulheres em idade reprodutiva sensibilizadas em <br>nutrição</p>
                                        <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>>100 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
                                          <div class=" row">
                                            <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>23.449</b></div>
                                            <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>41.380</b></div>
                                            <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>8.688</b></div>
                                          </div>
                                        </div> 
                   
                    </div>
         
</section>
 
    <!-- Nutrição -->
 <h3 class="section-sub-title" style="text-align: center !important;"><br><b>INFORMAÇÕES SUPLEMENTARES</b></h3>

    <p style="text-align: center; color: #DED000; text-shadow: 0px 0px 0px rgba(4, 4, 0, 0.5); "><b>[Em breve poderá encontrar aqui mais detalhes]</b></p>
    