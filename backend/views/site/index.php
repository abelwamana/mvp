
<?php

use backend\models\Localidade;
use backend\models\Municipio;
use backend\models\Provincia;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\models\Meta;
use yii\bootstrap4\Alert;
use yii\widgets\Breadcrumbs;
use backend\controllers\SiteController;
use backend\models\Event;
use yii\helpers\ArrayHelper;
use yii\web\View;
use kartik\select2\Select2;

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



<?php ?>
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!--Ecas-->
<script type="text/javascript">
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);



    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Density'],
            ['Concluído', <?php echo $totalEcas; ?>],
            ['Restante', <?php echo $metaECA - $totalEcas; ?>]
        ]);

        var options = {
            pieHole: 0.6, // Aumente o valor do pieHole para criar um espaço central maior
            pieSliceText: 'none', // Remova os rótulos das fatias
            legend: 'none',
            //title: 'Progresso das ECAs',
            colors: ['#003399', '#E4E5F1']
        };

        var chart = new google.visualization.PieChart(document.getElementById('ecas'));

        chart.draw(data, options);

        // Adicione o texto no centro
        var div = document.getElementById('ecas');
        var width = div.offsetWidth;
        var height = div.offsetHeight;
        var svg = div.querySelector('svg');
        var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', width / 2);
        text.setAttribute('y', height / 2 + 10); // Ajuste a posição vertical conforme necessário
        text.setAttribute('text-anchor', 'middle');
        text.setAttribute('font-size', '36'); // Ajuste o tamanho da fonte conforme necessário
        text.setAttribute('fill', '#003399'); // Ajuste a cor do texto conforme necessário
        text.textContent = '<?php echo $totalEcas; ?>%'; // O valor da porcentagem
        svg.appendChild(text);
    }

</script>

<!--Formacoes-->
<script type="text/javascript">
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);



    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Density'],
            ['Concluído', 0],
            ['Restante', 0]
        ]);

        var options = {
            pieHole: 0.6, // Aumente o valor do pieHole para criar um espaço central maior
            pieSliceText: 'none', // Remova os rótulos das fatias
            legend: 'none',
            //title: 'Progresso das formacao',
            colors: ['#003399', '#E4E5F1']
        };

        var chart = new google.visualization.PieChart(document.getElementById('formacao'));

        chart.draw(data, options);

        // Adicione o texto no centro
        var div = document.getElementById('formacao');
        var width = div.offsetWidth;
        var height = div.offsetHeight;
        var svg = div.querySelector('svg');
        var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', width / 2);
        text.setAttribute('y', height / 2 + 10); // Ajuste a posição vertical conforme necessário
        text.setAttribute('text-anchor', 'middle');
        text.setAttribute('font-size', '36'); // Ajuste o tamanho da fonte conforme necessário
        text.setAttribute('fill', '#003399'); // Ajuste a cor do texto conforme necessário
        text.textContent = '0%'; // O valor da porcentagem de formacao
        svg.appendChild(text);
    }

</script>

<!--Beneficiarios de Transferencias Socias-->
<script type="text/javascript">
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);



    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Density'],
            ['Concluído', <?php echo $totalBenTranSoc; ?>],
            ['Restante', <?php echo $metaBenTransSoci - $totalBenTranSoc; ?>]
        ]);

        var options = {
            pieHole: 0.6, // Aumente o valor do pieHole para criar um espaço central maior
            pieSliceText: 'none', // Remova os rótulos das fatias
            legend: 'none',
            //title: 'Progresso das formacao',
            colors: ['#003399', '#E4E5F1']
        };

        var chart = new google.visualization.PieChart(document.getElementById('benTransSoc'));

        chart.draw(data, options);

        // Adicione o texto no centro
        var div = document.getElementById('benTransSoc');
        var width = div.offsetWidth;
        var height = div.offsetHeight;
        var svg = div.querySelector('svg');
        var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', width / 2);
        text.setAttribute('y', height / 2 + 10); // Ajuste a posição vertical conforme necessário
        text.setAttribute('text-anchor', 'middle');
        text.setAttribute('font-size', '26'); // Ajuste o tamanho da fonte conforme necessário
        text.setAttribute('fill', '#003399'); // Ajuste a cor do texto conforme necessário
        text.textContent = '<?php echo round(abs(($totalBenTranSoc / $metaBenTransSoci) * 100)); ?>%'; // O valor da porcentagem de formacao
        svg.appendChild(text);
    }

