<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Culturasprovidas $model */

$this->title = Yii::t('app', 'Create Culturasprovidas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Culturasprovidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="culturasprovidas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
