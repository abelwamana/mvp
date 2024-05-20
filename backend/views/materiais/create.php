<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Materiais $model */

$this->title = Yii::t('app', 'Create Materiais');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Materiais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materiais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
