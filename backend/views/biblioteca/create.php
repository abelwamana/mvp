<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Biblioteca $model */

$this->title = Yii::t('app', 'Adicionar Documento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Biblioteca'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="biblioteca-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
