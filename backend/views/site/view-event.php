<?php
//// Utilize as variáveis passadas pelo controlador
//$isAdmin = $isAdmin ?? false;
//$nomeUsuario = $nomeUsuario ?? '';
$convocadoPor = $convocadoPor ?? '';
?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- As informações do evento serão exibidas aqui -->
        <p><strong>Id:</strong> <span id="modalId"></span></p>
        <p><strong>Descrição:</strong> <span id="modalDescription"></span></p>
        <p><strong>Data de Início:</strong> <span id="modalStart"></span></p>
        <p><strong>Data de Término:</strong> <span id="modalEnd"></span></p>
        <p><strong>Área:</strong> <span id="modalArea"></span></p>
        <p><strong>Duração:</strong> <span id="modalDuracao"></span></p>
        <p><strong>Província:</strong> <span id="modalProvincia"></span></p>
        <p><strong>Municipio:</strong> <span id="modalMunicipio"></span></p>
        <p><strong>Comuna:</strong> <span id="modalComuna"></span></p>
        <p><strong>Local:</strong> <span id="modalLocal"></span></p>
        <p><strong>Coordenadas:</strong> <span id="modalCoordenadas"></span></p>
        <p><strong>Entidade Organizadora:</strong> <span id="modalEntidade"></span></p>
        <p><strong>Convocado Por:</strong> <span id="modalConvocadoPor"><?= Html::encode($convocadoPor) ?></span></p>
        <p><strong>Participantes:</strong> <span id="modalParticipantes"></span></p>
    </div>
    <div class="modal-footer">
        <?php if ($isAdmin || $nomeUsuario == $convocadoPor): ?>
            <button type="button" class="btn btn-primary" id="editEventButton" data-event-id="">Editar</button>
            <button type="button" class="btn btn-danger" name="deleteEventButton" id="deleteEventButton">Eliminar</button>
        <?php endif; ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
    </div>
</div>

