<style>
    .small-text {
    font-size: 14px; /* Tamanho da fonte desejado */
}
</style>
<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Agua $model */


$this->title = Yii::t('app', 'Água');
$val = '';

if ($models->provincia !== null) {
    $val .= ' -> ' . $models->provincia->nomeProvincia;
}

if ($models->municipio !== null) {
    $val .= ' -> ' . $models->municipio->nomeMunicipio;
}

if ($models->comuna !== null) {
    $val .= ' -> ' . $models->comuna->nomeComuna;
}

if ($models->localidade !== null) {
    $val .= ' -> ' . $models->localidade->nomeLocalidade;
}


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agua'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agua-create">

   <span style="font-size: 25px; font: bold;"><?= Html::encode($this->title)?></span>  <span class="custom-title"><?= $val ?></span> 


    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
