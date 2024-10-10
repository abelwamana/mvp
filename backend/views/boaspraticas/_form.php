<style>
     .has-error .help-block {
        color: red;
    }
</style>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var backend\models\Boaspraticas $model */
/** @var yii\widgets\ActiveForm $form */
$areas = [
    "Agricultura" => "Agricultura",
    "Nutrição" => "Nutrição",
    "Água" => "Água",
    "Reforço Institucional" => "Reforço Institucional",
    "Outras" => "Outras"
];
?>

<div class="boaspraticas-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php if (!$model->isNewRecord): ?>
        <img src="/admin/images/boaspraticas/<?= $model->fotografia ?>" alt="Boa Prática" style="width:50%">
    <?php endif; ?>

    <?= $form->field($model, 'boapratica')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'justificacao')->textInput(['maxlength' => true])->textarea(['rows' => 6]) ?>

    <?=
    $form->field($model, 'area')->widget(Select2::classname(), [
        'data' => $areas,
        'options' => ['placeholder' => 'Selecione as áreas...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);
    ?>


    <?= $form->field($model, 'provinciaID')->dropDownList($provinciasList, ['prompt' => 'Selecione a província', 'id' => 'provincia-select']) ?>

    <?= $form->field($model, 'municipioID')->dropDownList([], ['prompt' => 'Selecione o município', 'id' => 'municipio-select']) ?>

    <!-- Dropdown para Comuna -->
    <?= $form->field($model, 'comunaID')->dropDownList([], ['prompt' => 'Selecione a comuna', 'id' => 'comuna-select']) ?>


    <?= $form->field($model, 'localidade')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entidadepropoente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'entidadeimplementadora')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fotoFile')->fileInput() ?>

    <?= $form->field($model, 'recomendacoesID')->textInput() ?>

    <?= $form->field($model, 'estrategia_de_sustentabilidadeID')->textInput() ?>

        <?= $form->field($model, 'arquivoID')->textInput() ?>

    <div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
<?php if (!$model->isNewRecord): ?>
<?php
// Verificar se os campos estão definidos e atribuir valores corretamente
$municipioID = $model->municipioID ?? 'null';
$comunaID = $model->comunaID ?? 'null';
$provinciaID = $model->provinciaID ?? 'null';

$script = <<< JS
$(document).ready(function(){
    // Preencher município e comuna com valores do modelo
    var municipioID = $municipioID;
    var comunaID = $comunaID;
    var provinciaID = $provinciaID;
    
    // Verificar se provinciaID possui valor válido
    if(provinciaID && provinciaID !== 'null'){
        $.ajax({
            type: 'GET',
            url: 'event/get-municipios',
            data: { id: provinciaID },
            dataType: 'json',
            success: function(data){
                $('#municipio-select').empty().append('<option value="">Selecione o município</option>');
                $.each(data, function(index, municipio) {
                    var selected = municipio.id == municipioID ? 'selected' : '';
                    $('#municipio-select').append('<option value="'+municipio.id+'" '+selected+'>'+municipio.nome+'</option>');
                });
                
                // Verificar se municipioID possui valor válido
                if(municipioID && municipioID !== 'null'){
                    $.ajax({
                        type: 'GET',
                        url: 'event/get-comunas',
                        data: { id: municipioID },
                        dataType: 'json',
                        success: function(data){
                            $('#comuna-select').empty().append('<option value="">Selecione a comuna</option>');
                            $.each(data, function(index, comuna) {
                                var selected = comuna.id == comunaID ? 'selected' : '';
                                $('#comuna-select').append('<option value="'+comuna.id+'" '+selected+'>'+comuna.nome+'</option>');
                            });
                        },
                        error: function() {
                            alert('Erro ao obter as comunas.');
                        }
                    });
                }
            },
            error: function() {
                alert('Erro ao obter os municípios.');
            }
        });
    }
});
JS;
$this->registerJs($script);
?>
<?php endif; ?>

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
