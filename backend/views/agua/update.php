<?php

use yii\helpers\Html;
use backend\models\Provincia; 
use backend\models\Municipio;
use backend\models\Comuna;
use backend\models\Localidade;

$provinciaModel = Provincia::findOne($models->provinciaID);
$municipioModel = Municipio::findOne($models->municipioID);
$comunaModel = Comuna::findOne($models->municipioID);
$localidadeModel = Localidade::findOne($models->localidadeID);



/** @var yii\web\View $this */
/** @var backend\models\Agua $model */

if ($provinciaModel) {
    // Atribua o nome da província ao título
    $this->title = Yii::t('app', 'Actualizar: {provincia} -> {municipio} -> {comuna} -> {localidade}', [
        'provincia' => $provinciaModel->nomeProvincia, 
        'municipio' => $municipioModel->nomeMunicipio, 
        'comuna' => $comunaModel->nomeComuna, 
        'localidade' => $localidadeModel->nomeLocalidade, 
 
]);
}
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aguas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $models->Id, 'url' => ['view', 'Id' => $models->Id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="agua-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
