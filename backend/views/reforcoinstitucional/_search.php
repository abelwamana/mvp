<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\ReforcoinstitucionalSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="reforcoinstitucional-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'primeiroReporte') ?>

    <?= $form->field($model, 'actualizacao') ?>

    <?= $form->field($model, 'respondente') ?>

    <?= $form->field($model, 'entidade') ?>

    <?php // echo $form->field($model, 'provinciaID') ?>

    <?php // echo $form->field($model, 'municipioID') ?>

    <?php // echo $form->field($model, 'comunaID') ?>

    <?php // echo $form->field($model, 'localidadeID') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'entidadeApoiada') ?>

    <?php // echo $form->field($model, 'apoioCapacitacao') ?>

    <?php // echo $form->field($model, 'temaAbordadoSessoes') ?>

    <?php // echo $form->field($model, 'nSessoesPublicoAlvo') ?>

    <?php // echo $form->field($model, 'nSessoesPubliTrimestre') ?>

    <?php // echo $form->field($model, 'nHorasSessoes') ?>

    <?php // echo $form->field($model, 'participantesFormacaoHomem') ?>

    <?php // echo $form->field($model, 'participantesFormacaoMulher') ?>

    <?php // echo $form->field($model, 'participantesFormacaoTrimestre') ?>

    <?php // echo $form->field($model, 'anexoProgramaFormacao') ?>

    <?php // echo $form->field($model, 'descricaoEquipamentos') ?>

    <?php // echo $form->field($model, 'qtdEquipEntregues') ?>

    <?php // echo $form->field($model, 'anexoTermoEntreEquipamento') ?>

    <?php // echo $form->field($model, 'nAnimaisVacinadosCampanha') ?>

    <?php // echo $form->field($model, 'meiosEntreguEntiCampanhaVacinacaoDesc') ?>

    <?php // echo $form->field($model, 'nmeiosDistriEntiCampanhaVacinacao') ?>

    <?php // echo $form->field($model, 'anexoTermoEntrMeiosCampanhaVacinacao') ?>

    <?php // echo $form->field($model, 'trataGadoForamMapeadosHomem') ?>

    <?php // echo $form->field($model, 'trataGadoForamMapeadosMulher') ?>

    <?php // echo $form->field($model, 'trataGadoForamMapeadosTrim') ?>

    <?php // echo $form->field($model, 'temaAbordadoFormaGado') ?>

    <?php // echo $form->field($model, 'nSessoesRealiFormGado') ?>

    <?php // echo $form->field($model, 'nSessoesRealiFormGadoTrimestre') ?>

    <?php // echo $form->field($model, 'nTotalHorasFormacaoGado') ?>

    <?php // echo $form->field($model, 'participantesFormacaoGadoHomem') ?>

    <?php // echo $form->field($model, 'participantesFormacaoGadoMulher') ?>

    <?php // echo $form->field($model, 'participantesFormacaoGadoTrimestre') ?>

    <?php // echo $form->field($model, 'totalCabecaGado') ?>

    <?php // echo $form->field($model, 'anexoProgramaFormaGado') ?>

    <?php // echo $form->field($model, 'distriKitVeterinaria') ?>

    <?php // echo $form->field($model, 'composicaoKitVeter') ?>

    <?php // echo $form->field($model, 'nTotalKitDistribuido') ?>

    <?php // echo $form->field($model, 'anexoKitDistri') ?>

    <?php // echo $form->field($model, 'desafiosImplementacaoONG') ?>

    <?php // echo $form->field($model, 'licoesAprendidasONG') ?>

    <?php // echo $form->field($model, 'dataVisitaFresan') ?>

    <?php // echo $form->field($model, 'tecnicoResponsavelFresan') ?>

    <?php // echo $form->field($model, 'constantacoeFeitasFresan') ?>

    <?php // echo $form->field($model, 'recomendacoes') ?>

    <?php // echo $form->field($model, 'medidasMitigacaoONG') ?>

    <?php // echo $form->field($model, 'medidasMitigacaoEstado') ?>

    <?php // echo $form->field($model, 'userID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
