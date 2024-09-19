<style>
    .custom-button {
        height: 25%;  /*Defina a altura desejada para o botão */
        margin-top: 0%;
        right: 20px !important;
        margin-left: -40%;
        background-color: #999900;
        border-color: #999900;
        border-radius: 3px 3px 3px 3px;
        /*position: absolute;*/
    }
    .custom-button:hover {
        background-color: #999900; /* Defina a cor desejada quando o mouse estiver sobre o botão */
        border-color: #999900; /* Defina a cor da borda quando o mouse estiver sobre o botão */
    }
    .container{
        /*margin: 0%;*/
        margin-right: 5%;
        /*overflow-x: hidden;  esconde o scroll horizontal*/
        overflow-y: auto; /* permite o scroll vertical quando necessário */
    }

    /*    .container{
            position: relative;
            width: 100%;
            max-width: 100%;
        }*/

    .event-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .area-container {
        display: grid;
        grid-template-columns: 1fr;
        grid-auto-rows: min-content;
        gap: 10px;
    }

    .area-header {
        border-bottom: 1px solid #ccc;
        padding-bottom: 5px;
        margin-bottom: 5px;
    }

    .event-item {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        position:relative;
    }


    .legend {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #fff;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .event-color {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin-right: 5px;
    }
    .nao-mostra {
        display: none;
    }
    @media print {
        .nao-imprimi {
            display: none !important;
        }
        .imprimi {
            display: block;
        }
    }

</style>
<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use backend\models\Contacto;

//<!--<div class="col-6"  >-->
//    <!--</div>-->

$this->title = 'LISTA DE EVENTOS';
//$this->params['breadcrumbs'][] = $this->title;
$provincias = [
    'Cunene' => 'Cunene',
    'Huila' => 'Huila',
    'Namibe' => 'Namibe',
        // Adicione mais itens conforme necessário
];
$entidades = [
    'Camões, I.P. | ADESPOV/C4' => 'Camões, I.P. | ADESPOV/C4',
    'Camões, I.P. | ADPP/C1' => 'Camões, I.P. | ADPP/C1',
    'Camões, I.P. | ADRA/C4' => 'Camões, I.P. | ADRA/C4',
    'Camões, I.P. | COSPE/C1' => 'Camões, I.P. | COSPE/C1',
    'Camões, I.P. | CODESPA/C2' => 'Camões, I.P. | CODESPA/C2',
    'Camões, I.P. | CUAMM/C2' => 'Camões, I.P. | CUAMM/C2',
    'Camões, I.P. | CUAMM/C4' => 'Camões, I.P. | CUAMM/C4',
    'Camões, I.P. | DW/C1' => 'Camões, I.P. | DW/C1',
    'Camões, I.P. | DW/C4' => 'Camões, I.P. | DW/C4',
    'Camões, I.P. | FEC/C2' => 'Camões, I.P. | FEC/C2',
    'Camões, I.P. | FEC/C2' => 'Camões, I.P. | FEC/C4',
    'Camões, I.P. | NCA/C4' => 'Camões, I.P. | NCA/C1',
    'Camões, I.P. | NCA/C4' => 'Camões, I.P. | NCA/C4',
    'Camões, I.P. | PIN/C2' => 'Camões, I.P. | PIN/C2',
    'Camões, I.P. | PIN/C4' => 'Camões, I.P. | PIN/C4',
    'Camões, I.P. | TESE/C4' => 'Camões, I.P. | TESE/C4',
    'Camões, I.P. | UIC' => 'Camões, I.P. | UIC',
    'Camões, I.P. | WVI/C1' => 'Camões, I.P. | WVI/C1',
    'Camões, I.P. | WVI/C4' => 'Camões, I.P. | WVI/C4',
    'FAO' => 'FAO',
    'Governo' => 'Governo',
    'PNUD' => 'PNUD',
    'Vall d´Hebron' => 'Vall d´Hebron',
        // Adicione mais itens conforme necessário
];
$areas = [
    "Agricultura e Pecuária" => "Agricultura e Pecuária",
    "Nutrição" => "Nutrição",
    "Água" => "Água",
    "Reforço Institucional" => "Reforço Institucional",
    "Coordenação UIC" => "Coordenação UIC",
    'M&A/Subvenções' => 'M&A/Subvenções',
     "Governo" => "Governo",
    "Outras" => "Outras"
];
?>
<div class="container text-left" style="">
    <div class="nao-mostra imprimi">

        <div class="col-12 d-flex justify-content-between align-items-center">
            <div class="col-6">  
                <?=
                Html::a(
                        '<img style="width: 145%;" src="images/logo221.png">',
                        ['/site/index']
                );
                ?>

            </div> 
            <!--<div class="col-6 text-right"  style="margin-right: -0%; ">-->  
            <img style="width: 3%; position: relative;" src="images/logo24.png">

        </div>
        <!--<div class="col-6" style="margin-right: -588px; position: relative" >  </div>-->
        <!--</div>-->

        <img style="width: 98%; max-width: 100%; margin-left:1.5%;" src="images/barra1.png">
    </div>
