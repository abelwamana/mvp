<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Profissionaissaude $model */

$this->title = Yii::t('app', 'Create Profissionaissaude');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profissionaissaudes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profissionaissaude-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
