<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Supervisao $model */

$this->title = Yii::t('app', 'Create Supervisao');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Supervisaos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supervisao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
