<style>
    .event-color {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin-right: 5px;
    }

    .custom-button {
        height: 38px;  /*Defina a altura desejada para o botão */
        margin-top:-46.5px;
        right: 110px !important;
        /*margin-right: 10px;*/
        background-color: #999900;
        border-color: #999900;
        border-radius: 3px 3px 3px 3px;
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
/*    .container{
        position: relative;
        width: 100%;
        max-width: 100%;
    }*/
    .has-error .help-block {
        color: red;
    }
    .fc-center h2 {
        text-transform: uppercase;
    }


</style>
<div class="container">
    <?php

    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use yii\bootstrap4\Alert;
    use yii\widgets\Breadcrumbs;
    use \yii2fullcalendar\yii2fullcalendar;
    use backend\controllers\SiteController;
    use backend\models\Event;
    use yii\helpers\ArrayHelper;
    use backend\models\Provincia;
    use yii\web\View;
    use kartik\select2\Select2;
    use yii\jui\DatePicker;

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
        'Camões, I.P. | CODESPA/C2' => 'Camões, I.P. | CODESPA/C2',
        'Camões, I.P. | CODESPA/C2' => 'Camões, I.P. | CODESPA/C4',
        'Camões, I.P. | COSPE/C1' => 'Camões, I.P. | COSPE/C1',
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
    ];
    $areas = [
        "Agricultura e Pecuária" => "Agricultura e Pecuária",
        "Nutrição" => "Nutrição",
        "Água" => "Água",
        "Reforço Institucional" => "Reforço Institucional",
        "Coordenação" => "Coordenação",
        'M&A/Subvenções' => 'M&A/Subvenções',
        "Outras" => "Outras"
    ];
    $this->title = 'Calendário';
    $nomeUsuario = Yii::$app->user->identity->nomeCompleto;
    ?>

    <div class="col-12 justify-content-between align-items-center" style="margin-top: 30px;">
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <?=
            Alert::widget([
                'options' => ['class' => 'alert-success'],
                'body' => Yii::$app->session->getFlash('success'),
            ])
            ?>

        <?php endif; ?>

        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <?=
            Alert::widget([
                'options' => ['class' => 'alert-danger'],
                'body' => Yii::$app->session->getFlash('error'),
            ])
            ?>
        <?php endif; ?>
        <div class="nao-mostra imprimi">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div class="col-6"  style="margin-left: -27px;">  
                    <?=
                    Html::a(
                            '<img style="width: 145%;" src="images/logo221.png">',
                            ['/site/index']
                    );
                    ?>

                </div> 
                <div class="col-6 text-right"  style="margin-right: 3px; ">  
                    <img style="width: 7%; margin-right:-15px; position: relative;" src="images/logo24.png">

                </div>
                <!--<div class="col-6" style="margin-right: -588px; position: relative" >  </div>-->
            </div>

            <img style="width: 100%; max-width: 100%;" src="images/barra1.png">
        </div>
        <!--<div class="col-12 style="margin-left: 230px;" style="margin-top: 16px;" >-->  
        <div class="imprimi">
            <div class="row align-items-center" style="margin-left: 1px; max-width: 99.7%;">    

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
                <div class="col-md-2"style="margin-left:-18px;">
                    <?=
                    Select2::widget([
                        'name' => 'entidades',
                        'id' => 'entidades',
                        'value' => '',
                        'data' => $entidades,
                        'options' => ['multiple' => true, 'placeholder' => 'Entidade(s)'],
                        'pluginOptions' => [
                            'width' => '180%', // Defina a largura desejada em pixels
                        ],
                    ]);
                    ?>
                </div>
                <div class="col-md-2" style="margin-left:11.7%;">
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
                <div class="col-md-2" style="margin-left:153px;">
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
                                'style' => 'width: 50%; border-left: none;',
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
        </div>        </div>

</div>
<div class="nao-mostra imprimi">
    <div class="col-6"  style = "position: absolute; margin-top: 12px;">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
</div>


</div > 

<?php
// JavaScript para atualizar os dropdownlists de municípios e comunas com base na província selecionada
$script = <<< JS
$(document).ready(function() {
    // Verifique se existem valores armazenados no armazenamento local e preencha os campos de filtro
    var provinciasSelecionadas = localStorage.getItem('provinciasSelecionadas');
    var entidadesSelecionadas = localStorage.getItem('entidadesSelecionadas');
    var areasSelecionadas = localStorage.getItem('areasSelecionadas');
    if (provinciasSelecionadas !== null) {
        $('#provincias').val(provinciasSelecionadas.split(',')).trigger('change');
        alert("provincia selected");
    }
    if (entidadesSelecionadas !== null) {
        $('#entidades').val(entidadesSelecionadas.split(',')).trigger('change');
    }
    if (areasSelecionadas !== null) {
        $('#areas').val(areasSelecionadas.split(',')).trigger('change');
    }

    // Ouça o evento de clique no botão "Filtrar"
    $('#filter-btn').click(function(e) {
        // Salve os valores dos campos de filtro no armazenamento local antes de enviar o formulário
        localStorage.setItem('provinciasSelecionadas', $('#provincias').val());
        localStorage.setItem('entidadesSelecionadas', $('#entidades').val());
        localStorage.setItem('areasSelecionadas', $('#areas').val());
    });
});
JS;

