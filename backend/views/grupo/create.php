<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Grupo $model */

$this->title = Yii::t('app', 'Agricultura');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agricultura'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="grupo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'grupoModel' => $grupoModel,
        'insumoGrupo' => $insumoGrupo,
        'fitofarmacosferramentas' => $fitofarmacosferramentas,
    ]) ?>

</div>