</script>

<!--Pequenas Infraestruturas de Irrigação-->
<script type="text/javascript">
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);



    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Density'],
            ['Concluído', <?php echo $totalInfraEstrHidraulica; ?>],
            ['Restante', <?php echo $metaInfraestrutura - $totalInfraEstrHidraulica; ?>]
        ]);

        var options = {
            pieHole: 0.6, // Aumente o valor do pieHole para criar um espaço central maior
            pieSliceText: 'none', // Remova os rótulos das fatias
            legend: 'none',
            //title: 'Progresso das formacao',
            colors: ['#003399', '#E4E5F1']
        };

        var chart = new google.visualization.PieChart(document.getElementById('infraestrutura'));

        chart.draw(data, options);

        // Adicione o texto no centro
        var div = document.getElementById('infraestrutura');
        var width = div.offsetWidth;
        var height = div.offsetHeight;
        var svg = div.querySelector('svg');
        var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', width / 2);
        text.setAttribute('y', height / 2 + 10); // Ajuste a posição vertical conforme necessário
        text.setAttribute('text-anchor', 'middle');
        text.setAttribute('font-size', '26'); // Ajuste o tamanho da fonte conforme necessário
        text.setAttribute('fill', '#003399'); // Ajuste a cor do texto conforme necessário
        text.textContent = '<?php echo round(abs(($totalInfraEstrHidraulica / $metaInfraestrutura) * 100)); ?>%'; // O valor da porcentagem de formacao
        svg.appendChild(text);
    }

</script>

<!--Camponeses Apoiados-->
<script type="text/javascript">
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);



    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Density'],
            ['Concluído', <?php echo $totalcamponesesApoiados; ?>],
            ['Restante', <?php
$diferenca = $metacamponesesApoiados - $totalcamponesesApoiados;

if ($diferenca < 0) {
    echo 0;
} else {
    echo abs($diferenca);
}
?>]
        ]);

        var options = {
            pieHole: 0.6, // Aumente o valor do pieHole para criar um espaço central maior
            pieSliceText: 'none', // Remova os rótulos das fatias
            legend: 'none',
            //title: 'Progresso das Camponeses',
            colors: ['#003399', '#E4E5F1']
        };

        var chart = new google.visualization.PieChart(document.getElementById('camponesesApoiados'));

        chart.draw(data, options);

        // Adicione o texto no centro
        var div = document.getElementById('camponesesApoiados');
        var width = div.offsetWidth;
        var height = div.offsetHeight;
        var svg = div.querySelector('svg');
        var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', width / 2);
        text.setAttribute('y', height / 2 + 10); // Ajuste a posição vertical conforme necessário
        text.setAttribute('text-anchor', 'middle');
        text.setAttribute('font-size', '36'); // Ajuste o tamanho da fonte conforme necessário
        text.setAttribute('fill', '#003399'); // Ajuste a cor do texto conforme necessário
        text.textContent = '<?php echo round(abs(($totalcamponesesApoiados / $metacamponesesApoiados) * 100)); ?>%'; // O valor da porcentagem
        svg.appendChild(text);
    }

