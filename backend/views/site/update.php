<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Event $model */

$this->title = Yii::t('app', 'Alterar Evento: {name}', [
    'name' => $model->summary,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'Id' => $model->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
         'provinciasList' => $provinciasList,
    ]) ?>

</div>