$script = <<< JS
$(document).ready(function() {
    // Ouça o evento de clique no botão de filtragem
    $('#filter-btn').click(function(e) {
        e.preventDefault(); // Evite o comportamento padrão de enviar o formulário
        // Obtenha os valores selecionados nos filtros
        var entidadesSelecionadas = $('#entidades').val();
        var provinciasSelecionadas = $('#provincias').val();
        var areasSelecionadas = $('#areas').val(); // Adicione esta linha para obter as áreas selecionadas
        // Faça uma chamada AJAX para a ação 'get-events' com os filtros como parâmetros
        $.ajax({
            url: 'get-events',
            type: 'GET',
            data: { entidades: entidadesSelecionadas, provincias: provinciasSelecionadas, areas: areasSelecionadas }, // Inclua as áreas selecionadas
            success: function(response) {
                // Remova a fonte de eventos atual antes de adicionar a nova fonte
                $('#meuCalendario').fullCalendar('removeEvents');
                // Adicione a nova fonte de eventos filtrados
                $('#meuCalendario').fullCalendar('addEventSource', response);
            },
            error: function(xhr, status, error) {
                // Lide com erros, se necessário
            }
        });
    });
});

JS;
$this->registerJs($script);
?>

<?php
// JavaScript para atualizar os dropdownlists de municípios e comunas com base na província selecionada
$script = <<< JS
$(document).ready(function(){
    $('#provincia-select').change(function(){
        var provinciaID = $(this).val();
        
        if(provinciaID){
            $.ajax({
                type: 'GET',
                url: 'site/get-municipios',
                data: {
                   id: provinciaID
                },
                dataType: 'json', // Especifica o tipo de dados esperado como JSON
                success: function(data){
                    // Limpa a dropdownlist de municípios
                    $('#municipio-select').empty();
                    // Adiciona a opção padrão
                    $('#municipio-select').append($('<option>', {
                        value: '',
                        text: 'Selecione o município'
                    }));
                    // Adiciona cada município retornado pela requisição AJAX à dropdownlist
                    $.each(data, function(index, municipio) {
                        $('#municipio-select').append($('<option>').text(municipio.nome).attr('value', municipio.id));
                    });
//                     $('#municipio-select').append($('<option>', {
//                        value: '',
//                        text: 'Outro'
//                    }));
                    // Limpa o conteúdo do elemento com id comuna-select
                    $('#comuna-select').html('<option value="">Selecione a comuna</option>');
                },
                error: function() {
                    // Trata erros caso ocorram na requisição AJAX
                    alert('Erro ao obter os municípios.');
                }
            });
        } else {
            // Limpa o conteúdo dos elementos município-select e comuna-select
            $('#municipio-select').html('<option value="">Selecione o município</option>');
            $('#comuna-select').html('<option value="">Selecione a comuna</option>');
        }
    });
        
        $('#municipio-select').change(function(){
    var municipioID = $(this).val();
        
    if(municipioID){
        $.ajax({
            type: 'GET',
            url: 'site/get-comunas',
            data: {
                id: municipioID
            },
             dataType: 'json', // Especifica o tipo de dados esperado como JSON
            success: function(data){            
                // Limpa a dropdownlist de comunas
                $('#comuna-select').empty();
                // Adiciona a opção padrão
                $('#comuna-select').append($('<option>', {
                    value: '',
                    text: 'Selecione a comuna'
                }));
                // Adiciona cada comuna retornada pela requisição AJAX à dropdownlist
                $.each(data, function(index, value) {
                    $('#comuna-select').append($('<option>').text(value.nome).attr('value', value.id));
                    
                });
            },
            error: function() {
                // Trata erros caso ocorram na requisição AJAX
                alert('Erro ao obter as comunas.');
            }
        });
    } else {
        // Limpa o conteúdo do elemento com id comuna-select
        $('#comuna-select').html('<option value="">Selecione a comuna</option>');
    }
});

        
});

JS;
$this->registerJs($script);
?>
<?php
$script = <<< JS
$(document).ready(function() {
    // Função para calcular a duração
    function calcularDuracao() {
        var start = $('#event-start').val();
        var end = $('#event-end').val();        
        $.ajax({
            url: 'site/duracao',
            type: 'GET',
            data: {
            start: start,
             end: end
            },
            success: function(response) {
                $('#duracao-evento').val(response + ' hora(s)');
            },
            error: function() {
                alert('Erro ao calcular a duração do evento.');
            }
        });
    }

    // Chamar a função ao alterar a data/hora de início
    $('#event-start').change(function() {
        calcularDuracao();
    });

    // Chamar a função ao alterar a data/hora de término
    $('#event-end').change(function() {
        calcularDuracao();
    });
});
        
JS;
$this->registerJs($script);
?>
<?php
$this->registerJs("
    // Função para verificar se a data de término é menor que a data de início
    function checkDateValidity() {
        var startDate = $('#event-start').val();
        var endDate = $('#event-end').val();

        if (startDate && endDate && endDate < startDate) {
            $('#addEventForm').yiiActiveForm('updateAttribute', 'event-end', ['A data de início deve ser anterior à data de término.']);
        } else {
            $('#addEventForm').yiiActiveForm('updateAttribute', 'event-end', '');
        }
    }

    // Chamar a função de verificação quando os campos de data forem alterados
    $('#event-start, #event-end').change(function() {
        checkDateValidity();
    });

    // Chamar a função de verificação quando o formulário for enviado
    $('#addEventForm').on('beforeSubmit', function() {
        checkDateValidity();
        return true; // Permitir que o formulário seja enviado
    });
");
?>
