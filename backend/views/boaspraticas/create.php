<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Boaspraticas $model */

$this->title = 'Adicionar Boas Práticas';
$this->params['breadcrumbs'][] = ['label' => 'Boaspraticas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="boaspraticas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'provinciasList' => $provinciasList,
    ]) ?>

</div>
