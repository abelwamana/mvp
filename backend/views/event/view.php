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
/** @var backend\models\Event $model */

$this->title = $model->Id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>

   <p>
        <?= Html::a(Yii::t('app', '<i class="fas fa-edit"></i> Editar'), ['update', 'Id' => $model->Id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', '<i class="fas fa-trash"></i> Eliminar'), ['delete', 'Id' => $model->Id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Tem certeza que deseja eliminar este Evento?'),
                'method' => 'post',
            ],
        ]) ?>
       
        <?= Html::a(Yii::t('app', '<i class="fas fa-arrow-left"></i> Voltar'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'Id',
            'summary',
            'description:ntext',
            'area',
            'start',
            'end',
            'duracao',
            'provinciaID',
            'municipioID',
            'comunaID',
            'local:ntext',
            'coordenadas',
            'entidadeOrganizadora',
            'convocadoPor',
            'participantes:ntext',
        ],
    ]) ?>

</div>
