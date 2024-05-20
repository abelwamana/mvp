<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Insumogrupo $model */

$this->title = Yii::t('app', 'Create Insumogrupo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Insumogrupos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insumogrupo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
