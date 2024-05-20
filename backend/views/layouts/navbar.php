<?php

use yii\helpers\Html;
use yii\helpers\Url;

// Obtém o usuário logado

$user = Yii::$app->user->identity;

$listaDeTabelas = [
    // 'agua',
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
// foreach ($listaDeTabelas as $tabela) {
//     $modelClass = 'backend\models\\' . $tabela;
//     $pendentesCount += Yii::createObject(['class' => $modelClass])->find()
//             ->where(['entidade' => $user->entidade, 'estadoValidacao' => 'Pendente'])
//             ->count();
//     $validadosCount += Yii::createObject(['class' => $modelClass])->find()
//             ->where(['entidade' => $user->entidade, 'estadoValidacao' => 'Validado'])
//             ->count();
//     $aprovadosCount += Yii::createObject(['class' => $modelClass])->find()
//             ->where(['entidade' => $user->entidade, 'estadoValidacao' => 'Aprovado'])
//             ->count();
//     $publicadosCount += Yii::createObject(['class' => $modelClass])->find()
//             ->where(['entidade' => $user->entidade, 'estadoValidacao' => 'Publicado'])
//             ->count();
// }


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
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="width: 83vw;">

    <!-- Left navbar links -->
    <!--    <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>-->
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <!--        <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>-->


        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"> <?= $totalNotificacoes ?> </span>
            </a>


            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
                <span class="dropdown-header"><?= $pendentesCount + $aprovadosCount + $validadosCount ?>  Notificações</span>
                <div class="dropdown-divider"></div>

                <?php if ($user1->can('Permissao Validador de dados')): ?>
                    <a href="<?= Url::to(['validar']) ?>" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> <?= $pendentesCount ?> Registos por Validar
                    </a>
                    <div class="dropdown-divider"></div>
                <?php endif; ?>

                <?php if ($user1->can('Perfil Aprovação de dados')): ?>
                    <a href="<?= Url::to(['publicar']) ?>" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> <?= $validadosCount ?> Por aprovar
                    </a>
                <?php endif; ?>

                <?php if ($user1->can('Perfil Lancamento')): ?>
                    <a href="<?= Url::to(['aprovar']) ?>" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> <?= $aprovadosCount ?> registos por Publicar
                    </a>
                    <div class="dropdown-divider"></div>
                <?php endif; ?>



                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">Ver todas as notificações</a>
            </div>

        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Url::home() ?>" class="nav-link">Interface Privada</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Yii::$app->urlManagerFrontend->createUrl('/site/index') ?>" class="nav-link">Interface Pública</a>
        </li>

    </ul>    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" style="margin-right:1% !important;">
       <?php if (!Yii::$app->user->isGuest && !empty(Yii::$app->user->identity)): ?>
    <!-- User Image -->
    <li class="nav-item">
        <div class="image">
            <img style="width: 30px; height: 30px;" src="images/userGeral.png" class="img-circle elevation-2">
        </div>
    </li>

    <!-- User Info (Name) and Logout Button -->
    <li class="nav-item">
        <div class="info d-flex align-items-center">
            <b style="color: #888C00 !important; margin-left: 10px; margin-right: -5px; margin-top: -5px;">
                <?= strtoupper(Yii::$app->user->identity->username) ?> | <?= Yii::$app->user->identity->entidade ?>
            </b>
            <div style="margin-top:-2px;">
                <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/site/logout'], ['data-method' => 'post', 'class' => 'nav-link logout-button', 'title' => 'Sair']) ?>
            </div>
        </div>
    </li>
<?php endif; ?>


    </ul>
</nav>
<!-- /.navbar -->

