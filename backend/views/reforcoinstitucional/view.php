<?php
use hail812\adminlte\widgets\Alert;
?>
<link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
      <?php

      use yii\helpers\Html;
      use yii\widgets\DetailView;

/** @var yii\web\View $this */
      /** @var backend\models\Reforcoinstitucional $model */
      $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reforcoinstitucionals'), 'url' => ['index']];
      $this->params['breadcrumbs'][] = $this->title;
      \yii\web\YiiAsset::register($this);
      ?>
<div class="reforcoinstitucional-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    <div id="success-alert" class="alert alert-success" role="alert" style="display: none;">
<?= Yii::$app->session->hasFlash('success') ? Yii::$app->session->getFlash('success') : '' ?>
    </div>

    <div id="error-alert" class="alert alert-danger" role="alert" style="display: none;">
<?= Yii::$app->session->hasFlash('error') ? Yii::$app->session->getFlash('error') : '' ?>
    </div>
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



    <!<!--Botoes PARA Responsabilidade, aparece aquele que for de acordo a responsabilidade de algum permission que for atribuido ao usuario
    -->
<?php foreach ($model->getAcoesBotoes() as $acao): ?>
        <?=
        Html::a($acao['label'], $acao['url'], [
            'class' => $acao['class'],
            'onclick' => 'showSuccessAlert();', // Chama a função para exibir o alerta
        ])
        ?>
    <?php endforeach; ?>




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
        'provinciaID',
        'municipioID',
        'comunaID',
        'localidadeID',
        'latitude',
        'longitude',
        'entidadeApoiada',
        'apoioCapacitacao:ntext',
        'temaAbordadoSessoes:ntext',
        'nSessoesPublicoAlvo',
        'nSessoesPubliTrimestre',
        'nHorasSessoes',
        'participantesFormacaoHomem',
        'participantesFormacaoMulher',
        'participantesFormacaoTrimestre',
        ['attribute' => 'anexoProgramaFormacao',
            'format' => 'raw',
            'value' => function ($models) {
                return Html::img(yii\helpers\Url::to("" . $models->anexoProgramaFormacao));
            }],
        'descricaoEquipamentos:ntext',
        'qtdEquipEntregues',
        'anexoTermoEntreEquipamento',
        'nAnimaisVacinadosCampanha',
        'meiosEntreguEntiCampanhaVacinacaoDesc:ntext',
        'nmeiosDistriEntiCampanhaVacinacao',
        'anexoTermoEntrMeiosCampanhaVacinacao',
        'trataGadoForamMapeadosHomem',
        'trataGadoForamMapeadosMulher',
        'trataGadoForamMapeadosTrim',
        'temaAbordadoFormaGado',
        'nSessoesRealiFormGado',
        'nSessoesRealiFormGadoTrimestre',
        'nTotalHorasFormacaoGado',
        'participantesFormacaoGadoHomem',
        'participantesFormacaoGadoMulher',
        'participantesFormacaoGadoTrimestre',
        'totalCabecaGado',
        'anexoProgramaFormaGado',
        'distriKitVeterinaria',
        'composicaoKitVeter:ntext',
        'nTotalKitDistribuido',
        'anexoKitDistri',
        'desafiosImplementacaoONG:ntext',
        'licoesAprendidasONG:ntext',
        'dataVisitaFresan',
        'tecnicoResponsavelFresan',
        'constantacoeFeitasFresan',
        'recomendacoes',
        'medidasMitigacaoONG',
        'medidasMitigacaoEstado',
        'userID',
    ],
])
?>

</div>

<script>
    // Função para exibir o alerta de sucesso e depois ocultá-lo após 5 segundos
    function showSuccessAlert() {
        var successAlert = document.getElementById('success-alert');
        successAlert.style.display = 'block';
        setTimeout(function () {
            successAlert.style.display = 'none';
        }, 5000); // 5000 milissegundos = 5 segundos
    }

    // Verifica se há mensagens de sucesso para exibir
    var successMessage = '<?= Yii::$app->session->hasFlash('success') ? Yii::$app->session->getFlash('success') : '' ?>';
    if (successMessage !== '') {
        showSuccessAlert();
    }
</script>
