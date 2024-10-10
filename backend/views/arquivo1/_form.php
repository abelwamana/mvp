<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
if ($model->isNewRecord) {
    // Usa o valor de $parentPath apenas se for um novo arquivo
    $model->caminho = isset($parentPath) ? $parentPath : '';
}

/** @var yii\web\View $this */
/** @var backend\models\Biblioteca $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="arquivo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <!-- Exibir o arquivo existente (se houver) -->
    
        <?php if (!$model->isNewRecord && !empty($model->arquivo)): ?>
        <div class="form-group">
            <label>Arquivo Atual:</label>
            <div>
                <?= Html::a(
                    $model->arquivo, // Nome do arquivo
                    ['download', 'file' => $model->arquivo], // Link de download (ajuste conforme necessário)
                    ['target' => '_blank']
                ) ?>
                <!-- Botão para remover o arquivo existente <?= Html::checkbox('removerArquivo', false, ['label' => 'Remover este arquivo']) ?> -->
                
            </div>
        </div>
    <?php endif; ?>

    <!-- Campos do formulário -->
    <?= $form->field($model, 'convite')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'actividade')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'organizacao')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'autores')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tema')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'classificacao')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'dataEstado')->textInput(['id' => 'dataEstado', 'type' => 'date', 'placeholder' => 'Data do estado actual']) ?>
    <?= $form->field($model, 'anoConcluido')->textInput() ?>
    <?= $form->field($model, 'numPagina')->textInput() ?>
    <?= $form->field($model, 'responsavelGestorUIC')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'usuarios')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'informacaoPlanilha')->textInput(['maxlength' => true]) ?>
    <?=
    $form->field($model, 'monitoriatemarquivo')->dropDownList([
        '1' => 'Sim',
        '0' => 'Não',
            ], ['prompt' => 'Selecione a opção'])
    ?>
    <?=
    $form->field($model, 'estaNoSiteFRESANLBC')->dropDownList([
        '1' => 'Sim',
        '0' => 'Não',
            ], ['prompt' => 'Selecione a opção'])
    ?>
    <?= $form->field($model, 'linkFresanLbc')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'caminho')->textInput(['maxlength' => true,'readonly' => true]) ?>
    <?=
    $form->field($model, 'data_upload')->textInput([
        'id' => 'data_upload',
        'type' => 'date',
        'value' => date('Y-m-d'), // Preenche com a data atual no formato Y-m-d
        'readonly' => true, // Define o campo como somente leitura
        'placeholder' => 'Data do Upload'
    ])
    ?>
        <?= $form->field($model, 'file')->fileInput() ?>
<?= $form->field($model, 'printFile')->fileInput() ?>

    <div class="form-group">
<?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>
</div>
