<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Agua $model */
$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aguas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="agua-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'Id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('app', 'Delete'), ['delete', 'Id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'primeiroReporte',
            'actualizacao',
            'respondente',
            'entidade',
            [
                'attribute' => 'provinciaID',
                'value' => function ($model) {
                    return $model->provincia->nomeProvincia;
                },
            ],
            [
                'attribute' => 'municipioID',
                'value' => function ($model) {
                    return $model->municipio->nomeMunicipio;
                },
            ],
            [
                'attribute' => 'comunaID',
                'value' => function ($model) {
                    return $model->comuna->nomeComuna;
                },
            ],
            [
                'attribute' => 'localidadeID',
                'value' => function ($model) {
                    return $model->localidade->nomeLocalidade;
                },
            ],
            'latitude',
            'longitude',
            'infraEstrutura',
            'fonteHidraulica',
            'fonteHidraulicaAlternativa',
            'servicoAssociado',
            'novaConstrucao',
            'fimAQueSeDestina',
            'capacidadeInfraestrutura',
            [
                'attribute' => 'capacidadeUnidadeID',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => true,
                'value' => function ($model) {
                    return $model->unidade ? $model->unidade->unidade : 'N/A';
                    //return $model->grupo->nomeGrupo ? $model->grupo->nomeGrupo : 'N/A';;
                },
            ], 'realizadoTesteQualidadeAgua',
            'entidadeResponsavelConstrucao',
            'anosGarantia',
            'sistemExtracaoAgua',
            'especificacoesTecnInfraExtru:ntext',
            'temPlacaVisibilidade',
            'infraAssociadaCampo',
            [
                'attribute' => 'nomeCampoAssociadoGrupoID',
                'value' => function ($model) {
                    return $model->grupo ? $model->grupo->nomeGrupo : 'N/A';
                    //return $model->grupo->nomeGrupo ? $model->grupo->nomeGrupo : 'N/A';;
                },
            ],
            'anexoFichaTecnInfraExtr',
            'estadoObra',
            'imagemInfra',
            'dataConclusaoObra',
            'pontoFoiEntregueObra',
            'anexoActaEntrega',
            'benHomem',
            'benMulher',
            'totalAFAbrangidos',
            'benCorresponTotalPopulacao',
            'totalSuino',
            'totalCaprino',
            'totalBovino',
            'totalHaIrrigados',
            'grupoGestAgua',
            'orientacoesMetodologia',
            'comissaoRealizaReuniosFreq',
            'grupoFazContribuicoes',
            'grupoTemPlanoManutencaoPrev',
            'grupoTemPlanoManutencaoUrgen',
            'comissaoHomem',
            'comissaoMulher',
            'grupoFazParteACA',
            'grupoEstaAssociadoBMAS',
            'existeAcompaMuniEneAgua',
            'nTecniAcompanham',
            'nTecniParticipamReunioes',
            'metodologiaAdoptada',
            'criteriosUtilizadoParaSeleBenef:ntext',
            'benHomemTransSocial',
            'benMulherTransSocial',
            'totalAFCorrespondenteTransSocial',
            'valorDiarioBene',
            [
                'attribute' => 'valorDiarioBeneUnidadeID',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'hidden' => true,
                'value' => function ($model) {
                    return $model->unidade ? $model->unidade->unidade : 'N/A';
                    //return $model->grupo->nomeGrupo ? $model->grupo->nomeGrupo : 'N/A';;
                },
            ],
            'nDiasTrabalho',
            'totalEntregueTranBen',
            'anexoTermoPagamento',
            'desafiosONG',
            'licoesAprendidadasONG',
            'dataVisitaFresan',
            'tecnicoResponsavelFresan',
            'constantacoeFeitasFresan',
            'recomendacoes',
            'medidasMitigacaoONG',
            'medidasMitigacaoEstado',
            //'userID',
            [
                'attribute' => 'userID',
                'value' => function ($model) {
                    return $model->user ? $model->user->username : 'N/A';
                    //return $model->grupo->nomeGrupo ? $model->grupo->nomeGrupo : 'N/A';;
                },
            ],
        ],
    ])
    ?>

</div>
