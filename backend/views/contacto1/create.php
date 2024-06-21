<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Contacto $model */

$this->title = Yii::t('app', 'Adicionar Contacto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contactos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

