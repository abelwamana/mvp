<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Doccomunicacao $model */

//$this->title = Yii::t('app', 'Criar Documentos e Comunicação');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentos e Comunicação'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Criar Documentos e Comunicação');
?>
<div class="doccomunicacao-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'models' => $models,
    ]) ?>

</div>
