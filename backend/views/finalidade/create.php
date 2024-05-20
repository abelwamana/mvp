<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Finalidade $model */

$this->title = Yii::t('app', 'Create Finalidade');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Finalidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="finalidade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
