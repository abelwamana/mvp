<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Capacitacao $model */

$this->title = Yii::t('app', 'Create Capacitacao');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Capacitacaos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="capacitacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
