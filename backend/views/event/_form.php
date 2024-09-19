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
    input#event-listaconvidados {
        font-size: 12px;
    }
    input#event-pada {
        font-size: 12px;
    }
    input#event-outrosanexos {
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
    .remove-anexo {
        /*width:60px;*/
        padding: 0px 2px; /* Ajuste o padding conforme necessário */
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

    <?php $form = ActiveForm::begin(['id' => 'updateEventForm', 'options' => ['onsubmit' => 'return checkParticipantes()']]); ?>

    <?= $form->field($model, 'summary')->textInput(['placeholder' => 'Título do Evento']) ?>
    <?= $form->field($model, 'description')->textInput(['placeholder' => 'Breve enquadramento e público alvo']) ?>
    <?=
    $form->field($model, 'area')->dropDownList([
        'Agricultura e Pecuária' => 'Agricultura e Pecuária',
        'Nutrição' => 'Nutrição',
        'Água' => 'Água',
        'Reforço Institucional' => 'Reforço Institucional',
        'Coordenação UIC' => 'Coordenação UIC',
        'Subvenções/M&A' => 'Subvenções/M&A',
        'Governo' => 'Governo',
        'Outras' => 'Outras',
            ], ['prompt' => 'Selecione a área'])
    ?>
    <?= $form->field($model, 'start')->textInput(['id' => 'event-start', 'type' => 'datetime-local', 'placeholder' => 'Data e Hora de Início']) ?>
    <?= $form->field($model, 'end')->textInput(['id' => 'event-end', 'type' => 'datetime-local', 'placeholder' => 'Data e Hora de Término']) ?>
    <?= $form->field($model, 'duracao')->textInput(['id' => 'duracao-evento', 'readonly' => true]) ?>          
    <?= $form->field($model, 'provinciaID')->dropDownList($provinciasList, ['id' => 'provincia-select', 'prompt' => 'Selecione a província']) ?>
    <?= $form->field($model, 'municipioID')->dropDownList([], ['id' => 'municipio-select', 'prompt' => 'Selecione o município']) ?>
    <?= $form->field($model, 'comunaID')->dropDownList([], ['id' => 'comuna-select', 'prompt' => 'Selecione a comuna']) ?>
    <?= $form->field($model, 'local')->textInput(['placeholder' => 'Referência do local, Instituição, Sala etc., ou escreva REMOTO']) ?>
    <?= $form->field($model, 'coordenadas')->textInput(['placeholder' => 'Insere o pin de localização ou link da reunião']) ?>
    <?=
    $form->field($model, 'entidadeOrganizadora')->dropDownList([
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
        'Vall d´Hebron' => 'Vall d´Hebron'
            ],
            ['prompt' => 'Selecione a Entidade'])
    ?>
    <?= $form->field($model, 'convocadoPor')->textInput() ?>
    <?=
    $form->field($model, 'participantes')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Contacto::find()->all(), 'email', function ($model) {
            return $model->nome . ' - ' . $model->instituicao;
        }),
        'options' => ['placeholder' => 'Selecione os participantes...', 'multiple' => true, 'id' => 'select-participantes'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);
    ?>

    <script>
        function checkParticipantes() {
            var participantes = $('#select-participantes').val();
            if (!participantes || participantes.length === 0) {
                // Define o valor para "Por confirmar em breve" se estiver vazio
                $('#select-participantes').append(new Option("A confirmar", "A confirmar", true, true)).trigger('change');
            }
            return true;
        }

        $(document).ready(function () {
            var participantesString = '<?= $model->participantes ?>';
            if (participantesString) {
                var participantesArray = participantesString.split(',');
                $('#select-participantes').val(participantesArray).trigger('change');
            }
        });
    </script>
    <!-- Seção de Anexos -->
    <fieldset>
        <legend>Anexos</legend>
        <?= $form->field($model, 'agenda', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
        <?= $form->field($model, 'listaConvidados', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
        <?= $form->field($model, 'pada', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
        <?= $form->field($model, 'actaRelatorio', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
        <?= $form->field($model, 'listaParticipantes', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
        <?= $form->field($model, 'outrosAnexos[]', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput(['multiple' => true]) ?>

        <!-- Mostrar arquivos anexos já carregados -->
        <div class="existing-files">
            <h4>Arquivos já carregados:</h4>
            <?php if ($model->agenda): ?>
                <p>Agenda:&nbsp;<a href="<?= Yii::getAlias('@web') . '/uploads/' . $model->agenda ?>" target="_blank"><?= $model->agenda ?></a>
                    <button type="button" class="btn btn-danger btn-sm remove-anexo" data-anexo="<?= $model->agenda ?>" data-campo="agenda">Remover</button></p>
            <?php endif; ?>

            <?php if ($model->listaConvidados): ?>
                <p>Lista de Convidados:&nbsp;<a href="<?= Yii::getAlias('@web') . '/uploads/' . $model->listaConvidados ?>" target="_blank"><?= $model->listaConvidados ?></a>
                    <button type="button" class="btn btn-danger btn-sm remove-anexo" data-anexo="<?= $model->listaConvidados ?>" data-campo="listaConvidados">Remover</button></p>
            <?php endif; ?>

            <?php if ($model->pada): ?>
                <p>PADA:&nbsp;<a href="<?= Yii::getAlias('@web') . '/uploads/' . $model->pada ?>" target="_blank"><?= $model->pada ?></a>
                    <button type="button" class="btn btn-danger btn-sm remove-anexo" data-anexo="<?= $model->pada ?>" data-campo="pada">Remover</button></p>
            <?php endif; ?>

            <?php if ($model->actaRelatorio): ?>
                <p>Acta Relatório:&nbsp;<a href="<?= Yii::getAlias('@web') . '/uploads/' . $model->actaRelatorio ?>" target="_blank"><?= $model->actaRelatorio ?></a>
                    <button type="button" class="btn btn-danger btn-sm remove-anexo" data-anexo="<?= $model->actaRelatorio ?>" data-campo="actaRelatorio">Remover</button></p>
            <?php endif; ?>

            <?php if ($model->listaParticipantes): ?>
                <p>Lista de Participantes:&nbsp;<a href="<?= Yii::getAlias('@web') . '/uploads/' . $model->listaParticipantes ?>" target="_blank"><?= $model->listaParticipantes ?></a>
                    <button type="button" class="btn btn-danger btn-sm remove-anexo" data-anexo="<?= $model->listaParticipantes ?>" data-campo="listaParticipantes">Remover</button></p>
            <?php endif; ?>

            <div>
                <?php if ($model->outrosAnexos != null && !empty($model->outrosAnexos) && $model->outrosAnexos != "A confirmar" && $model->outrosAnexos != "Por confirmar em breve"): ?>
                    Outros Anexos:
                    <?php
                    $outrosAnexosArray = is_array($model->outrosAnexos) ? $model->outrosAnexos : explode(',', $model->outrosAnexos);
                    foreach ($outrosAnexosArray as $outroAnexo):
                        ?>
                        <p><a href="<?= Yii::getAlias('@web') . '/uploads/' . $outroAnexo ?>" target="_blank"><?= $outroAnexo ?></a>
                            <button type="button" class="btn btn-danger btn-sm remove-anexo" data-anexo="<?= $outroAnexo ?>" data-campo="outrosAnexos">Remover</button></p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>    
        </div>
    </fieldset>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>


<?php
$script = <<< JS
$(document).ready(function(){
    // Preencher município e comuna com valores do modelo
    var municipioID = {$model->municipioID};
    var comunaID = {$model->comunaID};
    var provinciaID = {$model->provinciaID};
    
    if(provinciaID){
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
                
                if(municipioID){
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

        if (startDate && endDate && endDate <= startDate) {
            $('#updateEventForm').yiiActiveForm('updateAttribute', 'event-end', ['A data de início deve ser anterior à data de término.']);
        } else {
            $('#updateEventForm').yiiActiveForm('updateAttribute', 'event-end', '');
        }
    }

    // Chamar a função de verificação quando os campos de data forem alterados
    $('#event-start, #event-end').change(function() {
        checkDateValidity();
    });

    // Chamar a função de verificação quando o formulário for enviado
    $('#updateEventForm').on('beforeSubmit', function() {
        checkDateValidity();
        return true; // Permitir que o formulário seja enviado
    });
");
?>

<?php
$this->registerJs("
    $('.remove-anexo').on('click', function() {
        var anexo = $(this).data('anexo');
        var campo = $(this).data('campo');
        var id = {$model->Id};
        var button = $(this);

        $.ajax({
            url: '" . \yii\helpers\Url::to(['event/remove-anexo']) . "',
            type: 'POST',
            data: {
                id: id,
                anexo: anexo,
                campo: campo,
                _csrf: yii.getCsrfToken()
            },
            success: function(data) {
                if (data.success) {
                    button.parent().remove();
                } else {
                    alert(data.message);
                }
            }
        });
    });
");
?>