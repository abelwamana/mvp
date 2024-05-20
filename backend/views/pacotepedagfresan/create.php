<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Pacotepedagfresan $model */

$this->title = Yii::t('app', 'Create Pacotepedagfresan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pacotepedagfresans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pacotepedagfresan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
