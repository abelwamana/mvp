<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Comuna $model */

$this->title = Yii::t('app', 'Criar Comuna');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comunas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comuna-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
