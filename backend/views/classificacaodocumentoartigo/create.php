<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Classificacaodocumentoartigo $model */

$this->title = Yii::t('app', 'Create Classificacaodocumentoartigo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classificacaodocumentoartigos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classificacaodocumentoartigo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
