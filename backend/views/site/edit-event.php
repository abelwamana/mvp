<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Event;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
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
        'Governo' => 'Governo',
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
        'Governo' => 'Governo',
        'PNUD' => 'PNUD',
        'Vall d´Hebron' => 'Vall d´Hebron'],
    ['prompt' => 'Selecione a Entidade']) ?>
    <?= $form->field($model, 'convocadoPor')->textInput() ?>
    <?= $form->field($model, 'participantes')->widget(\kartik\select2\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Contacto::find()->all(), 'email', 'nome'),
        'options' => ['placeholder' => 'Selecione os participantes...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar Evento', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
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
