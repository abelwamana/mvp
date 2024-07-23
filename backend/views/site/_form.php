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
    .fc-toolbar .fc-left
    {

        margin-left: -1.3%;
    }
    .fc-toolbar .fc-right
    {

        margin-right: -1.3%;
    }
    .container{
        position: relative;
        width: 100%;
        max-width: 100%;

    }
    .has-error .help-block {
        color: red;
    }
    .fc-center h2 {
        text-transform: uppercase;
    }
    .file-upload-label {
        display: block;
    }
    /* Reduzir o tamanho do texto "Nenhum ficheiro selecionado" */
    input#event-agenda {
        font-size: 12px;
    }
    input#event-actarelatorio {
        font-size: 12px;
    }
    input#event-listaparticipantes {
        font-size: 12px;
    }
    .anexos-section {
        margin-top: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .anexos-section h3 {
        margin-bottom: 15px;
      
    }
    .file-upload-label {
        font-weight: normal !important;
        text-decoration: underline;
        margin-top: -1%;
    }
    legend {
        font-weight: bold;
          font-size: 18px;
    }

</style>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\Contacto;

/** @var yii\web\View $this */
/** @var backend\models\Event $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'summary')->textInput(['placeholder' => 'Título do Evento']) ?>
    <?= $form->field($model, 'description')->textInput(['placeholder' => 'Breve enquadramento e público alvo']) ?>
    <?= $form->field($model, 'area')->dropDownList([
        'Agricultura e Pecuária' => 'Agricultura e Pecuária',
        'Nutrição' => 'Nutrição',
        'Água' => 'Água',
        'Reforço Institucional' => 'Reforço Institucional',
        'Coordenação UIC' => 'Coordenação UIC',
        'Subvenções/M&A' => 'Subvenções/M&A',
        'Governação' => 'Governação',
        'Outras' => 'Outras',
    ], ['prompt' => 'Selecione a área']) ?>
    <?= $form->field($model, 'start')->textInput(['id' => 'event-start', 'type' => 'datetime-local', 'placeholder' => 'Data e Hora de Início']) ?>
    <?= $form->field($model, 'end')->textInput(['id' => 'event-end', 'type' => 'datetime-local', 'placeholder' => 'Data e Hora de Término']) ?>
    <?= $form->field($model, 'duracao')->textInput(['id' => 'duracao-evento', 'readonly' => true]) ?>          
    <?= $form->field($model, 'provinciaID')->dropDownList($provinciasList, ['id' => 'provincia-select', 'prompt' => 'Selecione a província']) ?>
    <?= $form->field($model, 'municipioID')->dropDownList([], ['id' => 'municipio-select', 'prompt' => 'Selecione o município']) ?>
    <?= $form->field($model, 'comunaID')->dropDownList([], ['id' => 'comuna-select', 'prompt' => 'Selecione a comuna']) ?>
    <?= $form->field($model, 'local')->textInput(['placeholder' => 'Referência do local, Instituição, Sala etc., ou escreva REMOTO']) ?>
    <?= $form->field($model, 'coordenadas')->textInput(['placeholder' => 'Insere o pin de localização ou link da reunião']) ?>
    <?= $form->field($model, 'entidadeOrganizadora')->dropDownList([
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
        'Governação' => 'Governação',
        'PNUD' => 'PNUD',
        'Vall d´Hebron' => 'Vall d´Hebron'],
    ['prompt' => 'Selecione a Entidade']) ?>
    <?= $form->field($model, 'convocadoPor')->textInput() ?>
     <?=
                $form->field($model, 'participantes')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Contacto::find()->all(), 'email', 'nome'),
                    'options' => ['placeholder' => 'Selecione os participantes...', 'multiple' => true, 'id' => 'select-participantes'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
                ?>
                <!-- Seção de Anexos -->
                <fieldset>
                    <legend>Anexos</legend>

                    <?= $form->field($model, 'agenda', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
                    <?= $form->field($model, 'actaRelatorio', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
                    <?= $form->field($model, 'listaParticipantes', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
                </fieldset>
    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
                 <script>
                    function checkParticipantes() {
                        var participantes = $('#select-participantes').val();
                        if (!participantes || participantes.length === 0) {
                            // Define o valor para "Por confirmar em breve" se estiver vazio
                            $('#select-participantes').append(new Option("Por confirmar em breve", "Por confirmar em breve", true, true)).trigger('change');
                        }
                        return true;
                    }
                </script>
            

</div>
<?php
// JavaScript para atualizar os dropdownlists de municípios e comunas com base na província selecionada
$script = <<< JS
$(document).ready(function(){
    $('#provincia-select').change(function(){
        var provinciaID = $(this).val();
        
        if(provinciaID){
            $.ajax({
                type: 'GET',
                url: 'get-municipios',
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
            url: 'get-comunas',
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
