<?php

use yii\helpers\Html;
print_r($currentAnexo);
/** @var yii\web\View $this */
/** @var backend\models\Doccomunicacao $model */

$this->title = Yii::t('app', 'Update Doccomunicacao: {name}', [
    'name' => $models->Id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Doccomunicacaos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $models->Id, 'url' => ['view', 'Id' => $models->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="doccomunicacao-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
