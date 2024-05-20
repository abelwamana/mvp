<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Suplementacao $model */

$this->title = Yii::t('app', 'Create Suplementacao');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suplementacaos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suplementacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
