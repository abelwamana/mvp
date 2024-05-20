<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\GrupoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="grupo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'primeiroReporte') ?>

    <?= $form->field($model, 'actualizacaoID') ?>

    <?= $form->field($model, 'respondente') ?>

    <?= $form->field($model, 'entidade') ?>

    <?php // echo $form->field($model, 'provinciaID') ?>

    <?php // echo $form->field($model, 'municipioID') ?>

    <?php // echo $form->field($model, 'comunaID') ?>

    <?php // echo $form->field($model, 'localidadeID') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <?php // echo $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'apoioAgricola') ?>

    <?php // echo $form->field($model, 'nomeGrupo') ?>

    <?php // echo $form->field($model, 'grupoExistia') ?>

    <?php // echo $form->field($model, 'metodologiaAgricola') ?>

    <?php // echo $form->field($model, 'outraMetodologiaAgricola') ?>

    <?php // echo $form->field($model, 'segueMetodologiaECA') ?>

    <?php // echo $form->field($model, 'anoInicioApoio') ?>

    <?php // echo $form->field($model, 'primeiroAnoAgriColheita') ?>

    <?php // echo $form->field($model, 'ultimoAnoAgriColheita') ?>

    <?php // echo $form->field($model, 'estagioFaseEncontra') ?>

    <?php // echo $form->field($model, 'validadaIDA') ?>

    <?php // echo $form->field($model, 'grupoEntregueEntPubl') ?>

    <?php // echo $form->field($model, 'dataGrupoEntregue') ?>

    <?php // echo $form->field($model, 'anexoAutoEntrega') ?>

    <?php // echo $form->field($model, 'primeiraFinalidadeID') ?>

    <?php // echo $form->field($model, 'segundaFinalidadeID') ?>

    <?php // echo $form->field($model, 'terceiraFinalidadeID3') ?>

    <?php // echo $form->field($model, 'beneficiariosHomem') ?>

    <?php // echo $form->field($model, 'beneficiariosMulher') ?>

    <?php // echo $form->field($model, 'listaMembros') ?>

    <?php // echo $form->field($model, 'representaQtsAF') ?>

    <?php // echo $form->field($model, 'bovinos') ?>

    <?php // echo $form->field($model, 'caprinos') ?>

    <?php // echo $form->field($model, 'ovinos') ?>

    <?php // echo $form->field($model, 'temComissaoGestao') ?>

    <?php // echo $form->field($model, 'temReguInterno') ?>

    <?php // echo $form->field($model, 'temFacilitador') ?>

    <?php // echo $form->field($model, 'temParcelasAprendizagem') ?>

    <?php // echo $form->field($model, 'temCerco') ?>

    <?php // echo $form->field($model, 'temPlacaIdentificacao') ?>

    <?php // echo $form->field($model, 'temCadernoRegisto') ?>

    <?php // echo $form->field($model, 'contribuicaoFundoManeio') ?>

    <?php // echo $form->field($model, 'frequenciaContribuicoes') ?>

    <?php // echo $form->field($model, 'membrosContribuemRegular') ?>

    <?php // echo $form->field($model, 'fundoManeioSaldoPositivo') ?>

    <?php // echo $form->field($model, 'temPlanoActividade') ?>

    <?php // echo $form->field($model, 'frequenciaSessoes') ?>

    <?php // echo $form->field($model, 'localReunioes') ?>

    <?php // echo $form->field($model, 'implementaASAE') ?>

    <?php // echo $form->field($model, 'produzBioInsecticida') ?>

    <?php // echo $form->field($model, 'usaBioFertilizante') ?>

    <?php // echo $form->field($model, 'integraSistemaAgrosilvopastoril') ?>

    <?php // echo $form->field($model, 'numEvenTrocExperCamponeses') ?>

    <?php // echo $form->field($model, 'metodologiaJangosPastoris') ?>

    <?php // echo $form->field($model, 'assistTecnApoioProducao') ?>

    <?php // echo $form->field($model, 'placaVisibilidade') ?>

    <?php // echo $form->field($model, 'autoridadeTradEnvolvida') ?>

    <?php // echo $form->field($model, 'administracaoEnvolvida') ?>

    <?php // echo $form->field($model, 'isvEnvolvida') ?>

    <?php // echo $form->field($model, 'idfEnvolvida') ?>

    <?php // echo $form->field($model, 'idaEdaEnvolvida') ?>

    <?php // echo $form->field($model, 'iiaEnvolvida') ?>

    <?php // echo $form->field($model, 'iivEnvolvida') ?>

    <?php // echo $form->field($model, 'outroEnvolvida') ?>

    <?php // echo $form->field($model, 'primeiraPraticaInovadora') ?>

    <?php // echo $form->field($model, 'segundaPraticaInovadora') ?>

    <?php // echo $form->field($model, 'terceiraPraticaInovadora') ?>

    <?php // echo $form->field($model, 'replicaPraticaInovadora') ?>

    <?php // echo $form->field($model, 'nLavrasPartiReplicaPraticaInovadora') ?>

    <?php // echo $form->field($model, 'principalConstrangimento') ?>

    <?php // echo $form->field($model, 'temas') ?>

    <?php // echo $form->field($model, 'tema1Ciclo') ?>

    <?php // echo $form->field($model, 'tema2Ciclo') ?>

    <?php // echo $form->field($model, 'tema3Ciclo') ?>

    <?php // echo $form->field($model, 'outroTema') ?>

    <?php // echo $form->field($model, 'nSessoeTeoPrat') ?>

    <?php // echo $form->field($model, 'nSessoeTeoPratTrimes') ?>

    <?php // echo $form->field($model, 'diaSessaoEca') ?>

    <?php // echo $form->field($model, 'percentParticipacao') ?>

    <?php // echo $form->field($model, 'areaTotalCampoAgro') ?>

    <?php // echo $form->field($model, 'areaCultivadaCampoAgro') ?>

    <?php // echo $form->field($model, 'areaInsPlantInovadorasCampoAgro') ?>

    <?php // echo $form->field($model, 'pontoAguaDispoIrri') ?>

    <?php // echo $form->field($model, 'previstConstrSistIrrig') ?>

    <?php // echo $form->field($model, 'sistemaIrriUtilizad') ?>

    <?php // echo $form->field($model, 'areaIrrigada') ?>

    <?php // echo $form->field($model, 'classificacacaoCampo') ?>

    <?php // echo $form->field($model, 'houveExcedente') ?>

    <?php // echo $form->field($model, 'culturasHouveExcedente') ?>

    <?php // echo $form->field($model, 'qtdExcedente') ?>

    <?php // echo $form->field($model, 'trimestreExcedente') ?>

    <?php // echo $form->field($model, 'destinoExcedente') ?>

    <?php // echo $form->field($model, 'facilitaLigacoesEntreProdutores') ?>

    <?php // echo $form->field($model, 'realizaEventosSobreProdutos') ?>

    <?php // echo $form->field($model, 'apoioDistrProdCamponeses') ?>

    <?php // echo $form->field($model, 'nRedes') ?>

    <?php // echo $form->field($model, 'dataApoios') ?>

    <?php // echo $form->field($model, 'tipoEvento') ?>

    <?php // echo $form->field($model, 'descricaoRede') ?>

    <?php // echo $form->field($model, 'coberturaGeograficaRede') ?>

    <?php // echo $form->field($model, 'comerciantesEnvolvidos') ?>

    <?php // echo $form->field($model, 'finalidadeRede') ?>

    <?php // echo $form->field($model, 'frequenciaRede') ?>

    <?php // echo $form->field($model, 'resultadoInicRede') ?>

    <?php // echo $form->field($model, 'desafios') ?>

    <?php // echo $form->field($model, 'licoesAprendidas') ?>

    <?php // echo $form->field($model, 'temBancoSementes') ?>

    <?php // echo $form->field($model, 'fazMultiSementes') ?>

    <?php // echo $form->field($model, 'culturasDispoBancSementes') ?>

    <?php // echo $form->field($model, 'qtdSementesEntrBancoKG') ?>

    <?php // echo $form->field($model, 'trimSementesBanco') ?>

    <?php // echo $form->field($model, 'totalSementesEntrCamponeses') ?>

    <?php // echo $form->field($model, 'trimestreSementesEntrCamponeses') ?>

    <?php // echo $form->field($model, 'totalSementesReembPelosCamponeses') ?>

    <?php // echo $form->field($model, 'trimestreSementesReembPelosCamponeses') ?>

    <?php // echo $form->field($model, 'qtdSementesDisponiveisBanco') ?>

    <?php // echo $form->field($model, 'trimestreSementesDisponiveisBanco') ?>

    <?php // echo $form->field($model, 'estadoBancoSementes') ?>

    <?php // echo $form->field($model, 'temRegistoBancSementes') ?>

    <?php // echo $form->field($model, 'camponesesRecebemSementesBanc') ?>

    <?php // echo $form->field($model, 'camponesesReebolsaSementesBanc') ?>

    <?php // echo $form->field($model, 'resultadIniciBancoSem') ?>

    <?php // echo $form->field($model, 'desafiosBancoSem') ?>

    <?php // echo $form->field($model, 'licoesAprendiBancSem') ?>

    <?php // echo $form->field($model, 'classifCooper') ?>

    <?php // echo $form->field($model, 'membrCampoAgrFormal') ?>

    <?php // echo $form->field($model, 'homemCoop') ?>

    <?php // echo $form->field($model, 'mulherCoop') ?>

    <?php // echo $form->field($model, 'coopExistia') ?>

    <?php // echo $form->field($model, 'coopLegalizada') ?>

    <?php // echo $form->field($model, 'coopLegalFresan') ?>

    <?php // echo $form->field($model, 'tipoApoioDadoProjec') ?>

    <?php // echo $form->field($model, 'realizaFormacao') ?>

    <?php // echo $form->field($model, 'temaSessoesFormacao') ?>

    <?php // echo $form->field($model, 'nSessoesFormacoes') ?>

    <?php // echo $form->field($model, 'trimesSessoesFormacoes') ?>

    <?php // echo $form->field($model, 'orgaosSociaisDefinidos') ?>

    <?php // echo $form->field($model, 'nReunioesOrgSoc') ?>

    <?php // echo $form->field($model, 'nReunioesOrgSocTrimestre') ?>

    <?php // echo $form->field($model, 'membrosFazemContrReg') ?>

    <?php // echo $form->field($model, 'coopTemFundoManeioPositivo') ?>

    <?php // echo $form->field($model, 'propositoApoiarTransformacao') ?>

    <?php // echo $form->field($model, 'realizaTransforDescriProduto') ?>

    <?php // echo $form->field($model, 'propositoApoiarArmazen') ?>

    <?php // echo $form->field($model, 'propositoApoiarFactorProd') ?>

    <?php // echo $form->field($model, 'propositoApoiarComercializacao') ?>

    <?php // echo $form->field($model, 'propositoApoiarMembroCaixaCom') ?>

    <?php // echo $form->field($model, 'desafiosCooperativas') ?>

    <?php // echo $form->field($model, 'licoesAprendidasCooperativas') ?>

    <?php // echo $form->field($model, 'tecnologiaProjectoPioto') ?>

    <?php // echo $form->field($model, 'nCamponesesHomens') ?>

    <?php // echo $form->field($model, 'nCamponesesMulheres') ?>

    <?php // echo $form->field($model, 'kitClassificacao') ?>

    <?php // echo $form->field($model, 'kitDistribuidoDescric') ?>

    <?php // echo $form->field($model, 'nKitEntregue') ?>

    <?php // echo $form->field($model, 'pontoSituacaoProjecto') ?>

    <?php // echo $form->field($model, 'comercializacao') ?>

    <?php // echo $form->field($model, 'qtdProdComercializadoKG') ?>

    <?php // echo $form->field($model, 'resultadoInicPiloto') ?>

    <?php // echo $form->field($model, 'desafiosPiloto') ?>

    <?php // echo $form->field($model, 'licoesAprendidasPiloto') ?>

    <?php // echo $form->field($model, 'realizadaSinsibilizacoesEAN') ?>

    <?php // echo $form->field($model, 'realizadasSensibilizacoesCulinarias') ?>

    <?php // echo $form->field($model, 'realizadoRastreios') ?>

    <?php // echo $form->field($model, 'desafiosAprendidasONG') ?>

    <?php // echo $form->field($model, 'licoesAprendidasONG') ?>

    <?php // echo $form->field($model, 'dataVisitaUIC') ?>

    <?php // echo $form->field($model, 'tecnicoResponsavelUIC') ?>

    <?php // echo $form->field($model, 'constatacoesFeitasUIC') ?>

    <?php // echo $form->field($model, 'recomendacoesFeitasUIC') ?>

    <?php // echo $form->field($model, 'medidasMitigacaoONG') ?>

    <?php // echo $form->field($model, 'medidasMitigacaoEstado') ?>

    <?php // echo $form->field($model, 'userID') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
