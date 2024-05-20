<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Eventos $model */

$this->title = Yii::t('app', 'Create Eventos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Eventos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
