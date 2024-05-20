<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Grupo $model */
$this->title = Yii::t('app', 'Actualizar Agricultura: {name}', [
            'name' => $grupoModel->Id,
        ]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Grupos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $grupoModel->Id, 'url' => ['view', 'Id' => $grupoModel->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="grupo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'grupoModel' => $grupoModel,
        'insumoGrupo' => $insumoGrupo,
        'fitofarmacosferramentas' => $fitofarmacosferramentas,])
    ?>

</div>