</div>
<div class="container">
    <h3 class="imprimi" style="text-align: center !important; "><b><?= Html::encode($this->title) ?> | TOTAL</b></h3>
    <div><br></div>
    <div class="nao-imprimi">
        <div class="row align-items-center" style="margin-left: 0.9%; max-width: 99.7%;">    
            <div class="col-md-2">
                <?= Html::beginForm(['event/get-events'], 'get', ['id' => 'filter-form']) ?>
                <?=
                Select2::widget([
                    'name' => 'provincias',
                    'id' => 'provincias',
                    'value' => '',
                    'data' => $provincias,
                    'options' => ['multiple' => true, 'placeholder' => 'Província(s)'],
                    'pluginOptions' => [
                        'width' => '93%', // Defina a largura desejada em pixels
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-2"style="margin-left:-2.3%;">
                <?=
                Select2::widget([
                    'name' => 'entidades',
                    'id' => 'entidades',
                    'value' => '',
                    'data' => $entidades,
                    'options' => ['multiple' => true, 'placeholder' => 'Entidade(s)'],
                    'pluginOptions' => [
                        'width' => '218%', // Defina a largura desejada em pixels
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-2" style="margin-left:16.85%;">
                <?=
                Select2::widget([
                    'name' => 'areas',
                    'id' => 'areas',
                    'value' => '',
                    'data' => $areas,
                    'options' => ['multiple' => true, 'placeholder' => 'Área(s)'],
                    'pluginOptions' => [
                        'width' => '188%', // Defina a largura desejada em pixels
                    ],
                ]);
                ?>
            </div>
            <div class="col-md-2" style="margin-left:12.2%;">
                <?=
                DatePicker::widget([
                    'name' => 'dataInicio',
                    'id' => 'data-inicio',
                    'options' => [
                        'class' => 'form-control', 'placeholder' => 'Data Início',
                        'style' => 'width: 55%;border-right: none;',
                    ],
                    'dateFormat' => 'yyyy-MM-dd',
                ]);
                ?>
            </div>
            <div class="col-md-2" style="margin-left: -105px; text-align: left; width: auto; max-width: fit-content;">
                <div class="d-inline-block" style="width: 100%;">
                    <?=
                    DatePicker::widget([
                        'name' => 'dataFim',
                        'id' => 'data-fim',
                        'options' => [
                            'class' => 'form-control', 'placeholder' => 'Data Fim',
                            'style' => 'width: 97px; border-left: none;',
                        ],
                        'dateFormat' => 'yyyy-MM-dd',
                    ]);
                    ?>
                </div>
            </div>


            <!--            <div class="col-md-2" style=" margin-left:-108px;">-->
            <div class="d-inline-block" > <!-- Adicionando a classe d-inline-block -->
                <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary custom-button float-right', 'id' => 'filter-btn']) ?>
                <?= Html::endForm() ?>
            </div>
            <!--            </div>-->
        </div>
    </div>

    <!--</div>-->



    <div style="position: relative;">


        <ul>
            <?php
            // Defina a ordem desejada das áreas
            $areaOrdem = [
                "Agricultura e Pecuária",
                "Nutrição",
                "Água",
                "Reforço Institucional",
                "Coordenação UIC",
                'Subvenções/M&A',
                'Governo',
                "Outras"
            ];

            // Crie um array associativo para agrupar eventos por área
            $eventosPorArea = [];

            // Agrupe os eventos por área
            foreach ($eventos as $evento) {
                $area = $evento->area;
                if (!isset($eventosPorArea[$area])) {
                    $eventosPorArea[$area] = [];
                }
                $eventosPorArea[$area][] = $evento;
            }

            // Ordene o array associativo com base na ordem das áreas desejada
            $eventosPorAreaOrdenados = [];

            // Itere sobre a ordem das áreas desejada
            foreach ($areaOrdem as $areaDesejada) {
                if (isset($eventosPorArea[$areaDesejada])) {
                    // Adicione os eventos dessa área na ordem desejada
                    $eventosPorAreaOrdenados[$areaDesejada] = $eventosPorArea[$areaDesejada];
                    // Remova a área do array original para evitar duplicações
                    unset($eventosPorArea[$areaDesejada]);
                }
            }

            // Cores associadas a cada área
            $areaCores = [
                "Agricultura e Pecuária" => "#999900",
                "Nutrição" => "#cccc33",
                "Água" => "#00c3ff",
                "Coordenação UIC" => "#71b13c",
                "Subvenções/M&A" => "#663399",
                "Outras" => "black",
                "Governo"=>"#BB0E22",
                "Reforço Institucional" => "#003399"
            ];
            ?>
            <div><br></div>

            <?php
            foreach ($eventosPorAreaOrdenados as $area => $eventos) {
                echo '<h5 style="margin-left:-2%";><br><strong><span class="event-color" style="background-color: ' . $areaCores[$area] . '; width: 12px; height: 12px; display: inline-block;"></span> ' . Html::encode($area) . '</strong></h5><br>';
                echo '<div class="event-grid" style="margin-left:-2%";>';
                // Iterar sobre os eventos da área
                foreach ($eventos as $evento) {
                    echo '<div class="event-item">';
                    echo '<span style="color: #999900; font-weight: bold;">' . Html::encode($evento->summary) . '</span><br>';
                    echo '<span style="font-weight: bold;">Início:</span> ' . Html::encode($evento->start) . '<br>';
                    echo '<span style="font-weight: bold;">Fim:</span> ' . Html::encode($evento->end) . '<br>';
                    echo '<span style="font-weight: bold;">Duração:</span> ' . Html::encode($evento->duracao) . '<br>';
                    echo '<span style="font-weight: bold;">Descrição:</span> ' . Html::encode($evento->description) . '<br>';
                    echo '<span style="font-weight: bold;">Provincia:</span> ' . Html::encode($evento->provincia->nomeProvincia) . '<br>';
                    echo '<span style="font-weight: bold;">Município:</span> ' . Html::encode($evento->municipio->nomeMunicipio) . '<br>';
                    echo '<span style="font-weight: bold;">Comuna:</span> ' . Html::encode($evento->comuna->nomeComuna) . '<br>';
                    echo '<span style="font-weight: bold;">Local:</span> ' . Html::encode($evento->local) . '<br>';
                    echo '<span style="font-weight: bold;">Entidade Organizadora:</span> ' . Html::encode($evento->entidadeOrganizadora) . '<br>';
                    echo '<span style="font-weight: bold;">Convocado Por:</span> ' . Html::encode($evento->convocadoPor) . '<br>';
                    // Separar emails em um array
                    $emails = explode(',', $evento->participantes);
                    $nomes = [];

                    // Consultar a tabela Contacto para cada email e recuperar o nome
                    foreach ($emails as $email) {
                        $contato = Contacto::findOne(['email' => trim($email)]);
                        if ($contato) {
                            $nomes[] = $contato->nome;
                        }
                    }
                    // Exibir os nomes dos participantes
                    echo '<div class="participants-container" style="max-height: 200px; overflow-y: auto;">';
                    echo '<span style="font-weight: bold;">Convidados:</span> ' . implode(', ', $nomes) . '<br>';
                    echo '</div>';

                    echo '</div>';
                }
                echo ' </div>';
            }
            ?>

    </div>
</div>
<?php
//$script = <<< JS
//$(document).ready(function() {
//    // Ouça o evento de clique no botão de filtragem
//        
//    $('#filter-btn').click(function(e) {
//        alert("Experiencia");
//        e.preventDefault(); // Evite o comportamento padrão de enviar o formulário
//        // Obtenha os valores selecionados nos filtros
//        var entidadesSelecionadas = $('#entidades').val();
//        var provinciasSelecionadas = $('#provincias').val();
//        var areasSelecionadas = $('#areas').val(); // Adicione esta linha para obter as áreas selecionadas
//        // Faça uma chamada AJAX para a ação 'get-events' com os filtros como parâmetros
//        $.ajax({
//            url: 'get-events',
//            type: 'GET',
//            data: { entidades: entidadesSelecionadas, provincias: provinciasSelecionadas, areas: areasSelecionadas }, // Inclua as áreas selecionadas
//            success: function(response) {
//                // Atualize a lista de eventos com os eventos filtrados
//                $('#lista-eventos').html(response);
//            },
//            error: function(xhr, status, error) {
//                // Lide com erros, se necessário
//            }
//        });
//    });
//});
//JS;
//$this->registerJs($script);
//
?>
