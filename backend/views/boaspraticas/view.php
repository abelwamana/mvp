<style>
    .btn{
        margin-left: 5px;
        color: #fff;
        border-color: #919733;
        background-color: #919733;
        background-color: #919733;
        color: #fff;
        border-radius: 4px 4px 4px 4px;
    }

</style>
<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap4\Alert;

/** @var yii\web\View $this */
/** @var backend\models\Boaspraticas $model */
$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Boaspraticas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$isAdmin = Yii::$app->user->isGuest ? false : Yii::$app->user->can("Permissão de Administrador");
?>
<div class="boaspraticas-view">

    <h1><?= Html::encode($this->title) ?></h1>
     <div class="align-items-center" style="margin-left: 8.7px; max-width: 98.4%;">       
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <?=
                Alert::widget([
                    'options' => ['class' => 'alert-success'],
                    'body' => Yii::$app->session->getFlash('success'),
                ])
                ?>

            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <?=
                Alert::widget([
                    'options' => ['class' => 'alert-danger'],
                    'body' => Yii::$app->session->getFlash('error'),
                ])
                ?>
            <?php endif; ?>

        </div>
    <p>
        <?= Html::a(Yii::t('app', '<i class="fas fa-edit"></i> Editar'), ['update', 'Id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a(Yii::t('app', '<i class="fas fa-trash"></i> Eliminar'), ['delete', 'Id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Tem certeza que deseja eliminar este contacto?'),
                'method' => 'post',
            ],
        ])
        ?>
        <?= Html::a(Yii::t('app', '<i class="fas fa-arrow-left"></i> Voltar'), ['boaspraticas/boaspraticas'], ['class' => 'btn btn-primary']) ?>
        <?php if (Yii::$app->user->can('Permissão de Administrador') && !$model->aprovado): ?>
            <?=
            Html::a('Aprovar', ['approve', 'Id' => $model->Id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Tem certeza que deseja aprovar esta boa prática?',
                    'method' => 'post',
                ],
            ])
            ?>
<?php endif; ?>
    </p>




    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'boapratica:ntext',
            'justificacao',
            'area',
            [
                'attribute' => 'provinciaID',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model) {
                    return $model->provinciaID ? $model->provincia->nomeProvincia : '';
                },
            ],
            [
                'attribute' => 'municipioID',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model) {
                    return $model->municipioID ? $model->municipio->nomeMunicipio : '';
                },
            ],
            [
                'attribute' => 'comunaID',
                'vAlign' => 'middle',
                'hAlign' => 'center',
                'value' => function ($model) {
                    return $model->comunaID ? $model->comuna->nomeComuna : '';
                },
            ],
            'localidade',
            'latitude',
            'longitude',
            'entidadepropoente',
            'entidadeimplementadora',
            'fotografia',
            'recomendacoesID',
            'estrategia_de_sustentabilidadeID',
            'arquivoID',
        ],
    ])
    ?>

</div>
