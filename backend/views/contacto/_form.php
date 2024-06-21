<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Provincia;

/** @var yii\web\View $this */
/** @var backend\models\Contacto $model */
/** @var yii\widgets\ActiveForm $form */
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contactos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

$provincias = Provincia::find()->all();
$provinciasList = [];
foreach ($provincias as $provincia) {
    $provinciasList[$provincia->Id] = $provincia->nomeProvincia; // Supondo que o nome da província está na coluna 'nome'
}
?>
<style>
    .has-error .help-block {
        color: red;
    }
</style>

<div class="contacto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'funcao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'instituicao')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contacto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pais')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'provinciaID')->dropDownList($provinciasList, ['prompt' => 'Selecione a província', 'id' => 'provincia-select']) ?>

    <!-- Dropdown para Município -->
    <?= $form->field($model, 'municipioID')->dropDownList([], ['prompt' => 'Selecione o município', 'id' => 'municipio-select']) ?>

    <!-- Dropdown para Comuna -->
    <?= $form->field($model, 'comunaID')->dropDownList([], ['prompt' => 'Selecione a comuna', 'id' => 'comuna-select']) ?>

    <?= $form->field($model, 'localidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pontofocal')->textInput(['maxlength' => true]) ?>

   

    <?= $form->field($model, 'actividades')->widget(\kartik\select2\Select2::classname(), [
    'data' => [
        'AVSAN' => 'AVSAN',
        'AIDI' => 'AIDI',
        'BA' => 'FM',
        'CDP' => 'CDP',
        'CVB' => 'CVB',
        'FM' => 'FM',
        'GC' => 'GC',
        'GTCun' => 'GTCun',
        'GTHuila' => 'GTHuila',
        'GTNam' => 'GTNam',
        'IPC' => 'IPC',
        'NEWSL' => 'NEWSL',
        'RI' => 'RI',
        'Subvenções' => 'Subvenções',
    ],
    'options' => [
        'placeholder' => 'Selecione as atividades...',
        'multiple' => true,
        'id' => 'select-actividades',
    ],
    'pluginOptions' => [
        'allowClear' => true,
    ],
]) ?>
  <!--$form->field($model, 'actividades')->hiddenInput(['id' => 'hidden-actividades'])->label(false)-->


   <?= $form->field($model, 'entidade')->dropDownList([
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
                        ['prompt' => 'Selecione a Entidade'])
                ?>

    <?= $form->field($model, 'nivel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rotulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'observacao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'privacidade')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
<?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
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
                url: 'contacto/get-municipios',
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
            url: 'contacto/get-comunas',
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
    // Função para atualizar o campo de texto oculto
    function updateHiddenField() {
        var selected = $('#select-actividades').val(); // Obter as seleções atuais
        $('#hidden-actividades').val(selected ? selected.join(', ') : ''); // Atualizar o campo oculto com a string
    }

    // Inicializar o campo oculto com as seleções atuais (caso haja alguma)
    updateHiddenField();

    // Eventos do Select2
    $('#select-actividades').on('select2:select select2:unselect', function() {
        updateHiddenField();
    });
});
JS;
$this->registerJs($script);
?>



<?php
$this->registerJs("
    $('#contactos-contacto').inputmask({
        mask: '+99999999999999',
        placeholder: '',
        showMaskOnHover: false,
        showMaskOnFocus: true
    });
");
?>