</script>
<!--familias camponesas Apoiados-->
<script type="text/javascript">
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);



    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Element', 'Density'],
            ['Concluído', 0],
            ['Restante', 0]
        ]);

        var options = {
            pieHole: 0.6, // Aumente o valor do pieHole para criar um espaço central maior
            pieSliceText: 'none', // Remova os rótulos das fatias
            legend: 'none',
            //title: 'Progresso das Camponeses',
            colors: ['#003399', '#E4E5F1']
        };

        var chart = new google.visualization.PieChart(document.getElementById('familiasApoiados'));

        chart.draw(data, options);

        // Adicione o texto no centro
        var div = document.getElementById('familiasApoiados');
        var width = div.offsetWidth;
        var height = div.offsetHeight;
        var svg = div.querySelector('svg');
        var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        text.setAttribute('x', width / 2);
        text.setAttribute('y', height / 2 + 10); // Ajuste a posição vertical conforme necessário
        text.setAttribute('text-anchor', 'middle');
        text.setAttribute('font-size', '36'); // Ajuste o tamanho da fonte conforme necessário
        text.setAttribute('fill', '#003399'); // Ajuste a cor do texto conforme necessário
        text.textContent = '0%'; // O valor da porcentagem
        svg.appendChild(text);
    }

</script>

<!--Camponeses masculino e femi-->
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawStackedBarChart);

    function drawStackedBarChart() {
        var data = google.visualization.arrayToDataTable([
            ['Sexo', 'Masculino', 'Feminino'],
            ['', <?php echo $totalcamponesesApoiadosMasculino ?>, <?php echo $totalcamponesesApoiadosFeminino ?>]
        ]);

        var options = {
            width: 400,
            height: 50,
            legend: {position: 'top', maxLines: 1},
            isStacked: true,
            colors: ['#B8CFFF', '#2970FF']

        };
        var chart = new google.visualization.BarChart(document.getElementById('stacked-bar-chart'));
        chart.draw(data, options);
    }
</script>

<!--Tratadores de Gados-->
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(drawStackedBarChart);

    function drawStackedBarChart() {
        var data = google.visualization.arrayToDataTable([
            ['Sexo', 'Masculino', 'Feminino'],
            ['', <?php echo 1111111 ?>, <?php echo 111111111111 ?>]
        ]);

        var options = {
            width: 400,
            height: 50,
            legend: {position: 'top', maxLines: 1},
            isStacked: true,
            colors: ['#B8CFFF', '#2970FF']

        };
        var chart = new google.visualization.BarChart(document.getElementById('stacked-bar-chartGados'));
        chart.draw(data, options);
    }
</script>
<?php
// Consulte as províncias da tabela "provincia"
$provincias = Provincia::find()->all();
$municipios = Municipio::find()->all();
$localidades = Localidade::find()->all();

$anos = [];

// Tabelas para buscar anos distintos
$tabelas = [
    'Agua',
    'Capacitacao',
    'demostracoesculinarias',
    'doccomunicacao',
    'eventos',
    'grupo',
    'materiais',
    'merendaescolar',
    'pacotepedagfresan',
    'profissionaissaude',
    'rastreio',
    'reforcoinstitucional',
    'supervisao',
    'suplementacao',
];

foreach ($tabelas as $tabela) {
    $query = (new Query())
            ->select(['YEAR(primeiroReporte) as ano'])
            ->from($tabela)
            ->distinct();

    $anos = array_merge($anos, $query->column());
}
// Remova valores duplicados e ordene os anos em ordem decrescente
$anos = array_unique($anos);
rsort($anos);

$entidades = [];

// Lista das tabelas que contêm o campo 'entidade'
$tabelasComEntidade = ['agua', 'grupo', 'reforcoinstitucional']; // Adicione todas as tabelas aqui

foreach ($tabelasComEntidade as $tabela) {
    // Consulta para obter opções enum do campo 'entidade'
    $queryEntidade = (new Query())
            ->select(['entidade'])
            ->from($tabela)
            ->distinct()
            ->column();

    // Mescla as opções obtidas com as opções já coletadas
    $entidades = array_merge($entidades, $queryEntidade);
}

