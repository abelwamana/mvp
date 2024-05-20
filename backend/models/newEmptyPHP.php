<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap4\Alert;
use yii\widgets\Breadcrumbs;
use \yii2fullcalendar\yii2fullcalendar;
use backend\controllers\SiteController;

$this->title = 'Calendário';
?>
<div style="position: relative;">
    <!--Breadcrumbs-->
    <?php if (isset($this->params['breadcrumbs']) && count($this->params['breadcrumbs']) > 1) : ?>
        <nav aria-label="breadcrumb" class="float-sm-right">
            <ol class="breadcrumb">
                <?php foreach ($this->params['breadcrumbs'] as $breadcrumb) : ?>
                    <li class="breadcrumb-item"><?= isset($breadcrumb['/event/index']) ? Html::a($breadcrumb['label'], $breadcrumb['/site/calendario2']) : $breadcrumb['label'] ?></li>
                <?php endforeach; ?>
            </ol>
        </nav> 
    <?php endif; ?>

    <?= Html::a('Lista de Eventos', ['/event/index'], ['class' => 'btn btn-primary']) ?>

    <style>
        .legend {
            position: absolute;
            top: 44px;
            right: 180px;
            background-color: #fff;
            padding: 4px;
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
        .filtro {
            position: absolute;
            top: 40px;
            right: 417px;
            background-color: #fff;
            padding: 4px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0px 1px rgba(0, 0, 0, 0.1);
        }

        .filtro-button {
            display: inline-block;
            width: 1px;
            height: 2px;
            margin-right: 5px;
        }

        .custom-dropdown {
            height: 25px; /* Defina a altura desejada para o dropdown */
        }
        .custom-form {
            height: 25px; /* Defina a altura desejada para o formulário */
        }
        .custom-button {
            height: 24px; /* Defina a altura desejada para o botão */
            margin-top: -5px;
            padding-top: 0px; /* Ajuste o preenchimento superior para centralizar o texto verticalmente */
            padding-bottom: 10px; /* Ajuste o preenchimento inferior para centralizar o texto verticalmente */
        }

    </style>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <?=
        Alert::widget([
            'options' => ['class' => 'alert-success'],
            'body' => Yii::$app->session->getFlash('success'),
        ])
        ?>

    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <?=
        Alert::widget([
            'options' => ['class' => 'alert-danger'],
            'body' => Yii::$app->session->getFlash('error'),
        ])
        ?>
    <?php endif; ?>

    <?php
    if (Yii::$app->request->get()) {
        $entidadeSelecionada = Yii::$app->request->get('entidade');
        var_dump(Yii::$app->request->get('entidade')); // Verifica o valor selecionado na dropdown
    }
    ?>
    <?php
// Faça uma solicitação AJAX para obter os eventos
    $entidadeSelecionada = Yii::$app->request->get('entidade');

//$eventsUrl = Yii::$app->urlManager->createUrl(['site/get-events']);
//$eventsUrl = Yii::$app->urlManager->createUrl(['site/get-events', 'entidade' => $entidadeSelecionada]);



    $js = <<<JS
    // Faça uma solicitação AJAX para obter os eventos
    $.ajax({
        url: 'site/get-events',
        type: 'GET',
        success: function(events) {
            // Inicialize o widget FullCalendar com os eventos obtidos
            $('#calendar').fullCalendar({
                // Configuração do calendário...
                events: events
            });
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
JS;

    $this->registerJs($js);
    ?>


    <?=
    \talma\widgets\FullCalendar::widget([
    // 'googleCalendar' => true, // Habilita o uso do Google Calendar
    'loading' => 'Carregando...', // Texto de carregamento
    'config' => [
    'lang' => 'pt-br', // Idioma do calendário
    'header' => [// Configuração do cabeçalho do calendário
    'left' => 'prev,next today title',
    // 'center' => 'title',
    'right' => 'month,basicWeek,basicDay',
    ],
    'editable' => true, // Permite editar eventos (arrastar e soltar)
    'firstDay' => 1, // Começa a semana na segunda-feira
    'eventSources' => [
    // Adiciona a fonte de eventos JSON usando a URL do método actionGetEvents
    ['url' => Yii::$app->urlManager->createUrl(['site/get-events'])],
    ],
    'eventClick' => new \yii\web\JsExpression('function(event) {
            // Abra um modal com os detalhes do evento
            $("#eventInfoModal").modal("show");
            $("#modalTitle").text(event.summary); // Define o título do modal como o título do evento
            $("#modalDescription").html("<p>Descrição: " + event.description + "</p>"); // Adiciona a descrição do evento ao corpo do modal
            // Adicione mais informações conforme necessário, como data, localização, etc.
        }'),
    'dayClick' => new \yii\web\JsExpression('function(date, jsEvent, view) {
            // Lidar com o evento de clique em um dia vazio
            // Por exemplo, exibir um modal para adicionar um novo evento
            $("#addEventModal").modal("show");
            $("#eventDate").val(date.format()); // Preencha o campo de data no modal
        }'),
    'eventRender' => new \yii\web\JsExpression('function(event, element) {
            // Adiciona o título do evento ao elemento do dia
            element.find(".fc-content").append("<span class=\"fc-title\">" + event.summary + "</span>");
             if (event.summary === "Reunião1") {
                element.css("background-color", "blue");
            } else if (event.summary === "Reunião2") {
                element.css("background-color", "gray");
            }
        }'),
    // Adicione a legenda no cabeçalho da visualização do calendário
    'viewRender' => new \yii\web\JsExpression('function(view, element) {
            var legendHtml = "<div style=\"position:absolute; top:10px; right:10px;\"><h4>Legenda:</h4><ul><li><span style=\"color:blue;\">Reunião 1</span></li><li><span style=\"color:gray;\">Reunião 2</span></li></ul></div>";
            $(element).find(".fc-toolbar").append(legendHtml);
        }'),
    // Outras configurações do FullCalendar aqui
    ],
    ]);
    ?> 
    

    <div class="filtro" style="margin-top: 14px;">

<?= Html::beginForm(['site/filtragem'], 'get', ['id' => 'filter-form', 'class' => 'custom-form']) ?>
        <?= Html::dropDownList('entidade', null, ['UIC' => 'UIC', 'ADRA' => 'ADRA', 'CUAMM' => 'CUAMM'], ['prompt' => 'Entidade', 'class' => 'custom-dropdown']) ?>
        <?= Html::dropDownList('area', null, ['' => 'Nutrição', 'nutricao' => 'ADRA', 'CUAM' => 'CUAM'], ['prompt' => 'Área', 'class' => 'custom-dropdown']) ?>
        <?= Html::dropDownList('provincia', null, ['Benguela' => 'Benguela', 'ADRA' => 'ADRA', 'CUAM' => 'CUAM'], ['prompt' => 'Provincia', 'class' => 'custom-dropdown']) ?>
        <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary custom-button', 'id' => 'filter-btn']) ?>
        <?= Html::endForm() ?>
        <div id="selected-entity"></div> <!-- Div para exibir o valor selecionado -->

<script>
$(document).ready(function() {
    $('#filter-btn').click(function(event) {
        event.preventDefault(); // Evita o envio do formulário padrão

        // Recupera o valor selecionado na lista suspensa
        var entidade = $('#entidade').val();

        // Exibe o valor selecionado na div
        $('#selected-entity').text('Entidade selecionada: ' + entidade);

        // Se desejar, você pode enviar o valor selecionado por AJAX para o servidor
        // e realizar ações adicionais lá
    });
});
</script>

    
<script>
    $(document).ready(function() {
        $('#filter-btn').click(function(event) {
            event.preventDefault(); // Evita o envio do formulário padrão

            // Envia uma solicitação AJAX para chamar o método ActionCalendario2
            $.ajax({
                url: 'site/calendario', // Altere para a URL correta do seu método ActionCalendario2
                type: 'GET',
                success: function(response) {
                    // Atualiza o conteúdo da página com a resposta do método ActionCalendario2
                    $('body').html(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#filter-btn').click(function(event) {
            event.preventDefault(); // Evita o envio do formulário padrão

            // Recupera o valor selecionado na lista suspensa
            var entidade = $('#entidade').val();

            // Envia uma solicitação AJAX para chamar o método actionGetEvents
            $.ajax({
                url: 'site/get-events',
                type: 'GET',
                data: { entidade: entidade },
                success: function(response) {
                    // Atualiza o conteúdo do calendário com os novos eventos
                    $('#calendar').fullCalendar('refetchEvents');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>

    </div>
    <div class="legend" style="margin-top: 10px;">
        <span class="event-color" style="background-color: blue;"></span> Agricultura
        <span class="event-color" style="background-color: #3a87ad;"></span> Nutrição
        <span class="event-color" style="background-color: gray;"></span> Água
    </div>

    <!-- Modal para adicionar um novo evento -->
    <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Adicionar Novo Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário para adicionar um novo evento -->
<?php $form = ActiveForm::begin(['id' => 'addEventForm']); ?>    
                    <?= $form->field($eventModel, 'summary')->textInput(['placeholder' => 'Título do Evento']) ?>

                    <?= $form->field($eventModel, 'description')->textInput(['placeholder' => 'Escreva o endereço ou o link se for remoto']) ?>

                    <?= $form->field($eventModel, 'start')->textInput(['type' => 'datetime-local', 'placeholder' => 'Data e Hora de Início']) ?>

                    <?= $form->field($eventModel, 'end')->textInput(['type' => 'datetime-local', 'placeholder' => 'Data e Hora de Término']) ?>

                    <?= $form->field($eventModel, 'localizacao')->textInput(['placeholder' => 'Localização']) ?>

                    <?= $form->field($eventModel, 'entidadeOrganizadora')->textInput(['placeholder' => 'Entidade Organizadora']) ?>

                    <?= $form->field($eventModel, 'participantes')->textInput(['placeholder' => 'Participantes']) ?>

                    <div class="form-group">
<?= Html::submitButton('Adicionar Evento', ['class' => 'btn btn-primary']) ?>
                    </div>

<?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal para exibir informações do evento -->
    <div class="modal fade" id="eventInfoModal" tabindex="-1" role="dialog" aria-labelledby="eventInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventInfoModalLabel">Detalhes do Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- As informações do evento serão exibidas aqui -->
                    <p><strong>Título:</strong> <span id="eventTitle"></span></p>
                    <p><strong>Descrição:</strong> <span id="eventDescription"></span></p>
                    <p><strong>Data de Início:</strong> <span id="eventStart"></span></p>
                    <p><strong>Data de Término:</strong> <span id="eventEnd"></span></p>       
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <!-- Adicione botões adicionais aqui, se necessário -->
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('body').on('change', '#entidade', function () {
            $('#calendar').fullCalendar('refetchEvents');
        });
    });
</script>
<?php 
            if (!(Yii::$app->request->get())) {
        \backend\models\Selecao::deleteAll();
    }
    ?> 


'eventRender' => new \yii\web\JsExpression('function(event, element) {
    // Adiciona o título do evento ao elemento do dia
    element.find(".fc-content").append("<span class=\"fc-title\">" + event.summary + "</span>");

    // Adiciona a descrição do evento
    element.find(".fc-content").append("<span class=\"fc-description\">" + event.description + "</span>");

    // Adiciona o início do evento
    element.find(".fc-content").append("<span class=\"fc-start\">" + event.start + "</span>");

    // Adiciona o fim do evento
    element.find(".fc-content").append("<span class=\"fc-end\">" + event.end + "</span>");

    // Adiciona a localização do evento
    element.find(".fc-content").append("<span class=\"fc-location\">" + event.location + "</span>");

    // Adiciona a entidade organizadora do evento
    element.find(".fc-content").append("<span class=\"fc-organizer\">" + event.entidadeOrganizadora + "</span>");

    // Adiciona os participantes do evento
    element.find(".fc-content").append("<span class=\"fc-participants\">" + event.participants + "</span>");
}');
Nutricão Coordenacão Água Agricultura Reforço Institucional Outro

//                    'items' => [
//                        [
//                            'label' => '<div class="legend" style="margin-top: 10px;">
//                           <ul>
//                               <li><span class="event-color" style="background-color: green;"></span> Agricultura</li>
//                               <li><span class="event-color" style="background-color: #cccc33;"></span> Nutrição</li>
//                               <li><span class="event-color" style="background-color: #6699ff;"></span> Água</li>
//                               <li><span class="event-color" style="background-color: #99cc33;"></span> Coordenação</li>
//                               <li><span class="event-color" style="background-color: gray;"></span> Reforço Institucional</li>
//                               <li><span class="event-color" style="background-color: black;"></span> Outros</li>
//                           </ul>
//                       </div>',
//                            'encode' => false,
//                        ],
//                    ],