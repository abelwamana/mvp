<link rel="stylesheet" 
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    /* Altere a cor de fundo do tipo 'info' do painel para a cor desejada */
    .card-header  {
        background-color: #919733; /* Substitua pelo código de cor desejado */
        color: #ffffff; /* Cor do texto para legibilidade */
    }
    .btn.btn-primary.botao {
        background-color: #919733; /* Cor de fundo do botão primário Bootstrap */
        color: #fff; /* Cor do texto para legibilidade */
        /* Outros estilos conforme necessário */
    }

</style>
<?php

use backend\models\Biblioteca;
use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\grid\GridView;

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
             <th>Convite</th>
             <th>Actividade</th>
             <th>Organizacao</th>
             <th>Codigo</th>            
            <th>Arquivo</th>           
<!--             <th>Tipo de arquivo</th>
              <th>Tamanho do Arquivo</th>-->
<!--            'codigo' => Yii::t('app', ''),
            'titulo' => Yii::t('app', ''),
            'autores' => Yii::t('app', 'Autores'),
            'tema' => Yii::t('app', 'Tema'),
            'descricao' => Yii::t('app', 'Descricao'),
            'classificacao' => Yii::t('app', 'Classificacao'),
            'tipo' => Yii::t('app', 'Tipo'),
            'estado' => Yii::t('app', 'Estado'),
            'dataEstado' => Yii::t('app', 'Data Estado'),
            'anoConcluido' => Yii::t('app', 'Ano Concluido'),
            'numPagina' => Yii::t('app', 'Num Pagina'),
            'responsavelGestorUIC' => Yii::t('app', 'Responsavel Gestor Uic'),
            'usuarios' => Yii::t('app', 'Usuarios'),
            'informacaoPlanilha' => Yii::t('app', 'Informacao Planilha'),
            'monitoriatemarquivo' => Yii::t('app', 'Monitoriatemarquivo'),
            'estaNoSiteFRESANLBC' => Yii::t('app', 'Esta No Site Fresanlbc'),
            'linkFresanLbc' => Yii::t('app', 'Link Fresan Lbc'),-->
<!--             <th>Titulo</th>
             <th>Convite</th>
             <th>Convite</th>
             <th>Convite</th>
             <th>Convite</th>
             <th>Convite</th>
             <th>Convite</th>-->
<th>Data de Upload</th>
        
        </tr>
    </thead>
    <tbody>
        <?php foreach ($model as $item): ?>
        <tr>
            <td><?= Html::encode($item->titulo) ?></td>
            <td><?= Html::encode($item->descricao) ?></td>
            <td><?= Html::encode($item->convite) ?></td>
            <td><?= Html::encode($item->actividade) ?></td>
            <td><?= Html::encode($item->organizacao) ?></td>
            <td><?= Html::encode($item->codigo) ?></td>
            <td><?= Html::a('Download', ['biblioteca/download', 'id' => $item->id]) ?></td>
            <td><?= Yii::$app->formatter->asDatetime($item->data_upload) ?></td>
<!--             <td><?= Html::encode($item->tipo_arquivo) ?></td>
             <td><?= Html::encode($item->tamanho_arquivo) ?></td>-->
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
