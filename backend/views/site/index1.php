
<?php

use backend\models\Localidade;
use backend\models\Municipio;
use backend\models\Provincia;
use yii\db\Query;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\models\Meta;
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

    <div style=" background-color: #003399;
        height: 1cm;">
        
</div>
<hr> 
<hr>   
<div class="container mt-5">
    <p style="font-size: 30px; color: #919733;"><strong>COMPONENTE I</strong></p>
    <p style="font-size: 20px; color: #003399;"><strong>FRESAN EM NÚMEROS / Resiliência e Produção Agrícola Familiar Sustentável
            I</strong></p>
    <p style="font-size: 20px; color: #003399; background-color: #ffffcc">PRODUTIVIDADE E RESILIÊNCIA DOS SISTEMAS AGRÍCOLAS
    </p>

    <div class="row" id="Linha1">
        <div class="col-md-3">
            <div id="ecas"></div>
            <div style="text-align: center;">
                <div>Meta</div>
                <div><?php echo $metaECA; ?></div>
            </div>
            <div class="expression">
                <div class="cunene"></div>
                Cunene <?php echo $totalEcaCunene; ?> &nbsp;
                <div class="huila"></div>
                Huila <?php echo $totalEcaHuila; ?> &nbsp;
                <div class="namibe"></div>
                Namibe <?php echo $totalEcaNamibe; ?> &nbsp;
            </div>
        </div>
        <div class="col-md-3">
            <div>
                <p><?php echo $totalEcas; ?> ECA/ECAP capacitadas em práticas tradicionais e tecnologias adaptadas às alterações climáticas</p>
                <p>* onde se incluem Escolas de Campo de Agricultores/Campos de Demonstração/Campos Comunitários/ Hortas Comunitárias/ Campos de Experimentação</p>
                <p>** Escolas de Campo de Agricultores e Pecuária</p>
            </div>
        </div>


        <div class="col-md-3" style="margin:0px; padding:0px">
            <div id="camponesesApoiados"></div>
            <div style="text-align: center;">
                <div>Meta</div>
                <div><?php echo $metacamponesesApoiados; ?></div>
            </div>
            <div class="expression">
                <div class="cunene"></div>
                Cunene <?php echo $totalCamponesesCunene; ?> &nbsp;
                <div class="huila"></div>
                Huila <?php echo $totalCamponesesHuila; ?> &nbsp;
                <div class="namibe"></div>
                Namibe <?php echo $totalCamponesesNamibe; ?>
            </div>
        </div>
        <div class="col-md-3" style="margin:0px; padding:0px">
            <div>
                <?php echo $totalcamponesesApoiados; ?> camponeses/as 
                apoiados através de ECA/ECAP para 
                melhorar a produtividade e resiliência dos 
                sistemas agrícolas e pecuários no contexto 
                das alterações climáticas
            </div>
            <div id="stacked-bar-chart"></div>
        </div>

    </div>
    <hr><!-- comment -->

    <div class="row" id="Linha2">
        <div class="col-md-3">
            <div id="formacao"></div>
            <div style="text-align: center;">
                <div>Meta</div>
                <div><?php echo $metaaPartiFormAgri; ?>*</div>
            </div>
            <div class="expression">
                <div class="cunene"></div>
                Cunene 20 |
                <div class="huila"></div>
                Huila 30 |
                <div class="namibe"></div>
                Namibe 35 |
            </div>
        </div>
        <div class="col-md-3">
            <div>
                293 participantes de 
                formações para prestação
                de serviços de apoio aos 
                agricultores (técnicos do IDA e do ISV, 
                facilitadores, técnicos de campo)
                <p>* Meta alterada para 324 tendo em conta a última 
                    adenda ao projecto assinada no final de 2022</p>

            </div>
        </div>


        <div class="col-md-3">
            <div id="familiasApoiados"></div>
            <div style="text-align: center;">
                <div>Metas</div>
                <div><?php echo $metaaApoioFamilias; ?></div>
            </div>
            <div class="expression">
                <div class="cunene"></div>
                Cunene 20 |
                <div class="huila"></div>
                Huila 30 |
                <div class="namibe"></div>
                Namibe 35 |
            </div>
        </div>
        <div class="col-md-3">
            <div>
                1.606 famílias 
                camponesas apoiadas em 
                práticas e materiais de armazenamento 
                (silos) e transformação de alimentos
            </div>
            <div id="stacked-bar-chart"></div>
        </div>

    </div>
    <hr><!-- comment -->

    <div class="row" id="Linha3">
        <div class="col-md-3">
            <div id="formacao"></div>
            <div style="text-align: center;">
                <div>  sessões de formação
                    <p>realizadas nas ECA/ECAP</p></div>
            </div>
            <div class="expression">
                <div class="cunene"></div>
                Cunene 20 |
                <div class="huila"></div>
                Huila 30 |
                <div class="namibe"></div>
                Namibe 35 |
            </div>
        </div>
        <div class="col-md-3">
            <div>
                <!--            sessões de formação
                            <p>realizadas nas ECA/ECAP</p>-->

            </div>
        </div>


        <div class="col-md-3">
            <div id="familiasApoiados"></div>
            <div style="text-align: center;">
                <div>hectares cultivados
                    <p>nas ECA/ECAP/horta/campo</p></div>

            </div>
            <div class="expression">
                <div class="cunene"></div>
                Cunene 20 |
                <div class="huila"></div>
                Huila 30 |
                <div class="namibe"></div>
                Namibe 35 |
            </div>
        </div>
        <div class="col-md-3">
            <div>
                <!--            hectares cultivados
                            <p>nas ECA/ECAP/horta/campo</p>-->
            </div>
            <div id="stacked-bar-chart"></div>
        </div>

    </div>
    <hr><!-- comment -->

    <p style="font-size: 20px; color: #003399; background-color: #ffffcc">APOIO AO ISV NAS CAMPANHAS DE VACINAÇÃO BOVINA</p>

    <div class="row" id="Linha4">
        <div class="col-md-3">
            <div id="formacao"></div>
            <div style="text-align: center;">
                <div>            tratadores de gado formados</div>
                <div id="stacked-bar-chartGados"></div>
            </div>
            <div class="expression">
                <div class="cunene"></div>
                Cunene 20 |
                <div class="huila"></div>
                Huila 30 |
                <div class="namibe"></div>
                Namibe 35 |
            </div>
        </div>
        <div class="col-md-3">
            <div>
                <!--            tratadores de gado formados-->


            </div>
        </div>


        <div class="col-md-3">
            <div id="familiasApoiados"></div>
            <div style="text-align: center;">
                <div> bovinos vacinados
                    pelo ISV com o apoio do FRESAN</div>

            </div>
            <div class="expression">
                <div class="cunene"></div>
                Cunene 20 |
                <div class="huila"></div>
                Huila 30 |
                <div class="namibe"></div>
                Namibe 35 |
            </div>
        </div>
        <div class="col-md-3">
            <div>
                <!--            bovinos vacinados
                            pelo ISV com o apoio do FRESAN-->

            </div>
            <div id="stacked-bar-chart"></div>
        </div>

    </div>
    <hr><!-- comment -->
    <p style="font-size: 30px; color: #919733;"><strong>COMPONENTE II</strong></p>
    <p style="font-size: 20px; color: #003399;"><strong>Melhoria da Nutrição Através de Transferências Sociais Centradas na Nutrição e Educação: Água</strong></p>


    <div class="row" id="Linha1">
        <div class="col-md-3">
            <div>  <p style="font-size: 20px; color: #003399; background-color: #ffffcc">REABILITAÇÃO/CONSTRUÇÃO DE PONTOS DE ÁGUA
                </p></div>
            <div id="benTransSoc"></div>
            <div style="text-align: center;">
                <div>Metas</div>
                <div><?php echo $metaBenTransSoci; ?></div>
            </div>
            <div class="expression">
                <div class="cunene"></div>
                Cunene <?php echo $totalBenTraSocCunene; ?>
                <div class="huila"></div>
                Huila <?php echo $totalBenTraSocHuila; ?>
                <div class="namibe"></div>
                Namibe <?php echo $totalBenTraSocNamibe; ?>
            </div>
        </div>
        <div class="col-md-3">
            <div>
                <?php echo $totalBenTranSoc; ?> beneficiários de “transferências sociais” no âmbito da construção/reabilitação dos pontos de água
            </div>
            <div id="stacked-bar-chart"></div>
        </div>



        <div class="col-md-3">
            <div>  <p style="font-size: 20px; color: #003399; background-color: #ffffcc">FRESAN EM NÚMEROS
                </p></div>
            <div id="infraestrutura"></div>
            <div style="text-align: center;">
                <div>Metas</div>
                <div><?php echo $metaInfraestrutura; ?></div>
            </div>
            <div class="expression">
                <div class="cunene"></div>
                Cunene <?php echo $totalInfraestCunene; ?>
                <div class="huila"></div>
                Huila <?php echo $totalInfraestHuila; ?>
                <div class="namibe"></div>
                Namibe <?php echo $totaInfraestNamibe; ?>
            </div>
        </div>
        <div class="col-md-3">
            <div>
                <?php echo $totalInfraEstrHidraulica; ?> pequenas
                infra-estruturas de irrigação, captação e acesso à água construídas ou reabilitadas            </div>
            <div id="stacked-bar-chart"></div>
        </div>

    </div>
    <div>  <p style="font-size: 20px; color: #003399; background-color: #ffffcc"> BENEFICIÁRIOS DIRECTOS E GESTÃO DOS PONTOS DE ÁGUA</p></div>

    <div class="row" id="Linha2">
        <div class="col-md-4">
            <p style="font-size: 20px; color: #003399;"><strong> <?php echo number_format($totalPessoa, 2, ',', '.'); ?>  Pessoas </strong></p>
            <div class="expression">
                <div class="cunene"></div>
                Cunene <?php echo number_format($totalPessoaCunene, 2, ',', '.'); ?>
                <div class="huila"></div>
                Huila <?php echo number_format($totalPessoaHuila, 2, ',', '.'); ?>
                <div class="namibe"></div>
                Namibe <?php echo number_format($totalPessoaNamibe, 2, ',', '.'); ?>
            </div>
        </div>
        <div class="col-md-2">
            <div>
            </div>
        </div>

        <div class="col-md-4">
            <p style="font-size: 20px; color: #003399;"><strong>  <?php echo number_format($totalIrrigados, 2, ',', '.'); ?> Irrigados </strong></p>
            <div class="expression">
                <div class="cunene"></div>
                Cunene <?php echo number_format($totalIrrigadosCunene, 2, ',', '.'); ?>
                <div class="huila"></div>
                Huila <?php echo number_format($totalIrrigadosHuila, 2, ',', '.'); ?>
                <div class="namibe"></div>
                Namibe <?php echo number_format($totaIrrigadosNamibe, 2, ',', '.'); ?>
            </div>
        </div>
        <div class="col-md-2">
            <div>
            </div>
        </div>

    </div>

    <hr>
    <div class="row" id="Linha3">
        <div class="col-md-4">
            <p style="font-size: 20px; color: #003399;"><strong> <?php echo number_format($totalAnimal, 2, ',', '.'); ?> animais </strong></p>
            <div class="expression">
                <div class="cunene"></div>
                Cunene <?php echo number_format($totalAnimalCunene, 2, ',', '.'); ?>
                <div class="huila"></div>
                Huila <?php echo number_format($totalAnimalHuila, 2, ',', '.'); ?>
                <div class="namibe"></div>
                Namibe <?php echo number_format($totaAnimalNamibe, 2, ',', '.'); ?>
            </div>
        </div>
        <div class="col-md-2">
            <div>
            </div>
        </div>

        <div class="col-md-4">
            <p style="font-size: 20px; color: #003399;"><strong> <?php echo number_format($totalGrupoAguas, 0, ',', '.'); ?> grupos de água e saneamento </strong></p>
            <div class="expression">
                <div class="cunene"></div>
                Cunene <?php echo number_format($totalBenTraSocCunene, 2, ',', '.'); ?>
                <div class="huila"></div>
                Huila <?php echo number_format($totalBenTraSocHuila, 2, ',', '.'); ?>
                <div class="namibe"></div>
                Namibe <?php echo number_format($totalBenTraSocNamibe, 2, ',', '.'); ?>
            </div>
        </div>
        <div class="col-md-2">
            <div>
            </div>
        </div>

    </div>

    <hr>

    <p style="font-size: 20px; color: #003399;"><strong>Melhoria da Nutrição Através de Transferências Sociais 
            Centradas na Nutrição e Educação: Nutrição
        </strong></p>

    <div class="row">
        <div class="col-md-4">
            <p style="font-size: 20px; color: #003399; background-color: #ffffcc">FORMAÇÃO PARA O REFORÇO DOS SERVIÇOS DE NUTRIÇÃO

            </p>

        </div>
        <div class="col-md-4">
            <p style="font-size: 20px; color: #003399;"><strong>FRESAN EM NÚMEROS </strong></p>



        </div>
        <div class="col-md-4">

        </div>
    </div>      

    <p style="font-size: 20px; color: #003399; background-color: #ffffcc">RASTREIO E SENSIBILIZAÇÃO COMUNITÁRIAS EM NUTRIÇÃO

    </p> 




    <hr><!-- comment -->
    <p style="font-size: 30px; color: #919733;"><strong>COMPONENTE III</strong></p>
    <p style="font-size: 20px; color: #003399;"><strong>FRESAN EM NÚMEROS / Reforço Institucional e Gestão de Informação Multissectorial
        </strong></p>

    <p style="font-size: 20px; color: #003399; background-color: #ffffcc">CAPACITAÇÃO E FORMAÇÃO DE QUADROS PÚBLICOS
    </p>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">


        </div>
        <div class="col-md-4">

        </div>
    </div>

    <p style="font-size: 20px; color: #003399; background-color: #ffffcc">INSTRUMENTOS PARA A GESTÃO DE INFORMAÇÃO MULTISSECTORIAL

    </p>
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">


        </div>
        <div class="col-md-4">

        </div>
    </div>
    <hr><!-- comment -->
    <p style="font-size: 30px; color: #919733;"><strong>COMPONENTE IV</strong></p>
    <p style="font-size: 20px; color: #003399;"><strong>Identificação, Análise e Divulgação de Acções Promotoras da Nutrição
            Com Uma Adequada Relação Custo-Benefício</strong></p>
</div>