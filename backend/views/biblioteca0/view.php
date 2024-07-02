<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Biblioteca[] */

$this->title = 'Biblioteca';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Título</th>
            <th>Descrição</th>
            <th>Arquivo</th>
            <th>Data de Upload</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= Html::encode($model->titulo) ?></td>
            <td><?= Html::encode($model->descricao) ?></td>
            <td><?= Html::a('Download', ['biblioteca/download', 'id' => $model->id]) ?></td>
            <td><?= Yii::$app->formatter->asDatetime($model->data_upload) ?></td>
        </tr>
    </tbody>
</table>
