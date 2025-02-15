<style>
    .event-color {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin-right: 5px;
    }

    .custom-button {
        height: 38px;  /*Defina a altura desejada para o botão */
        margin-top:-46.5px;
        right: 110px !important;
        /*margin-right: 10px;*/
        background-color: #999900;
        border-color: #999900;
        border-radius: 3px 3px 3px 3px;
    }

    .nao-mostra {
        display: none;
    }
    @media print {
        .nao-imprimi {
            display: none !important;
        }
        .imprimi {
            display: block;
        }
    }
    .fc-toolbar .fc-left
    {

        margin-left: -1.3%;
    }
    .fc-toolbar .fc-right
    {

        margin-right: -1.3%;
    }
    .container{
        position: relative;
        width: 100%;
        max-width: 100%;

    }
    .has-error .help-block {
        color: red;
    }
    .fc-center h2 {
        text-transform: uppercase;
    }
    .file-upload-label {
        display: block;
    }
    /* Reduzir o tamanho do texto "Nenhum ficheiro selecionado" */
    input#event-agenda {
        font-size: 12px;
    }
    input#event-actarelatorio {
        font-size: 12px;
    }
    input#event-listaparticipantes {
        font-size: 12px;
    }
    input#event-listaconvidados {
        font-size: 12px;
    }
    input#event-pada {
        font-size: 12px;
    }
    input#event-outrosanexos {
        font-size: 12px;
    }
    .anexos-section {
        margin-top: 20px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .anexos-section h3 {
        margin-bottom: 15px;

    }
    .file-upload-label {
        font-weight: normal !important;
        text-decoration: underline;
        margin-top: -1%;
    }
    legend {
        font-weight: bold;
        font-size: 18px;
    }

</style>
<div class="container">
    <?php

    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
    use yii\bootstrap4\Alert;
    use yii\widgets\Breadcrumbs;
    use \yii2fullcalendar\yii2fullcalendar;
    use backend\controllers\SiteController;
    use backend\models\Event;
    use yii\helpers\ArrayHelper;
    use backend\models\Provincia;
    use yii\web\View;
    use kartik\select2\Select2;
    use backend\models\Contacto;

$provincias = [
        'Cunene' => 'Cunene',
        'Huila' => 'Huila',
        'Namibe' => 'Namibe',
            // Adicione mais itens conforme necessário
    ];
    
    $municipios = \backend\models\Municipio::find()
    ->select(['nomeMunicipio', 'nomeMunicipio'])
    ->indexBy('nomeMunicipio')
    ->column();

    $entidades = [
         'Camões, I.P. | ADESPOV/C4' => 'Camões, I.P. | ADESPOV/C4',
                    'Camões, I.P. | ADPP/C1' => 'Camões, I.P. | ADPP/C1',
                    'Camões, I.P. | ADRA/C4' => 'Camões, I.P. | ADRA/C4',
                    'Camões, I.P. | CODESPA/C2' => 'Camões, I.P. | CODESPA/C2',
                    'Camões, I.P. | CODESPA/C4' => 'Camões, I.P. | CODESPA/C4',
                    'Camões, I.P. | COSPE/C1' => 'Camões, I.P. | COSPE/C1',
                    'Camões, I.P. | CUAMM/C2' => 'Camões, I.P. | CUAMM/C2',
                    'Camões, I.P. | CUAMM/C4' => 'Camões, I.P. | CUAMM/C4',
                    'Camões, I.P. | DW/C1' => 'Camões, I.P. | DW/C1',
                    'Camões, I.P. | DW/C4' => 'Camões, I.P. | DW/C4',
                    'Camões, I.P. | FEC/C2' => 'Camões, I.P. | FEC/C2',
                    'Camões, I.P. | FEC/C4' => 'Camões, I.P. | FEC/C4',
                    'Camões, I.P. | NCA/C1' => 'Camões, I.P. | NCA/C1',
                    'Camões, I.P. | NCA/C4' => 'Camões, I.P. | NCA/C4',
                    'Camões, I.P. | PIN/C2' => 'Camões, I.P. | PIN/C2',
                    'Camões, I.P. | PIN/C4' => 'Camões, I.P. | PIN/C4',
                    'Camões, I.P. | TESE/C4' => 'Camões, I.P. | TESE/C4',
                    'Camões, I.P. | UIC' => 'Camões, I.P. | UIC',
                    'Camões, I.P. | WVI/C1' => 'Camões, I.P. | WVI/C1',
                    'Camões, I.P. | WVI/C4' => 'Camões, I.P. | WVI/C4',
                    'FAO' => 'FAO',
                    'Governo' => 'Governo',
                    'PNUD' => 'PNUD',
                    'Vall d´Hebron' => 'Vall d´Hebron',
                    'Outra' => 'Outra'
    ];
    $areas = [
        "Agricultura e Pecuária" => "Agricultura e Pecuária",
        "Nutrição" => "Nutrição",
        "Água" => "Água",
        "Reforço Institucional" => "Reforço Institucional",
        "Coordenação UIC" => "Coordenação UIC",
        'Subvenções/M&A' => 'Subvenções/M&A',
        'Governo' => 'Governo',
        "Outras" => "Outras"
    ];
    $this->title = 'Calendário';
    $nomeUsuario = Yii::$app->user->identity->nomeCompleto;
    ?>

    <div class="col-12 justify-content-between align-items-center" style="margin-top: 30px;">
        <div class="align-items-center" style="margin-left: 8.7px; max-width: 98.4%;">       
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

        </div>
        <div class="nao-mostra imprimi" style="background-image: url('images/branco.png')">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <div class="col-6"  style="margin-left: -27px;">  
                    <?=
                    Html::a(
                            '<img style="width: 145%;" src="images/logo221.png">',
                            ['/site/index']
                    );
                    ?>

                </div> 
                <div class="col-6 text-right"  style="margin-right: 3px; ">  
                    <img style="width: 7%; margin-right:-15px; position: relative;" src="images/logo24.png">

                </div>
                <!--<div class="col-6" style="margin-right: -588px; position: relative" >  </div>-->
            </div>

            <img style="width: 100%; max-width: 100%;" src="images/barra1.png">
        </div>
        <!--<div class="col-12 style="margin-left: 230px;" style="margin-top: 16px;" >-->  
        <div class="nao-imprimi">
            <div class="row align-items-center" style="margin-left: 1px; max-width: 99.7%;">    
                <div class="col-3">
                    <?=
                    Select2::widget([
                        'name' => 'provincias',
                        'id' => 'provincias',
                        'value' => '',
                        'data' => $provincias,
                        'options' => ['multiple' => true, 'placeholder' => 'Filtrar por Província(s)'],
                        'pluginOptions' => ['width' => '94%'],
                    ]);
                    ?>
                </div>
                
                 <div class="col-3" style="margin-left: -20px;">
                    <?=
                    Select2::widget([
                        'name' => 'municipios',
                        'id' => 'municipios',
                        'value' => '',
                        'data' => $municipios,
                        'options' => ['multiple' => true, 'placeholder' => 'Filtrar por Município(s)'],
                        'pluginOptions' => ['width' => '94%'],
                    ]);
                    ?>
                </div>
                
                <div class="col-3" style="margin-left: -19px;">
                    <?=
                    Select2::widget([
                        'name' => 'entidades',
                        'id' => 'entidades',
                        'value' => '',
                        'data' => $entidades,
                        'options' => ['multiple' => true, 'placeholder' => 'Filtrar por Entidade(s)'],
                        'pluginOptions' => ['width' => '94%'],
                    ]);
                    ?>
                </div>
                <div class="col-3" style="margin-left: -19px;">
                    <?=
                    Select2::widget([
                        'name' => 'areas',
                        'id' => 'areas',
                        'value' => '',
                        'data' => $areas,
                        'options' => ['multiple' => true, 'placeholder' => 'Filtrar por área(s)'],
                        'pluginOptions' => ['width' => '94%'],
                    ]);
                    ?>
                </div>
               
                <div class="col-md-12 mt-2" style="margin-right: 10px;">
                    <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary custom-button float-right', 'id' => 'filter-btn']) ?>
                </div>
            </div>
        </div>

    </div>
    <div class="nao-mostra imprimi">
        <div class="col-6"  style = "position: absolute; margin-top: 12px;">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>
    <div class="meu-calendario-container text-right" style="width: 97%; margin-left: 1.3%;"> <!-- Defina a largura desejada aqui -->
        <?=
        \talma\widgets\FullCalendar::widget([
            //'googleCalendar' => true, // Habilita o uso do Google Calendar
            'options' => ['id' => 'meuCalendario'], // Adicione um ID ao seu calendário
            'loading' => 'Carregando...', // Texto de carregamento
            'config' => [
                'lang' => 'pt-br', // Idioma do calendário
                'header' => [// Configuração do cabeçalho do calendário
                    'left' => 'prev,next today',
                    'center' => 'title',
                    'right' => 'month,basicWeek,basicDay',
                ],
                'editable' => false, // Permite editar eventos (arrastar e soltar)
                'eventLimit' => true,
                'aspectRatio' => 1.05, // Defina o aspectRatio conforme necessário
                'expandRows' => true,
                'firstDay' => 1, // Começa a semana na segunda-feira
                'eventSources' => [
                    // Adiciona a fonte de eventos JSON usando a URL do método actionGetEvents
                    ['url' => Yii::$app->urlManager->createUrl(['site/get-events'])],
                ],
                'eventClick' => new \yii\web\JsExpression('function(event, jsEvent, view) {
            showEventDetails(event);
        }'),
                'dayClick' => new \yii\web\JsExpression('function(date, jsEvent, view) {
            showAddEventModal(date);
        }'),
                'eventRender' => new \yii\web\JsExpression('function(event, element) {
            styleEventElement(event, element);
        }'),
            ],
        ]);
        ?>

    </div > 
</div > 
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
                <?php
                $form = ActiveForm::begin([
                            'id' => 'addEventForm',
                            'action' => ['add-events'],
                            'method' => 'post',
                            'options' => ['onsubmit' => 'return checkParticipantes()', 'enctype' => 'multipart/form-data']
                ]);
                ?>
                <?= $form->field($eventModel, 'summary')->textInput(['placeholder' => 'Título do Evento']) ?>
                <?= $form->field($eventModel, 'description')->textInput(['placeholder' => 'Breve enquadramento e público alvo']) ?>
                <?= $form->field($eventModel, 'area')->dropDownList([
                    'Agricultura e Pecuária' => 'Agricultura e Pecuária',
                    'Nutrição' => 'Nutrição',
                    'Água' => 'Água',
                    'Reforço Institucional' => 'Reforço Institucional',
                    'Coordenação UIC' => 'Coordenação UIC',
                    'Subvenções/M&A' => 'Subvenções/M&A',
                    'Governo' => 'Governo',
                    'Outras' => 'Outras',
                        ], ['prompt' => 'Selecione a área'])
                ?>
                <?= $form->field($eventModel, 'start')->textInput(['id' => 'event-start', 'type' => 'datetime-local', 'placeholder' => 'Data e Hora de Início']) ?>
                <?= $form->field($eventModel, 'end')->textInput(['id' => 'event-end', 'type' => 'datetime-local', 'placeholder' => 'Data e Hora de Término']) ?>
                <?= $form->field($eventModel, 'duracao')->textInput(['id' => 'duracao-evento', 'readonly' => true]) ?>
                <?= $form->field($eventModel, 'provinciaID')->dropDownList($provinciasList, ['id' => 'provincia-select', 'prompt' => 'Selecione a província']) ?>
                <?= $form->field($eventModel, 'municipioID')->dropDownList([], ['id' => 'municipio-select', 'prompt' => 'Selecione o município']) ?>
                <?= $form->field($eventModel, 'comunaID')->dropDownList([], ['id' => 'comuna-select', 'prompt' => 'Selecione a comuna']) ?>
                <?= $form->field($eventModel, 'local')->textInput(['placeholder' => 'Referência do local, Instituição, Sala etc., ou escreva REMOTO']) ?>
                <?= $form->field($eventModel, 'coordenadas')->textInput(['placeholder' => 'Insere o pin de localização ou link da reunião']) ?>
                <?=
                $form->field($eventModel, 'entidadeOrganizadora')->dropDownList([
                    'Camões, I.P. | ADESPOV/C4' => 'Camões, I.P. | ADESPOV/C4',
                    'Camões, I.P. | ADPP/C1' => 'Camões, I.P. | ADPP/C1',
                    'Camões, I.P. | ADRA/C4' => 'Camões, I.P. | ADRA/C4',
                    'Camões, I.P. | CODESPA/C2' => 'Camões, I.P. | CODESPA/C2',
                    'Camões, I.P. | CODESPA/C4' => 'Camões, I.P. | CODESPA/C4',
                    'Camões, I.P. | COSPE/C1' => 'Camões, I.P. | COSPE/C1',
                    'Camões, I.P. | CUAMM/C2' => 'Camões, I.P. | CUAMM/C2',
                    'Camões, I.P. | CUAMM/C4' => 'Camões, I.P. | CUAMM/C4',
                    'Camões, I.P. | DW/C1' => 'Camões, I.P. | DW/C1',
                    'Camões, I.P. | DW/C4' => 'Camões, I.P. | DW/C4',
                    'Camões, I.P. | FEC/C2' => 'Camões, I.P. | FEC/C2',
                    'Camões, I.P. | FEC/C4' => 'Camões, I.P. | FEC/C4',
                    'Camões, I.P. | NCA/C1' => 'Camões, I.P. | NCA/C1',
                    'Camões, I.P. | NCA/C4' => 'Camões, I.P. | NCA/C4',
                    'Camões, I.P. | PIN/C2' => 'Camões, I.P. | PIN/C2',
                    'Camões, I.P. | PIN/C4' => 'Camões, I.P. | PIN/C4',
                    'Camões, I.P. | TESE/C4' => 'Camões, I.P. | TESE/C4',
                    'Camões, I.P. | UIC' => 'Camões, I.P. | UIC',
                    'Camões, I.P. | WVI/C1' => 'Camões, I.P. | WVI/C1',
                    'Camões, I.P. | WVI/C4' => 'Camões, I.P. | WVI/C4',
                    'FAO' => 'FAO',
                    'Governo' => 'Governo',
                    'PNUD' => 'PNUD',
                    'Vall d´Hebron' => 'Vall d´Hebron',
                    'Outra' => 'Outra'
                        ], ['prompt' => 'Selecione a Entidade'])
                ?>
                <?= $form->field($eventModel, 'convocadoPor')->textInput(['value' => $nomeUsuario, 'readonly' => true]) ?>
                <?=
                $form->field($eventModel, 'participantes')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Contacto::find()->where(['<>', 'estado', 'Inactivo'])->all(), 'email', function ($model) {
                        return $model->nome . ' - ' . $model->instituicao;
                    }),
                    'options' => ['placeholder' => 'Selecione os participantes...', 'multiple' => true, 'id' => 'select-participantes'], 'showToggleAll' => true,
                    'pluginOptions' => [
                         'tags' => true, // Permite adicionar novos valores
                        'allowClear' => true,
                        'tokenSeparators' => [','], // Permite separadores para múltiplos valores
                    ],
                ]);
                ?>
                <!-- Seção de Anexos -->
                <fieldset>
                    <legend>Anexos</legend>

                    <?= $form->field($eventModel, 'agenda', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
                    <?= $form->field($eventModel, 'listaConvidados', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
                    <?= $form->field($eventModel, 'pada', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
                    <?= $form->field($eventModel, 'actaRelatorio', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
                    <?= $form->field($eventModel, 'listaParticipantes', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput() ?>
                    <?= $form->field($eventModel, 'outrosAnexos[]', ['labelOptions' => ['class' => 'file-upload-label']])->fileInput(['multiple' => true]) ?>

                </fieldset>
                <!-- Botão de Adicionar Evento -->
                <div class="form-group">
                    <?= Html::submitButton('Adicionar Evento', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>

                <script>
                    function checkParticipantes() {
                        var participantes = $('#select-participantes').val();
                        if (!participantes || participantes.length === 0) {
                            // Define o valor para "Por confirmar em breve" se estiver vazio
                            $('#select-participantes').append(new Option("A confirmar", "A confirmar", true, true)).trigger('change');
                        }
                        return true;
                    }
                </script>
            </div>
        </div>
    </div>
</div>

<!-- Modal para exibir informações do evento -->
<div class="modal fade" id="eventInfoModal" tabindex="-1" role="dialog" aria-labelledby="eventInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                    
                <!-- As informações do evento serão exibidas aqui -->
                <!--<p><strong>Id:</strong> <span id="modalId"></span></p>-->
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
                <p><strong>Convocado Por:</strong> <span id="modalConvocadoPor"></span></p>
                <p><strong>Convidados:</strong> <span id="modalParticipantes"></span></p>
                <p><strong>Agenda:</strong> <a href="#" id="modalAgenda" target="_blank">A Confirmar</a></p>
                <p><strong>Lista de Convidados:</strong> <a href="#" id="modallistaConvidados" target="_blank">A Confirmar</a></p>
                <p><strong>PADA:</strong> <a href="#" id="modalPADA" target="_blank">A Confirmar</a></p>
                <p><strong>Acta/Relatório:</strong> <a href="#" id="modalactaRelatorio" target="_blank">A Confirmar</a></p>
                <p><strong>Lista de Participantes:</strong> <a href="#" id="modallistaParticipantes" target="_blank">A Confirmar</a></p>
                <p><strong>Outros Anexos:</strong> <span id="modalOutrosAnexos"></span></p>
            </div>
            <div class="modal-footer">          
                <button type="button" class="btn btn-primary" id="editEventButton" data-event-id="">Editar</button>
                <button type="button" class="btn btn-danger" name="deleteEventButton" id="deleteEventButton">Eliminar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showEventDetails(event) {
        const basePath = "uploads/";  // Caminho base onde os arquivos estão armazenados
        $("#eventInfoModal").modal("show");
        $("#modalId").text(event.id);
        $("#modalTitle").text(event.summary);
        $("#modalDescription").text(event.description);
        $("#modalArea").text(event.area);
        $("#modalStart").text(event.start.format("DD/MM/YYYY HH:mm"));
        $("#modalEnd").text(event.end.format("DD/MM/YYYY HH:mm"));
        $("#modalDuracao").text(event.duracao);
        $("#modalProvincia").text(event.provincia);
        $("#modalMunicipio").text(event.municipio);
        $("#modalComuna").text(event.comuna);
        $("#modalLocal").text(event.local);
        $("#modalCoordenadas").text(event.coordenadas);
        $("#modalEntidade").text(event.entidadeOrganizadora);
        $("#modalConvocadoPor").text(event.convocadoPor);
        $("#modalParticipantes").text(event.participantes);

        var participants = event.participantes.split(",");
        var participantsHtml = "";
        for (var i = 0; i < participants.length; i += 2) {
            if (i === participants.length - 1) {
                participantsHtml += participants[i];
            } else {
                participantsHtml += participants[i] + ", " + (participants[i + 1] || "") + "<br>";
            }
        }
        $("#modalParticipantes").html(participantsHtml);

        function setFileLink(elementId, fileName) {
            if (fileName) {
                $(elementId).attr("href", basePath + fileName).text(fileName);
            } else {
                $(elementId).removeAttr("href").text("A Confirmar");
            }
        }

        setFileLink("#modalAgenda", event.agenda);
        setFileLink("#modallistaConvidados", event.listaConvidados);
        setFileLink("#modalPADA", event.pada);
        setFileLink("#modalactaRelatorio", event.actaRelatorio);
        setFileLink("#modallistaParticipantes", event.listaParticipantes);

        if (event.outrosAnexos === "A confirmar") {
            $("#modalOutrosAnexos").text("A Confirmar");
        } else if (event.outrosAnexos) {
            var outrosAnexos = event.outrosAnexos.split(",");
            var anexosHtml = "";
            outrosAnexos.forEach(function (anexo, index) {
                anexosHtml += '<a href="' + basePath + anexo.trim() + '" target="_blank">' + anexo.trim() + '</a><br>';
            });
            $("#modalOutrosAnexos").html(anexosHtml);
        } else {
            $("#modalOutrosAnexos").text("A Confirmar");
        }

        $("#editEventButton").data("eventId", event.id);
        $("#deleteEventButton").data("eventId", event.id);
    }

    function showAddEventModal(date) {
        $("#addEventModal").modal("show");
        $("#eventDate").val(date.format());
    }

    function styleEventElement(event, element) {
        element.css("background-color", "transparent");
        element.css("color", "#000000");
        element.css("border-width", "3px");
        element.find(".fc-content").append("<span class=\"fc-title\">" + event.summary + "</span>");

        if (event.area === "Agricultura e Pecuária") {
            element.css("border-color", "#999900");
        } else if (event.area === "Nutrição") {
            element.css("border-color", "#eae018");
        } else if (event.area === "Água") {
            element.css("border-color", "#00c3ff");
        } else if (event.area === "Coordenação UIC") {
            element.css("border-color", "#71b13c");
        } else if (event.area === "Reforço Institucional") {
            element.css("border-color", "#003399");
        } else if (event.area === "Outra") {
            element.css("border-color", "black");
        } else if (event.area === "Subvenções/M&A") {
            element.css("border-color", "#663399");
        } else if (event.area === "Governo") {
            element.css("border-color", "#BB0E22");
        }

        element.find(".fc-content").append("<br>");
    }

    $(document).on('click', '#editEventButton', function () {
        var eventId = $(this).data('event-id');
        window.location.href = 'update-event?id=' + eventId;
    });
</script>


<?php
$script = <<< JS
$(document).ready(function() {
    // Verifique se existem valores armazenados no armazenamento local e preencha os campos de filtro
    var provinciasSelecionadas = localStorage.getItem('provinciasSelecionadas');
    var entidadesSelecionadas = localStorage.getItem('entidadesSelecionadas');
    var areasSelecionadas = localStorage.getItem('areasSelecionadas');
    if (provinciasSelecionadas !== null) {
        $('#provincias').val(provinciasSelecionadas.split(',')).trigger('change');
    }
    if (entidadesSelecionadas !== null) {
        $('#entidades').val(entidadesSelecionadas.split(',')).trigger('change');
    }
    if (areasSelecionadas !== null) {
        $('#areas').val(areasSelecionadas.split(',')).trigger('change');
    }

    // Ouça o evento de clique no botão "Filtrar"
        
        $('#filter-btn').click(function(e) {
    e.preventDefault(); // Evite o comportamento padrão de enviar o formulário

    // Obtenha os valores selecionados nos filtros
    var entidadesSelecionadas = $('#entidades').val();
    var provinciasSelecionadas = $('#provincias').val();
    var areasSelecionadas = $('#areas').val();
    var municipiosSelecionados = $('#municipios').val(); // Novo campo de municípios

    // Salve os valores dos campos de filtro no armazenamento local antes de enviar o formulário
    localStorage.setItem('provinciasSelecionadas', provinciasSelecionadas);
    localStorage.setItem('entidadesSelecionadas', entidadesSelecionadas);
    localStorage.setItem('areasSelecionadas', areasSelecionadas);
    localStorage.setItem('municipiosSelecionados', municipiosSelecionados); // Novo campo de municípios

    // Faça uma chamada AJAX para a ação 'get-events' com os filtros como parâmetros
    $.ajax({
        url: 'get-events',
        type: 'GET',
        data: { 
            entidades: entidadesSelecionadas, 
            provincias: provinciasSelecionadas, 
            areas: areasSelecionadas,
            municipios: municipiosSelecionados // Novo campo de municípios
        },
        success: function(response) {
            // Remova a fonte de eventos atual antes de adicionar a nova fonte
            $('#meuCalendario').fullCalendar('removeEvents');
            // Adicione a nova fonte de eventos filtrados
            $('#meuCalendario').fullCalendar('addEventSource', response);

            // Limpe os valores armazenados localmente após aplicar os filtros
            localStorage.removeItem('provinciasSelecionadas');
            localStorage.removeItem('entidadesSelecionadas');
            localStorage.removeItem('areasSelecionadas');
            localStorage.removeItem('municipiosSelecionados'); // Novo campo de municípios

            // Limpe os campos de filtro
            $('#provincias').val('').trigger('change');
            $('#entidades').val('').trigger('change');
            $('#areas').val('').trigger('change');
            $('#municipios').val('').trigger('change'); // Novo campo de municípios
        },
        error: function(xhr, status, error) {
            // Lide com erros, se necessário
        }
    });
});

        
        
//    $('#filter-btn').click(function(e) {
//        e.preventDefault(); // Evite o comportamento padrão de enviar o formulário
//        // Obtenha os valores selecionados nos filtros
//        var entidadesSelecionadas = $('#entidades').val();
//        var provinciasSelecionadas = $('#provincias').val();
//        var areasSelecionadas = $('#areas').val();
//
//        // Salve os valores dos campos de filtro no armazenamento local antes de enviar o formulário
//        localStorage.setItem('provinciasSelecionadas', provinciasSelecionadas);
//        localStorage.setItem('entidadesSelecionadas', entidadesSelecionadas);
//        localStorage.setItem('areasSelecionadas', areasSelecionadas);
//
//        // Faça uma chamada AJAX para a ação 'get-events' com os filtros como parâmetros
//        $.ajax({
//            url: 'get-events',
//            type: 'GET',
//            data: { entidades: entidadesSelecionadas, provincias: provinciasSelecionadas, areas: areasSelecionadas },
//            success: function(response) {
//                // Remova a fonte de eventos atual antes de adicionar a nova fonte
//                $('#meuCalendario').fullCalendar('removeEvents');
//                // Adicione a nova fonte de eventos filtrados
//                $('#meuCalendario').fullCalendar('addEventSource', response);
//
//                // Limpe os valores armazenados localmente após aplicar os filtros
//                localStorage.removeItem('provinciasSelecionadas');
//                localStorage.removeItem('entidadesSelecionadas');
//                localStorage.removeItem('areasSelecionadas');
//
//                // Limpe os campos de filtro
//                $('#provincias').val('').trigger('change');
//                $('#entidades').val('').trigger('change');
//                $('#areas').val('').trigger('change');
//            },
//            error: function(xhr, status, error) {
//                // Lide com erros, se necessário
//            }
//        });
//    });

    // Ouça o evento de clique no botão de eliminar evento
    $(document).on('click', '#deleteEventButton', function() {
        var eventId = $(this).data('eventId');
        if (confirm("Tem certeza que deseja deletar este evento?")) {
            window.location.href = 'site/delete-event?id=' + eventId;
        }
    });
        
    // Ouça o evento de clique no botão de editar evento
    $(document).on('click', '#editEventButton', function() {
        var eventId = $(this).data('eventId');
        window.location.href = 'actualizarEvento?Id=' + eventId;
    });
});
JS;

$this->registerJs($script);
?>

<?php
// JavaScript para atualizar os dropdownlists de municípios e comunas com base na província selecionada
$script = <<< JS
$(document).ready(function(){
    $('#provincia-select').change(function(){
        var provinciaID = $(this).val();
        
        if(provinciaID){
            $.ajax({
                type: 'GET',
                url: 'site/get-municipios',
                data: {
                   id: provinciaID
                },
                dataType: 'json', // Especifica o tipo de dados esperado como JSON
                success: function(data){
                    // Limpa a dropdownlist de municípios
                    $('#municipio-select').empty();
                    // Adiciona a opção padrão
                    $('#municipio-select').append($('<option>', {
                        value: '',
                        text: 'Selecione o município'
                    }));
                    // Adiciona cada município retornado pela requisição AJAX à dropdownlist
                    $.each(data, function(index, municipio) {
                        $('#municipio-select').append($('<option>').text(municipio.nome).attr('value', municipio.id));
                    });
                    // Limpa o conteúdo do elemento com id comuna-select
                    $('#comuna-select').html('<option value="">Selecione a comuna</option>');
                },
                error: function() {
                    // Trata erros caso ocorram na requisição AJAX
                    alert('Erro ao obter os municípios.');
                }
            });
        } else {
            // Limpa o conteúdo dos elementos município-select e comuna-select
            $('#municipio-select').html('<option value="">Selecione o município</option>');
            $('#comuna-select').html('<option value="">Selecione a comuna</option>');
        }
    });
        
        $('#municipio-select').change(function(){
    var municipioID = $(this).val();
        
    if(municipioID){
        $.ajax({
            type: 'GET',
            url: 'site/get-comunas',
            data: {
                id: municipioID
            },
             dataType: 'json', // Especifica o tipo de dados esperado como JSON
            success: function(data){            
                // Limpa a dropdownlist de comunas
                $('#comuna-select').empty();
                // Adiciona a opção padrão
                $('#comuna-select').append($('<option>', {
                    value: '',
                    text: 'Selecione a comuna'
                }));
                // Adiciona cada comuna retornada pela requisição AJAX à dropdownlist
                $.each(data, function(index, value) {
                    $('#comuna-select').append($('<option>').text(value.nome).attr('value', value.id));
                    
                });
            },
            error: function() {
                // Trata erros caso ocorram na requisição AJAX
                alert('Erro ao obter as comunas.');
            }
        });
    } else {
        // Limpa o conteúdo do elemento com id comuna-select
        $('#comuna-select').html('<option value="">Selecione a comuna</option>');
    }
});      
});
JS;
$this->registerJs($script);
?>
<?php
$script = <<< JS
$(document).ready(function() {
    // Função para calcular a duração
    function calcularDuracao() {
        var start = $('#event-start').val();
        var end = $('#event-end').val();        
        $.ajax({
            url: 'site/duracao',
            type: 'GET',
            data: {
            start: start,
             end: end
            },
            success: function(response) {
                $('#duracao-evento').val(response + ' hora(s)');
            },
            error: function() {
                alert('Erro ao calcular a duração do evento.');
            }
        });
    }

    // Chamar a função ao alterar a data/hora de início
    $('#event-start').change(function() {
        calcularDuracao();
    });

    // Chamar a função ao alterar a data/hora de término
    $('#event-end').change(function() {
        calcularDuracao();
    });
});       
JS;
$this->registerJs($script);
?>
<?php
$this->registerJs("
    // Função para verificar se a data de término é menor que a data de início
    function checkDateValidity() {
        var startDate = $('#event-start').val();
        var endDate = $('#event-end').val();

        if (startDate && endDate && endDate <= startDate) {
            $('#addEventForm').yiiActiveForm('updateAttribute', 'event-end', ['A data de início deve ser anterior à data de término.']);
        } else {
            $('#addEventForm').yiiActiveForm('updateAttribute', 'event-end', '');
        }
    }

    // Chamar a função de verificação quando os campos de data forem alterados
    $('#event-start, #event-end').change(function() {
        checkDateValidity();
    });

    // Chamar a função de verificação quando o formulário for enviado
    $('#addEventForm').on('beforeSubmit', function() {
        checkDateValidity();
        return true; // Permitir que o formulário seja enviado
    });
");
?>
