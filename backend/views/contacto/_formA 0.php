<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Provincia;
use backend\models\Municipio;
use backend\models\Comuna;
use backend\models\Funcao;
use backend\controllers\SiteController;

/** @var yii\web\View $this */
/** @var backend\models\Contacto $model */
/** @var yii\widgets\ActiveForm $form */

 $provincias = Provincia::find()->all();
        $provinciasList = [];
        foreach ($provincias as $provincia) {
            $provinciasList[$provincia->Id] = $provincia->nomeProvincia; // Supondo que o nome da província está na coluna 'nome'
        }
  $funcoes = Funcao::find()->all();
        $funcoesList = [];
        foreach ($funcoes as $funcao) {
            $funcoesList[$funcao->Id] = $funcao->funcao; // Supondo que o nome da província está na coluna 'nome'
        }
?>        
<div class="contacto-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'funcao')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'instituicao')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'contacto')->textInput(['maxlength' => true,'id' => 'contactos-contacto', 'placeholder' => '+244929680377'])->label('Contacto (inclua o indicativo)') ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'pais')->textInput(['maxlength' => true]) ?>
    <!-- Dropdown para Província -->
    <?= $form->field($model, 'provinciaID')->dropDownList($provinciasList, ['prompt' => 'Selecione a província', 'id' => 'provincia-select']) ?>

    <!-- Dropdown para Município -->
    <?= $form->field($model, 'municipioID')->dropDownList([], ['prompt' => 'Selecione o município', 'id' => 'municipio-select']) ?>

    <!-- Dropdown para Comuna -->
    <?= $form->field($model, 'comunaID')->dropDownList([], ['prompt' => 'Selecione a comuna', 'id' => 'comuna-select']) ?>

    <?= $form->field($model, 'localidade')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'pontofocal')->textInput() ?>
    <?= $form->field($model, 'actividades')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'entidade')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nivel')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'rotulo')->textInput(['maxlength' => true]) ?>
     <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

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