// Remove opções duplicadas
$entidades = array_unique($entidades);

// Agora, você tem a lista de todas as opções enum do campo 'entidade' em suas tabelas
// $anos agora contém anos distintos do campo "primeiroReporte" de todas as tabelas
// Criar uma lista de opções para o menu suspenso usando ArrayHelper::map
//$trimestresList = ArrayHelper::map($trimestres, 'primeiroReporteID', 'primeiroReporteID');
//print_r($results);
?>

<section class="container" style="background-color: white">
    <h3 class="section-sub-title" style="text-align: center !important;"><b>INDICADORES DO QUADRO LÓGICO</b></h3>
    <br>
</section>

<!--/ Agricultura -->
<section class="container" style="background-color: whitesmoke;">
    <div class="row">

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br><br>
            <div class="text-center">
                <div style="border-style: solid; border-color: #888C00; border-width: 1.5px;">
                    <p style="text-align: center; color: #888C00; line-height: 28px"><b>RESILIÊNCIA E PRODUÇÃO AGRÍCOLA FAMILIAR SUSTENTÁVEL [COMPONENTE I]</b><br>
                        <img style="width: 10%;" src="images/resultado/elemento4.png"><br>Reforçar a resiliência da agricultura familiar no contexto das alterações climáticas</p>
                </div>
                <img style="width: 35%;" src="images/resultado/iconografia indicadores-03.png">
                <img style="width: 35%;" src="images/resultado/iconografia indicadores-04.png">
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br><br>
            <img style="width: 40%;" src="images/resultado/icones soltos_8_agricultores.png"><b style="color: lightsteelblue; font-size: 23px;">&nbsp;em análise</b><p style="color: darkblue;">camponeses e/ou pastores reportaram ter utilizado pelo menos uma das práticas de produção sustentável disseminadas no âmbito projecto</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Cunene<br>em análise</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Huíla<br>em análise</b></div>
                <div class="col-4" style="text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Namibe<br>em análise</b></div>
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br><br>
            <img style="width: 45.7%;" src="images/resultado/icones soltos_12_prosperidade.png"><b style="color: lightsteelblue; font-size: 23px;">&nbsp;em análise</b><p style="color: darkblue;">hectares de ecossistemas agro-pastoris com integração das práticas sustentáveis nas terras dos beneficiários directos com o apoio do projecto </p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Cunene<br>em análise</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Huíla<br>em análise</b></div>
                <div class="col-4" style="text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Namibe<br>em análise</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br><br>
            <img style="width: 30.7%;" src="images/resultado/iconografia indicadores-10.png"><b style="color: darkblue; font-size: 23px;">&nbsp;267 de 300</b><p style="color: darkblue;">ECA, ECAP e outros campos agro-pecuários de aprendizagem capacitados em práticas tradicionais e tecnologias adaptadas às alterações climáticas</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>89 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 89,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>91</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>128</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>48</b></div>
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br><br>
            <img style="width: 20%;" src="images/resultado/icones soltos_23_agricultura_sementes.png"><b style="color: darkblue; font-size: 23px;">&nbsp;270 de 224</b><p style="color: darkblue;">hectares foram cultivados com tecnologia inovadora e métodos adequados disseminados pelo projecto para reforçar a produtividade nos campos</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>>100 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>152</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>81</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>37</b></div>
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br><br>
            <img style="width: 23.5%;" src="images/resultado/iconografia indicadores-12.png"><b style="color: darkblue; font-size: 23px;">&nbsp;16.124 de 10.500</b><p style="color: darkblue;">camponeses e pastores apoiados pelo projecto para melhorar a produtividade e a resiliência dos sistemas agrícolas e pecuários (H: 7.238; M: 8.886)</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>>100 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>4.001</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>9.487</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>2.636</b></div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br><br>
            <img style="width: 20.5%;" src="images/resultado/iconografia indicadores-15.png"><b style="color: darkblue; font-size: 23px;">&nbsp;204 de 200</b><p style="color: darkblue;">cooperativas, associações e redes de agricultores e pastores apoiadas para geração de rendimentos</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>>100 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>67</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>102</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>35</b></div>
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br><br>
            <img style="width: 28.2%;" src="images/resultado/icones soltos_40_escritorio.png"><b style="color: darkblue; font-size: 23px;">&nbsp;10.711 de 10.000</b><p style="color: darkblue;">membros de cooperativas/associações capacitados em gestão e organização (H: 4.760; M:5.951)</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>>100 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>2.998</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>6.039</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>1.674</b></div>
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br><br>
            <img style="width: 20.5%;" src="images/resultado/iconografia indicadores-32.png"><b style="color: darkblue; font-size: 23px;">&nbsp;27 de 50</b><p style="color: darkblue;">cooperativas, associações e redes de agricultores e pastores encontram-se formalizadas</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>54 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 54,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>4</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>17</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>6</b></div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br><br>
            <img style="width: 24.7%;" src="images/resultado/iconografia indicadores-17.png"><b style="color: darkblue; font-size: 23px;">&nbsp;&nbsp;43 de 60</b><p style="color: darkblue;">iniciativas de transformação e de processamento apoiadas pelo projecto</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>72 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 72,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>5</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>33</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>5</b></div>
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br><br>
            <img style="width: 22.4%;" src="images/resultado/iconografia indicadores-35.png"><b style="color: darkblue; font-size: 23px;">&nbsp;3.467 de 1.750</b><p style="color: darkblue;">camponeses apoiados na comercialização de produtos transformados</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>>100 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>981</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>2.388</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>98</b></div>
            </div>
        </div>
    </div>
    <br><br>
