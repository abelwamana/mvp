<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Unidade $model */

$this->title = Yii::t('app', 'Create Unidade');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
