<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Localidade $model */

$this->title = Yii::t('app', 'Criar Localidade');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Localidades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localidade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
