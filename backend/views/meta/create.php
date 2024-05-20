<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Meta $model */

$this->title = Yii::t('app', 'Create Meta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Metas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
