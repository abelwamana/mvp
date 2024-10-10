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

/** @var yii\web\View $this */
/** @var backend\models\Recomendacoes $model */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Recomendacoes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="recomendacoes-view">

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
        <?= Html::a(Yii::t('app', '<i class="fas fa-trash"></i> Eliminar'), ['delete', 'Id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Tem certeza que deseja eliminar esta recomendação?'),
                'method' => 'post',
            ],
        ]) ?>
       
        <?= Html::a(Yii::t('app', '<i class="fas fa-arrow-left"></i> Voltar'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'recomendacao',
            'entidade',
            'contexto',
            'problema_a_resolver:ntext',
            'justificacao:ntext',
            'ID_Boas_Praticas',
            'ID_arquivo',
        ],
    ]) ?>

</div>
