<style>
     .has-error .help-block {
        color: red;
    }
</style>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

$areas = [
    "Agricultura" => "Agricultura",
    "Nutrição" => "Nutrição",
    "Água" => "Água",
    "Reforço Institucional" => "Reforço Institucional",
    "Outras" => "Outras"
];

 $entidades = [
         'Camões, I.P. | ADESPOV/C4' => 'Camões, I.P. | ADESPOV/C4',
                    'Camões, I.P. | ADPP/C1' => 'Camões, I.P. | ADPP/C1',
                    'Camões, I.P. | ADRA/C4' => 'Camões, I.P. | ADRA/C4',
                    'Camões, I.P. | CODESPA/C2' => 'Camões, I.P. | CODESPA/C2',
                    'Camões, I.P. | CODESPA/C4' => 'Camões, I.P. | CODESPA/C4',
                    'Camões, I.P. | COSPE/C1' => 'Camões, I.P. | COSPE/C1',
                    'Camões, I.P. | CUAMM/C2' => 'Camões, I.P. | CUAMM/C2',
                    'Camões, I.P. | CUAMM/C4' => 'Camões, I.P. | CUAMM/C4',
                    'Camões, I.P. | DW/C1' => 'Camões, I.P. | DW/C1',
                    'Camões, I.P. | DW/C4' => 'Camões, I.P. | DW/C4',
                    'Camões, I.P. | FEC/C2' => 'Camões, I.P. | FEC/C2',
                    'Camões, I.P. | FEC/C4' => 'Camões, I.P. | FEC/C4',
                    'Camões, I.P. | NCA/C1' => 'Camões, I.P. | NCA/C1',
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
                    'Outra' => 'Outra'
    ];


/** @var yii\web\View $this */
/** @var backend\models\Recomendacoes $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="recomendacoes-form">

    <?php $form = ActiveForm::begin(); ?>
     <?php if (!$model->isNewRecord): ?>
        <img src="/mvp/admin/recomendacoes/<?= $model->fotografia ?>" alt="Boa Prática" style="width:50%">
    <?php endif; ?>

    <?= $form->field($model, 'recomendacao')->textInput(['maxlength' => true]) ?>
      <?=
    $form->field($model, 'area')->widget(Select2::classname(), [
        'data' => $areas,
        'options' => ['placeholder' => 'Selecione as áreas...', 'multiple' => true],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);
    ?>
    <?= $form->field($model, 'contexto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'justificacao')->textarea(['rows' => 6]) ?>
        
     <?= $form->field($model, 'fotoFile')->fileInput() ?>
    <?= $form->field($model, 'ID_Boas_Praticas')->textInput() ?>

    <?= $form->field($model, 'ID_arquivo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
