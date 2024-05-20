<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Municipio $model */

$this->title = Yii::t('app', 'Criar Municipio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Municipios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="municipio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
