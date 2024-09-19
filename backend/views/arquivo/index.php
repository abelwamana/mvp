<style>
    /* Estilos existentes */
    .container {
        width: 80%;
    }

    .folder, .subfolder {
        margin-left: 0;
        padding: 5px 0;
        cursor: pointer;
    }

    .folder:hover, .subfolder:hover {
        background-color: #f0f0f0;
    }

    .folder::before {
        content: "📁 ";
        font-size: 36px;
    }

    .subfolder::before {
        content: "📂 ";
        font-size: 28px; /* Tamanho menor para subpastas */
    }

    .hidden {
        display: none;
    }

    /* Estilos para a visualização em ícones */
    .icon-view .folder-item {
        display: inline-block;
        width: 150px;
        text-align: center;
        margin-right: 10px;
        margin-bottom: 10px;
        vertical-align:middle;
    }

    .icon-view .folder::before {
        display: block;
        font-size: 102px;
        margin-bottom: 5px;
    }

    .icon-view .subfolder::before {
        display: block;
        font-size: 102px;
        margin-bottom: 5px;
    }

    .list-view .folder-item {
        display: block;
    }

    .view-toggle {
        margin-bottom: 20px;
        text-align: left;
    }

    /* Estilos para os botões de alternância */
    .view-toggle button {
        padding: 8px 16px;
        margin-right: 5px;
        border: none;
        background-color: #f0f0f0;
        cursor: pointer;
        border-radius: 4px;
    }

    .view-toggle button.active {
        background-color: #d0d0d0;
        font-weight: bold;
    }

    .view-toggle button:hover {
        background-color: #e0e0e0;
    }

    .current-path {
        margin-bottom: 1px;
        font-size: 14px;
    }

    .current-path p {
        margin: 0;
    }

    .file i {
        margin-right: 10px;
        font-size: 36px;
    }

    .file a {
        vertical-align: middle;
        font-size: 16px;
        margin-top: -5px;
    }

    .file-item {
        display: inline-block;
        width: 120px;
        text-align: center;
        margin-right: 10px;
        margin-bottom: 10px;
    }

    .file-item i {
        display: block;
        font-size: 48px;
        margin-bottom: 5px;
    }

    /* Ícones personalizados para diferentes tipos de arquivos */
    .fa {
        display: flex;
        margin-top: 12px;
        justify-content: center; /* Centraliza horizontalmente */
        margin-bottom: 12px;
    }

    /*    .pdf-icon {
            display: flex;
            margin-top: 12px;
            justify-content: center;  Centraliza horizontalmente 
            margin-bottom: 12px; 
        }*/

    .pdf-icon::before {
        content: url('images/icones arquivos/pdf-icone.png'); /* Substitua pela URL do ícone de PDF */
    }


    .doc-icon::before, .docx-icon::before {
        content: url('images/icones arquivos/word-icone.png'); /* Substitua pela URL do ícone de Word */
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .xls-icon::before, .xlsx-icon::before {
        content: url('images/icones arquivos/excel-icone.png'); /* Substitua pela URL do ícone de Excel */
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .ppt-icon::before, .pptx-icon::before {
        content: url('images/icones arquivos/icone-ppt.png'); /* Substitua pela URL do ícone de PowerPoint */
        margin-top: 8px;
        margin-bottom: 8px;
    }

    .mp4-icon::before {
        content: url('images/icones arquivos/video-icone.png'); /* Substitua pela URL do ícone de Vídeo */
    }

    .png-icon::before, .jpg-icon::before, .jpeg-icon::before {
        content: url('images/icones arquivos/icone-imagem.png'); /* Substitua pela URL do ícone de Imagem */
    }
    .png-icon::before,.jpg-icon::before, .jpeg-icon::before {
        content: url('images/icones arquivos/icone-imagem.png'); /* Substitua pela URL do ícone de Imagem */
    }


    /* Ícone padrão para outros tipos de arquivos */
    .file .default-icon::before {
        content: url('images/icones arquivos/file-icone.png'); /* Substitua pela URL do ícone padrão */
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .icon-view .file {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .search-filter-container {
        display: flex;
        align-items: center;
        padding: 5px;
        border-radius: 5px;
        color: #999900;
    }

    .search-section,
    .filter-section {
        flex: 1;
        margin-right: 0.1%;
    }

    .filter-section .form-group {
        margin-right: 10px;
        flex: 1;
    }

    .search-section input {
        width: 99%;
        margin-right: 10px;
        margin-left: -1.4%;
    }

    .filter-section select {
        width: 100%;
        min-width: 180px;
    }
    /*    .form-group {
            margin-bottom: 5px;
            
        }*/
    .btn-block {
        background-color: #919733;
        color: #fff;
        padding: 6px 4px; /* Reduz o padding para diminuir o tamanho do botão */
        font-size: 14px; /* Ajusta o tamanho da fonte, se necessário */
    }

    /* Estilos aprimorados para a barra de navegação */
    .navigation-bar {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navigation-bar .back-btn {
        display: flex;
        align-items: center;
        cursor: pointer;
        font-size: 20px;
        margin-right: 15px;
        background: none;
        border: none;
        padding: 5px;
        color: #333;
        transition: color 0.3s ease;
    }

    .navigation-bar .back-btn:hover {
        color: #0078d4; /* Cor azul ao passar o mouse, semelhante ao Windows */
    }

    .navigation-bar .back-btn i {
        font-size: 22px;
    }

    .navigation-bar .current-path {
        font-size: 18px;
        color: #444;
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .navigation-bar .current-path span {
        margin-right: 5px;
        font-weight: 500;
    }

    .navigation-bar .separator {
        margin: 0 8px;
        color: #888;
    }

</style>

<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $structure array */

$this->title = 'ARQUIVOS';
$this->params['breadcrumbs'][] = $this->title;
//$parentPath='arquivos';
?>

<div class="arquivos-index container">
    <h3 style="text-align: center !important;"><b><?= Html::encode($this->title) ?></b></h3><br>

    <div class="view-toggle">
        <!--        <button id="list-view-btn" class="active">Lista</button>
                <button id="icon-view-btn">Ícones</button>-->
        <div class="navigation-bar">
            <!-- Botão de Voltar -->
            <button id="back-btn" class="back-btn" style="display: none;">
                <i class="fa fa-arrow-left"></i> <!-- Ícone de seta para trás -->
            </button>

            <!-- Caminho de navegação -->
            <div class="current-path">
                <span id="current-path"><?= isset($parentPath) ? Html::encode($parentPath) : 'arquivos' ?></span>
            </div>
        </div>


        <!-- Botão de Adicionar Arquivo -->
        <div class="add-file-btn">
            <?= Html::a('<i class="fas fa-plus"></i> Adicionar Arquivo', '#', ['class' => 'btn btn-primary', 'id' => 'add-file-btn']) ?>
            <br>
            <br>
        </div>
        <div class="search-filter-container">
            <!-- Seção de Pesquisa -->
            <div class="search-section">
                <form action="<?= Url::to(['arquivo/ficheiros']) ?>" method="get">
                    <div class="form-group">
                        <input type="text" name="ArquivoSearch[nome]" class="form-control" placeholder="pesquise aqui...">
                    </div>
                </form>
            </div>

            <!-- Seção de Filtros -->
            <div class="filter-section">
                <form action="<?= Url::to(['arquivo/ficheiros']) ?>" method="get" style="display: flex; align-items: center;">
                    <div class="form-group">
                        <?= Html::dropDownList('ArquivoSearch[tipo]', null, $searchModel->getTipoOptions(), ['class' => 'form-control', 'prompt' => 'Tipo']) ?>
                    </div>
                    <div class="form-group" style=" margin-right: 1.8%;">
                        <?= Html::dropDownList('ArquivoSearch[organizacao]', null, $searchModel->getOrganizacaoOptions(), ['class' => 'form-control', 'prompt' => 'Organização']) ?>
                    </div>
                    <div class="form-group">
                        <?= Html::dropDownList('ArquivoSearch[anoConcluido]', null, $searchModel->getAnoOptions(), ['class' => 'form-control', 'prompt' => 'Ano']) ?>
                    </div>
                    <div class="form-group">
                        <button type="submit" style="background-color: #999900;" class="btn btn-secondary btn-block">
                            Filtrar
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <div class="folder-structure icon-view">
        <?= $this->render('_folders', ['structure' => $structure]) ?>
    </div>
</div>

<script>
// Função para carregar subpastas via AJAX
    $(document).on('click', '.icon-view .folder', function () {
        var fullPath = $(this).closest('.folder-item').data('full-path');
        console.log("Caminho completo da pasta clicada:", fullPath);

        loadSubfolders(fullPath);
    });

    let navigationStack = [];

    function updateBackButton() {
        if (navigationStack.length > 0) {
            $('#back-btn').show();
        } else {
            $('#back-btn').hide();
        }
    }

    $(document).on('click', '.icon-view .folder', function () {
        var parentPath = $('#current-path').text(); // Obtém o caminho atual
        var folderName = $(this).closest('.folder-item').data('path') || $(this).text().trim();
        var fullPath = parentPath ? parentPath + ' > ' + folderName : folderName;

        // Empilha o estado atual da estrutura de pastas para navegação "Voltar"
        navigationStack.push({
            html: $('.folder-structure').html(),
            path: parentPath
        });
        updateBackButton();

        // Atualize o atributo data-full-path com o caminho completo
        $(this).closest('.folder-item').data('full-path', fullPath);

        // Atualize o texto do caminho atual no HTML, mostrando o caminho completo desde a raiz
        $('#current-path').text(fullPath);

        // Atualize globalmente o valor de parentPath
        window.currentParentPath = fullPath;
        // Carrega as subpastas para o caminho completo
        loadSubfolders(fullPath);
    });

    $('#back-btn').click(function () {
        if (navigationStack.length > 0) {
            var lastState = navigationStack.pop();
            $('.folder-structure').html(lastState.html);
            $('#current-path').text(lastState.path);
            updateBackButton();
        }
    });

    function loadSubfolders(folderPath) {
        console.log("Carregando subpasta para o caminho:", folderPath);
        $.ajax({
            url: '<?= \yii\helpers\Url::to(['arquivo/load-subfolder']) ?>',
            type: 'GET',
            data: {folder: folderPath},
            success: function (response) {
                console.log("Resposta AJAX recebida:", response);
                if (response.success) {
                    // Atualiza a estrutura da pasta com o conteúdo retornado
                    $('.folder-structure').html(response.content);
                } else {
                    console.log('Erro na resposta:', response.message);
                }
            },
            error: function () {
                console.log('Erro ao carregar a pasta.');
            }
        });
    }
    $(document).on('click', '#add-file-btn', function () {
        var path = window.currentParentPath;
        window.location.href ='AdicionarArquivo?path=' + path;
    });


</script>
