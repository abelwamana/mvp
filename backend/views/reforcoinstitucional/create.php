<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Reforcoinstitucional $model */

$this->title = Yii::t('app', 'Criar Reforço Institucional');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reforcoinstitucionals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reforcoinstitucional-create">


    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
