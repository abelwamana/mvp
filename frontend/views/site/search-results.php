<?php
use yii\helpers\Html;

$this->title = 'Resultados da Busca';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="search-results">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <!-- Adicione o formulário de pesquisa aqui -->
    <div class="gcse-searchbox"></div>
    
    <?php if (!empty($dataProvider->getModels())): ?>
        <ul>
            <?php foreach ($dataProvider->getModels() as $model): ?>
                <li>
                    <?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Nenhum resultado encontrado.</p>
    <?php endif; ?>
    
    <!-- Adicione os resultados da busca aqui -->
    <div class="gcse-searchresults"></div>
</div>

