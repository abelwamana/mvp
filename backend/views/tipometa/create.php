<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Tipometa $model */

$this->title = Yii::t('app', 'Create Tipometa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipometas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipometa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