</section>
<!-- Agricultura -->


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
    <br><br>
</section>
<!-- Nutrição -->


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
        </div>
    </div>
    <br><br>
</section>
<!-- Água -->


<!--/ Reforço Institucional -->
<section class="container" style="background-color: white;">
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <div class="text-center">
                <div style="border-style: solid; border-color: #888C00; border-width: 1.5px;">
                    <p style="text-align: center; color: #888C00; line-height: 28px"><b>REFORÇO INSTITUCIONAL E GESTÃO DE INFORMAÇÃO MULTISSECTORIAL [COMPONENTE III]</b><br>
                        <img style="width: 10%;" src="images/resultado/elemento4.png"><br>Compilar e reorganizar os mecanismos em matéria de segurança alimentar e nutricional e de alterações climáticas</p>
                </div>
                <img style="width: 34%;" src="images/resultado/Iconografia principal_Parceiros Governamentais.png">
                <img style="width: 35%;" src="images/resultado/iconografia indicadores-07.png">
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 20.2%;" src="images/resultado/Iconografia principal_Modulo 2.png"><b style="color: lightsteelblue; font-size: 23px;">&nbsp;em análise</b><p style="color: darkblue;">administrações municipais integram políticas para mitigar as alterações climáticas e a inSAN</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Cunene<br>em análise</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Huíla<br>em análise</b></div>
                <div class="col-4" style="text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Namibe<br>em análise</b></div>
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 18.5%;" src="images/resultado/iconografia indicadores-29.png"><b style="color: lightsteelblue; font-size: 23px;">&nbsp;em análise</b><p style="color: darkblue;">acções realizadas pelos governos para o combate às alterações climáticas e a inSAN</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Cunene<br>em análise</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Huíla<br>em análise</b></div>
                <div class="col-4" style="text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Namibe<br>em análise</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 20.1%;" src="images/resultado/Iconografia principal_Estudos e diagnosticos.png"><b style="color: darkblue; font-size: 23px;">&nbsp;0 de 20</b><p style="color: darkblue;">plataformas e mecanismos estabelecidos em segurança alimentar e nutricional e resiliência</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>0</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>0</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>0</b></div>
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 59%;" src="images/resultado/icones soltos_12_conferencias.png"><b style="color: darkblue; font-size: 23px;">&nbsp;0 de 32</b><p style="color: darkblue;">reuniões de coordenação multissectorial para promover a segurança alimentar e nutricional</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>0</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>0</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>0</b></div>
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 20.1%;" src="images/resultado/Iconografia alternativa_icones alternativos_formacao.png"><b style="color: darkblue; font-size: 23px;">&nbsp;0 de 30</b><p style="color: darkblue;">acções de capacitação realizadas no âmbito do apoio à inSAN e resiliência</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>0</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>0</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>0</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 20%;" src="images/resultado/Iconografia principal_Contratacoes.png"><b style="color: darkblue; font-size: 23px;">&nbsp;699 de 630</b><p style="color: darkblue;">agentes de extensão formados em SAN e resiliência e pecuária (ACS: 417; TG: 282)</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>>100 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>304</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>252</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>143</b></div>
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 20%;" src="images/resultado/Iconografia principal_Contratacoes.png"><b style="color: darkblue; font-size: 23px;">&nbsp;747 de 760</b><p style="color: darkblue;">funcionários públicos formados em segurança alimentar e nutricional e resiliência (Saúde: 747)</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>98 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 98,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>301</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>212</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>234</b></div>
            </div>
        </div> 
        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 16.8%;" src="images/resultado/iconografia indicadores-32.png"><b style="color: lightsteelblue; font-size: 23px;">&nbsp;em análise</b><p style="color: darkblue;">agentes de extensão e funcionários públicos com formação em SAN e resiliência satisfeitos</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Cunene<br>em análise</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Huíla<br>em análise</b></div>
                <div class="col-4" style="text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Namibe<br>em análise</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 20%;" src="images/resultado/Iconografia alternativa_icones alternativos_estacao zootecnica.png"><b style="color: darkblue; font-size: 23px;">&nbsp;17 de 19</b><p style="color: darkblue;">institutos equipados com conhecimento para apoiar a resiliência e SAN</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>89 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 89,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>5</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>5</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>7</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 15.4%;" src="images/resultado/iconografia indicadores-13.png"><b style="color: darkblue; font-size: 23px;">&nbsp;17 de 17</b><p style="color: darkblue;">municípios com perfis de vulnerabilidade definidos (critérios ENSAN / AVSAN)</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>100 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>6</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>6</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>5</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 29.2%;" src="images/resultado/icones soltos_39_escritorio.png"><b style="color: darkblue; font-size: 23px;">&nbsp;23 de 17</b><p style="color: darkblue;">Planos de Desenvolvimento Municipal sensíveis à SAN e resiliência elaborados</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>>100 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>6</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>12</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>5</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 21%;" src="images/resultado/sisan.png"><b style="color: darkblue; font-size: 23px;">&nbsp;0 de 1</b><p style="color: darkblue;">Sistema de Informação e Alerta Rápido para SAN (SISAN) criado pelo projecto e operacional</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>0</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>0</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>0</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 20%;" src="images/resultado/iconografia indicadores-08.png"><b style="color: darkblue; font-size: 23px;">&nbsp;0 de 24</b><p style="color: darkblue;">produtos de divulgação sobre a situação da SAN nas três províncias FRESAN</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>0</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>0</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>0</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 14.4%;" src="images/resultado/alteracoes_climaticas.png"><b style="color: darkblue; font-size: 23px;">&nbsp;0 de 1</b><p style="color: darkblue;">repositório digital sobre alterações climáticas em funcionamento no MINAMB</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>0</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>0</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>0</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 20%;" src="images/resultado/Iconografia alternativa_icones alternativos_formacao.png"><b style="color: darkblue; font-size: 23px;">&nbsp;8 de 30</b><p style="color: darkblue;">acções de capacitação em resiliência e alterações climáticas realizadas</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>27 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 27,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>1</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>1</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>6</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 20%;" src="images/resultado/Iconografia principal_Contratacoes.png"><b style="color: darkblue; font-size: 23px;">&nbsp;113 de 200</b><p style="color: darkblue;">agentes públicos formados em resiliência e alterações climáticas (H: 90; M: 23)</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>57 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 57,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>23</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>22</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>68</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 16.8%;" src="images/resultado/iconografia indicadores-32.png"><b style="color: lightsteelblue; font-size: 23px;">&nbsp;em análise</b><p style="color: darkblue;">agentes públicos formados, que encontram-se satisfeitos com a formação recebida</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Cunene<br>em análise</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Huíla<br>em análise</b></div>
                <div class="col-4" style="text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Namibe<br>em análise</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 20%;" src="images/resultado/Iconografia principal_Modulo 3.png"><b style="color: darkblue; font-size: 23px;">&nbsp;3 de 3</b><p style="color: darkblue;">gabinetes do MINAMB equipados para apoiar a resiliência e as alterações climáticas</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>1</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>1</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>1</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 29%;" src="images/resultado/icones soltos_24_agricultura_seca.png"><b style="color: darkblue; font-size: 23px;">&nbsp;35 de 51</b><p style="color: darkblue;">eventos e campanhas de sensibilização realizadas para as alterações climáticas</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>69 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 69,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>0</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>35</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>0</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 20%;" src="images/resultado/Iconografia principal_Contratacoes.png"><b style="color: darkblue; font-size: 23px;">&nbsp;115 de 115</b><p style="color: darkblue;">agentes formados em emergência pré-hospitalar (H: 83; M: 32)</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>100 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Cunene<br><b>33</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Huíla<br><b>41</b></div>
                <div class="col-4" style="text-align: center; color: darkblue; line-height: 20px; font-size: 15px;">Namibe<br><b>41</b></div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento"><br>
            <br>
            <img style="width: 16.8%;" src="images/resultado/iconografia indicadores-32.png"><b style="color: lightsteelblue; font-size: 23px;">&nbsp;em análise</b><p style="color: darkblue;">agentes da proteção civil e funcionários públicos satisfeitos com a formação recebida</p>
            <div class="bar" style="margin-top: -10px; line-height: 35px;"><div class="progressbar-text" style="color: darkblue; position: relative; right: 0px; padding: 0px; text-align: right; line-height: 0px;"><b>0 %</b></div><svg viewBox="0 0 100 4" preserveAspectRatio="none" style="width: 100%; height: 100%;"><path d="M 0,2 L 100,2" stroke="#7CB9E8" stroke-width="1" fill-opacity="0"></path><path d="M 0,2 L 0,2" stroke="#7CB9E8" stroke-width="4" fill-opacity="0" style="stroke-dasharray: 100, 100; stroke-dashoffset: 0;"></path></svg></div>
            <div class=" row">
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Cunene<br>em análise</b></div>
                <div class="col-4" style="border-right-color: #7CB9E8; border-right-style: solid; border-width: 1px; text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Huíla<br>em análise</b></div>
                <div class="col-4" style="text-align: center; color: lightsteelblue; line-height: 20px; font-size: 15px;"><b>Namibe<br>em análise</b></div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-md-7 evento">
            <div class=" row">
                <p style="text-align: right; line-height: 20px; font-size: 13px;"><br><br><br><br><br><br><br><br><b></b></p>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 evento">
            <div class=" row">
                <p style="text-align: right; line-height: 20px; font-size: 13px;"><br><br><br><br><br><br><br><br><b>Dados referentes ao período: 2018 a Dezembro de 2023<br>Publicação de dados: Fevereiro de 2024<br>Última actualização: Fevereiro de 2024</b><br><b style="font-size: 11px; color: gray">[Fonte: SGI FRESAN | Camões, I.P.]</b></p>
            </div>
        </div>
    </div>
    <!-- Reforço Institucional --> 
</section>