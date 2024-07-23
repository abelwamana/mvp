<style>
    .custom-nav-item a {
        white-space: nowrap;
        padding-left: 10px;
        padding-right: 10px;
    }

    .navbar-nav .dropdown-menu {
        width: auto; /* Ajusta a largura do dropdown ao conteúdo */
        max-width: 400px; /* Define uma largura máxima para evitar que o dropdown fique muito largo */
    }

    .dropdown-item {
        white-space: nowrap; /* Evita que o texto quebre para a linha seguinte */
        overflow: hidden;
        text-overflow: ellipsis; /* Adiciona reticências (...) quando o texto é muito longo */
    }

    @media (max-width: 1009px) {
        .d-custom-block {
            display: block !important;
        }
    }

    @media (min-width: 1010px) {
        .d-custom-block {
            display: none !important;
        }
    }
</style>

<?php

use backend\models\Notificacoes;
use yii\helpers\Html;
use yii\helpers\Url;

$user = Yii::$app->user->identity;

$listaDeTabelas = [
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

$validadosCount = 0;
$aprovadosCount = 0;
$publicadosCount = 0;
$pendentesCount = 0;

$notificacoesEventos = Notificacoes::find()
        ->where(['id_usuario' => Yii::$app->user->id, 'estado' => 0])
        ->all();

$user1 = Yii::$app->user;
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

$totalNotificacoes += count($notificacoesEventos);
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light" style="width: 83vw;">
    <ul class="navbar-nav">
        <li class="nav-item d-none d-custom-block">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"> <?= $totalNotificacoes ?> </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left" style="width: 405px !important;">
                <?php if ($totalNotificacoes == 1): ?>
                    <span class="dropdown-header"><?= $totalNotificacoes ?> Notificação</span>
                <?php else: ?>
                    <span class="dropdown-header"><?= $totalNotificacoes ?> Notificações</span>
                <?php endif; ?>
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

                <?php foreach ($notificacoesEventos as $notificacao): ?>
                    <a href="#" class="dropdown-item event-notification"
                       data-id="<?= Html::encode($notificacao->Id) ?>"
                       data-descricao="<?= Html::encode($notificacao->mensagem) ?>">
                        <i class="fas fa-calendar-alt mr-2"></i> <?= Html::encode($notificacao->mensagem) ?>
                    </a>
                    <div class="dropdown-divider"></div>
                <?php endforeach; ?>

                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">Ver todas as notificações</a>
            </div>
        </li>

        <li class="nav-item custom-nav-item">
            <a class="nav-link" href="<?= Yii::$app->urlManagerFrontend->createUrl('/site/index') ?>">Interface Pública</a>
        </li>
        <li class="nav-item custom-nav-item">
            <a class="nav-link" href="<?= Url::home() ?>">Interface Privada</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto" style="margin-right:1% !important;">
        <?php if (!Yii::$app->user->isGuest && !empty(Yii::$app->user->identity)): ?>
            <li class="nav-item">
                <div class="image">
                    <img style="width: 30px; height: 30px;" src="images/userGeral.png" class="img-circle elevation-2">
                </div>
            </li>

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

<!-- Modal para exibir informações do evento -->
<div class="modal fade" id="event-info-modal" tabindex="-1" role="dialog" aria-labelledby="eventInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Descrição:</strong> <span id="modalDescricao"></span></p>
                <p><strong>Data de Início:</strong> <span id="modaldataInicio"></span></p>
                <p><strong>Data de Término:</strong> <span id="modaldataFim"></span></p>
                <p><strong>Área:</strong> <span id="modalAreaN"></span></p>
                <p><strong>Duração:</strong> <span id="modalDuracaoN"></span></p>
                <p><strong>Província:</strong> <span id="modalProvinciaN"></span></p>
                <p><strong>Município:</strong> <span id="modalMunicipioN"></span></p>
                <p><strong>Comuna:</strong> <span id="modalComunaN"></span></p>
                <p><strong>Local:</strong> <span id="modalLocalN"></span></p>
                <p><strong>Coordenadas:</strong> <span id="modalCoordenadasN"></span></p>
                <p><strong>Entidade:</strong> <span id="modalEntidadeN"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Certifique-se de que o jQuery está sendo carregado -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function () {
        console.log('Documento pronto, vinculando eventos...');
        $('.event-notification').on('click', function (e) {
            e.preventDefault();
            console.log('Clique detectado em uma notificação de evento.');
            var eventId = $(this).data('id');
            var eventDescription = $(this).data('descricao');
            console.log('ID do Evento: ' + eventId);
            $.ajax({
                url: '<?= Url::to(['event/get-event-details']) ?>',
                type: 'GET',
                data: {id: eventId},
                success: function (response) {
                    console.log(response);
                    $('#modalTitulo').text(response.summary);
                    $('#modalDescricao').text(response.description);
                    $('#modaldataInicio').text(response.start);
                    $('#modaldataFim').text(response.end);
                    $('#modalAreaN').text(response.area);
                    $('#modalDuracaoN').text(response.duracao);
                    $('#modalProvinciaN').text(response.provincia);
                    $('#modalMunicipioN').text(response.municipio);
                    $('#modalComunaN').text(response.comuna);
                    $('#modalLocalN').text(response.local);
                    $('#modalCoordenadasN').text(response.coordenadas);
                    $('#modalEntidadeN').text(response.entidadeOrganizadora);
                    $('#event-info-modal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.log('Erro na requisição AJAX:', error);
                    alert('Erro ao carregar os detalhes do evento.');
                }
            });
        });
        $('#event-info-modal').on('hidden.bs.modal', function () {
           console.log('Botão Fechar do modal clicado, recarregando a página...');
            location.reload();
        });


        $(document).on('click', '.close-modal', function () {
            console.log('Botão Fechar do modal clicado, recarregando a página...');
            location.reload();
        });
    });
</script>
