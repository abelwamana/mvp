<link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    /* Altere a cor de fundo do tipo 'info' do painel para a cor desejada */
    .card-header  {
        background-color: #919733; /* Substitua pelo código de cor desejado */
        color: #ffffff; /* Cor do texto para legibilidade */
    }
    .btn.btn-primary.botao {
        background-color: #919733; /* Cor de fundo do botão primário Bootstrap */
        color: #fff; /* Cor do texto para legibilidade */
        /* Outros estilos conforme necessário */
    }

</style>

<?php

use backend\models\GrupoSearch;
use hail812\adminlte\widgets\Alert;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/** @var View $this */
/** @var GrupoSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */
/** @var Created by: Agostinho Francisco Paixão do Rosário */
/** @varE - mail  : rosarioabderval@gmail.com */
/** @var Tel: +244 930 744 338 */
/** @var Esta afirmação é fiel e digna de toda aceitação: Cristo Jesus veio ao mundo para salvar os pecadores, dos quais eu sou o pior. */
/** @var 1 Timóteo 1:15 */
$this->title = Yii::t('app', 'Agricultura');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-index">
     <?php
// Verifica se há mensagens flash de erro
    if (Yii::$app->session->hasFlash('error')) {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-danger', // Classe CSS para estilo de erro
            ],
            'body' => Yii::$app->session->getFlash('error'), // Exibe a mensagem flash de erro
        ]);
    }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <?php
    $gridColumns = [
        [
            'class' => 'yii\grid\CheckboxColumn',
            'checkboxOptions' => function ($model, $key, $index, $column) {
                return ['value' => $model->Id];
            },
        ],
        [
            'class' => 'kartik\grid\SerialColumn',
            'contentOptions' => ['class' => 'kartik-sheet-style'],
            'width' => '36px',
            'header' => '',
            'headerOptions' => ['class' => 'kartik-sheet-style']
        ],
        [
            'attribute' => 'Id',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'primeiroReporte',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'actualizacaoID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'respondente',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'entidade',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'provinciaID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
            'value' => 'provincia.nomeProvincia', // Access the related nomeProvincia attribute
        ],
        [
            'attribute' => 'municipioID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'comunaID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'localidadeID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'latitude',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'longitude',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'apoioAgricola',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nomeGrupo',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
        ],
        [
            'attribute' => 'grupoExistia',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'metodologiaAgricola',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'outraMetodologiaAgricola',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'segueMetodologiaECA',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'anoInicioApoio',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'primeiroAnoAgriColheita',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'ultimoAnoAgriColheita',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'estagioFaseEncontra',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'validadaIDA',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'grupoEntregueEntPubl',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'dataGrupoEntregue',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
       
                     [
            'attribute' => 'anexoAutoEntrega',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'format' => 'raw', // Define o formato como HTML
            'value' => function ($model) {
                if ($model->getAnexoLink()) {

                    return Html::a('Abrir', $model->getAnexoLink(), ['target' => '_blank']);
                } else {
                    return 'Nenhum anexo disponível';
                }
            },
        ],
        [
            'attribute' => 'primeiraFinalidadeID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'segundaFinalidadeID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'terceiraFinalidadeID3',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'beneficiariosHomem',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'beneficiariosMulher',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'listaMembros',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'representaQtsAF',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'bovinos',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'caprinos',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'ovinos',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temComissaoGestao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temReguInterno',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temFacilitador',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temParcelasAprendizagem',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temCerco',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temPlacaIdentificacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temCadernoRegisto',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'contribuicaoFundoManeio',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'frequenciaContribuicoes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'membrosContribuemRegular',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'fundoManeioSaldoPositivo',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temPlanoActividade',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'frequenciaSessoes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'localReunioes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'implementaASAE',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'produzBioInsecticida',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'usaBioFertilizante',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'integraSistemaAgrosilvopastoril',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'numEvenTrocExperCamponeses',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'metodologiaJangosPastoris',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'assistTecnApoioProducao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'placaVisibilidade',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'autoridadeTradEnvolvida',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'administracaoEnvolvida',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'isvEnvolvida',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'idfEnvolvida',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'idaEdaEnvolvida',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'iiaEnvolvida',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'iivEnvolvida',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'outroEnvolvida',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'primeiraPraticaInovadora',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'segundaPraticaInovadora',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'terceiraPraticaInovadora',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'replicaPraticaInovadora',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nLavrasPartiReplicaPraticaInovadora',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'principalConstrangimento',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temas:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'tema1Ciclo',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'tema2Ciclo',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'tema3Ciclo',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'outroTema:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nSessoeTeoPrat',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nSessoeTeoPratTrimes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'diaSessaoEca',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'percentParticipacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'areaTotalCampoAgro',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'areaCultivadaCampoAgro',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'areaInsPlantInovadorasCampoAgro',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'pontoAguaDispoIrri',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'previstConstrSistIrrig',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'sistemaIrriUtilizad',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'areaIrrigada',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'classificacacaoCampo',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'houveExcedente',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'culturasHouveExcedente',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'qtdExcedente',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'trimestreExcedente',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'destinoExcedente',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'facilitaLigacoesEntreProdutores',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'realizaEventosSobreProdutos',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'apoioDistrProdCamponeses',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nRedes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'dataApoios',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'tipoEvento',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'descricaoRede:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'coberturaGeograficaRede',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'comerciantesEnvolvidos',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'finalidadeRede',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'frequenciaRede',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'resultadoInicRede',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'desafios',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'licoesAprendidas',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temBancoSementes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'fazMultiSementes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'culturasDispoBancSementes:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'qtdSementesEntrBancoKG',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'trimSementesBanco',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'totalSementesEntrCamponeses',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'trimestreSementesEntrCamponeses',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'totalSementesReembPelosCamponeses',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'trimestreSementesReembPelosCamponeses',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'qtdSementesDisponiveisBanco',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'trimestreSementesDisponiveisBanco',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'estadoBancoSementes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temRegistoBancSementes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'camponesesRecebemSementesBanc',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'camponesesReebolsaSementesBanc',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'resultadIniciBancoSem',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'desafiosBancoSem:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'licoesAprendiBancSem:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'classifCooper',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'membrCampoAgrFormal',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'homemCoop',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'mulherCoop',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'coopExistia',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'coopLegalizada',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'coopLegalFresan',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'tipoApoioDadoProjec',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'realizaFormacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'temaSessoesFormacao:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nSessoesFormacoes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'trimesSessoesFormacoes',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'orgaosSociaisDefinidos',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nReunioesOrgSoc',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nReunioesOrgSocTrimestre',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'membrosFazemContrReg',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'coopTemFundoManeioPositivo',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'propositoApoiarTransformacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'realizaTransforDescriProduto:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'propositoApoiarArmazen',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'propositoApoiarFactorProd',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'propositoApoiarComercializacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'propositoApoiarMembroCaixaCom',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'desafiosCooperativas:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'licoesAprendidasCooperativas:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'tecnologiaProjectoPioto',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nCamponesesHomens',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nCamponesesMulheres',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'kitClassificacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'kitDistribuidoDescric:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'nKitEntregue',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'pontoSituacaoProjecto',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'comercializacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'qtdProdComercializadoKG',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'resultadoInicPiloto',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'desafiosPiloto:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'licoesAprendidasPiloto:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'realizadaSinsibilizacoesEAN',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'realizadasSensibilizacoesCulinarias',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'realizadoRastreios',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'desafiosAprendidasONG',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'licoesAprendidasONG',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'dataVisitaUIC',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'tecnicoResponsavelUIC',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'constatacoesFeitasUIC',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'recomendacoesFeitasUIC:ntext',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'medidasMitigacaoONG',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'medidasMitigacaoEstado',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => true,
        ],
        [
            'attribute' => 'userID',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'hidden' => false,
            'value' => 'user.username', // Access the related nomeProvincia attribute
        ],
        [
            'attribute' => 'estadoValidacao',
            'vAlign' => 'middle',
            'hAlign' => 'center',
            'filterType' => GridView::FILTER_SELECT2,
            //'filter' => $model->getEstadoreforcoinstitucional(),
            'filterInputOptions' => [
                'id' => 'status',
            ],
            'filterWidgetOptions' => [
                'theme' => Select2::THEME_KRAJEE_BS5,
                'pluginOptions' => ['allowClear' => true,],
                'options' => ['placeholder' => Yii::t('app', 'Select...')
                ],
            ],
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{view} {update} {delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    return ['view', 'Id' => $model->Id];
                }
                if ($action === 'update') {
                    return ['update', 'Id' => $model->Id];
                }
                if ($action === 'delete') {
                    return ['delete', 'Id' => $model->Id];
                }
            },
        ],
        [
            'label' => 'Ações',
            'format' => 'raw',
            'value' => function ($model) {
                $acoes = $model->getAcoesBotoes();
                $buttons = '';
                foreach ($acoes as $acao) {
                    $buttons .= Html::a($acao['label'], $acao['url'], [
                                'class' => $acao['class'],
                                'onclick' => 'showSuccessAlert();', // Chama a função para exibir o alerta
                            ]) . ' ';
                }
                return $buttons;
            },
        ]
            ]
    ;
    ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'headerContainer' => ['style' => 'top:50px', 'class' => 'kv-table-header'],
        'floatPageSummary' => true,
        'pjax' => true,
        'responsive' => true,
        'bordered' => true,
        'condensed' => true,
        'hover' => true,
        //'showPageSummary' => true,
        'hover' => true,
        // set export properties
        // set your toolbar
        'pjax' => true, // Ative o PJAX para atualizações assíncronas
        'pager' => [
            'firstPageLabel' => 'Primeira',
            'prevPageLabel' => 'Anterior',
            'nextPageLabel' => 'Próxima',
            'lastPageLabel' => 'Última',
        ],
        'toolbar' => [
            [
                'content' =>
                Html::a('<i class="fas fa-plus"></i>', ['create'], [
                    'class' => 'btn btn-primary botao',
                    'title' => 'Adicionar Agricultura',
                ]) . ' ' .
                Html::a('<i class="fas fa-redo"></i>', ['index'], [
                    'class' => 'btn btn-outline-secondary',
                    'title' => 'Reiniciar a Tabela',
                    'data-pjax' => 0,
                ]),
                'options' => ['class' => 'btn-group mr-2 me-2'],
            ],
            '{export}',
            '{toggleData}',
        ],
        'exportConfig' => [
            // 'html' => [],
            'csv' => [],
            // 'txt' => [],
            'xls' => [],
        // 'pdf' => [],
        //  'json' => [],
        ],
        'showPageSummary' => false,
        'panel' => [
            'heading' => Yii::t('app', 'Agricultura'),
            'type' => '',
            'before' => '<div class="btn-group">' .
            //Html::a(Yii::t('app', 'Criar grupo'), ['create'], ['class' => 'btn btn-danger']).
            Html::beginForm(['validar-selecionados'], 'post', ['class' => 'form-inline']) .
            Html::submitButton('Validar Selecionados', ['class' => 'btn btn-primary botao']) .
            
            '</div>',
            //'after'=>Html::a('<i class="fas fa-redo"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            'footer' => true
        ],
        'toggleDataContainer' => ['class' => 'btn-group mr-2 me-2'],
        'persistResize' => true,
        'toggleDataOptions' => ['minCount' => 10],
            //'itemLabelSingle' => 'book',
            //'itemLabelPlural' => 'books',
    ]);
    ?>




</div>
