<style>
    .logout-button {
        margin-left: 37px; /* Move o botão de logout para a direita */
    }
    .navbar {
        min-height: 5px !important; /* Defina a altura mínima desejada para o navbar */
    }
</style>
<?php

use yii\helpers\Html;
use yii\helpers\Url;

// Obtém o usuário logado

$user = Yii::$app->user->identity;

$listaDeTabelas = [
    'agua',
    'Capacitacao',
    'demostracoesculinarias',
    'eventos',
    'grupo',
    'doccomunicacao',
    'materiais',
    'merendaescolar',
    'pacotepedagfresan',
    'profissionaissaude',
    'rastreio',
    'reforcoinstitucional',
    'supervisao',
    'suplementacao',
];

// Consulta para contar registros com estado "Pendente" da entidade do usuário logado
$validadosCount = 0; // Inicialize o contador para "Validado"
$aprovadosCount = 0; // Inicialize o contador para "Aprovado"
$publicadosCount = 0; // Inicialize o contador para "Publicado"
$pendentesCount = 0; // Inicialize o contador para "Publicado"
// Percorra a lista de tabelas e conte os registros de cada estado
foreach ($listaDeTabelas as $tabela) {
    $modelClass = 'backend\models\\' . $tabela;
    $pendentesCount += Yii::createObject(['class' => $modelClass])->find()
            ->where(['entidade' => $user->entidade, 'estadoValidacao' => 'Pendente'])
            ->count();

    $validadosCount += Yii::createObject(['class' => $modelClass])->find()
            ->where(['entidade' => $user->entidade, 'estadoValidacao' => 'Validado'])
            ->count();

    $aprovadosCount += Yii::createObject(['class' => $modelClass])->find()
            ->where(['entidade' => $user->entidade, 'estadoValidacao' => 'Aprovado'])
            ->count();

    $publicadosCount += Yii::createObject(['class' => $modelClass])->find()
            ->where(['entidade' => $user->entidade, 'estadoValidacao' => 'Publicado'])
            ->count();
}


$user1 = Yii::$app->user;

//calculo do total de notificacoes
$totalNotificacoes = 0;

if ($user1->can('Permissao Validador de dados')) {
    $totalNotificacoes += $pendentesCount;
}

if ($user1->can('Perfil Aprovação de dados')) {
    $totalNotificacoes += $validadosCount;
}

if ($user1->can('Perfil Lancamento')) {
    $totalNotificacoes += $aprovadosCount;
}
?>

<!-- Navbar -->

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <!--        <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>-->
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Url::home() ?>" class="nav-link">Início</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <div class="user-panel d-flex" style="position:relative;margin-left: -5px;">
            <div class="image">
                <img style="position:relative;margin-right: 19px" src="images/userGeral.png" class="img-circle elevation-2" >
            </div>
            <div class="info">
                <b class="d-block" style="color: #888C00 !important;position:absolute ;margin-left: -22px !important; "><?php echo strtoupper(\Yii::$app->user->identity->username); ?> | <?php echo \Yii::$app->user->identity->entidade; ?></b>
                           </div>
             <div style="margin-top:-1px;">
                  <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link logout-button', 'title' => 'Sair']) ?>
                 </div>

        </div>
       
    </ul>
</nav>

<!-- /.navbar -->