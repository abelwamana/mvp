<?php

use yii\helpers\Html;

$this->title = 'Lista de Eventos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div style="position: relative;">
    <?= Html::a('Calendário', ['/site/calendario2', 'area' => 'inicio', 'reload' => 'true'], ['class' => 'btn btn-primary']) ?>

    <h1><?= Html::encode($this->title) ?></h1>

    <style>
        .legend {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .event-color {
            display: inline-block;
            width: 10px;
            height: 10px;
            margin-right: 5px;
        }
    </style>

    <?php
    if (Yii::$app->request->get()) {
        $entidadeSelecionada = Yii::$app->request->get('entidade');
        var_dump($entidadeSelecionada); // Verifica o valor selecionado na dropdown
    }
    ?>
    <ul>
        <?php foreach ($eventos as $evento): ?>
            <li>
                <strong><?= Html::encode($evento->area) ?></strong>
                <br>
                Título: <?= Html::encode($evento->summary) ?>                
                <br>
                Início: <?= Html::encode($evento->start) ?>
                <br>
                Fim: <?= Html::encode($evento->end) ?>
                <br>
                Duração: <?= Html::encode($evento->duracao) ?>
                <br>
                Descrição: <?= Html::encode($evento->description) ?>              
                <br>
                Provincia: <?= Html::encode($evento->provincia->nomeProvincia) ?>
                <br>
                Município: <?= Html::encode($evento->municipio->nomeMunicipio) ?>
                <br>
                Comuna: <?= Html::encode($evento->comuna->nomeComuna) ?>
                <br>
                Local: <?= Html::encode($evento->local) ?>                
                <br>
                Entidade Organizadora: <?= Html::encode($evento->entidadeOrganizadora) ?>
                <br>
                Convocado Por: <?= Html::encode($evento->convocadoPor) ?>
                <br>
                Participantes: <?= Html::encode($evento->participantes) ?>           
            </li>
        <?php endforeach; ?>
    </ul>
</div>
