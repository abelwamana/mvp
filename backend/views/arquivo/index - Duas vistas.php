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

    .folder::before, .subfolder::before {
        content: "📁 ";
        font-size: 36px;
    }

    .subfolder::before {
        content: "📂 ";
        font-size: 16px;
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
        vertical-align: top;
    }

    .icon-view .folder::before {
        display: block;
        font-size: 32px;
        margin-bottom: 5px;
    }

    .icon-view .subfolder {
        display: none;
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
</style>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $structure array */

$this->title = 'ARQUIVOS';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="arquivos-index container">
    <h3><b><?= Html::encode($this->title) ?></b></h3><br>

    <div class="view-toggle">
        <button id="list-view-btn" class="active">Lista</button>
        <button id="icon-view-btn">Ícones</button>
         <button id="back-btn" style="display: none;">Voltar</button>
    </div>

    <div class="folder-structure list-view">
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

function loadSubfolders(folderPath) {
    console.log("Carregando subpasta para o caminho:", folderPath);
    $.ajax({
        url: '<?= \yii\helpers\Url::to(['arquivos/load-subfolder']) ?>',
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

// Função para expandir subpastas na vista de lista
$(document).on('click', '.list-view .folder', function () {
    console.log('Caminho completo da pasta clicada:');
    var $subfolders = $(this).next('.subfolders');
    if ($subfolders.length > 0) {
        $subfolders.toggleClass('hidden');
    } else {
        var folderPath = $(this).data('path') || $(this).text().trim();
        console.log("Expandindo pasta na vista de lista:", folderPath);
        loadSubfolders(folderPath);
    }
});

// Alternância entre visualização de lista e ícones
document.getElementById('list-view-btn').addEventListener('click', function () {
    document.querySelector('.folder-structure').classList.remove('icon-view');
    document.querySelector('.folder-structure').classList.add('list-view');
    this.classList.add('active');
    document.getElementById('icon-view-btn').classList.remove('active');
});

document.getElementById('icon-view-btn').addEventListener('click', function () {
    document.querySelector('.folder-structure').classList.remove('list-view');
    document.querySelector('.folder-structure').classList.add('icon-view');
    this.classList.add('active');
    document.getElementById('list-view-btn').classList.remove('active');
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
    var parentPath = $(this).closest('.folder-item').parent().closest('.folder-item').data('full-path') || '';
    var folderName = $(this).data('path') || $(this).text().trim();
    var fullPath = parentPath ? parentPath + '/' + folderName : folderName;

    navigationStack.push($('.folder-structure').html());
    updateBackButton();

    $(this).closest('.folder-item').data('full-path', fullPath);
    loadSubfolders(fullPath);
});

$('#back-btn').click(function () {
    if (navigationStack.length > 0) {
        $('.folder-structure').html(navigationStack.pop());
        updateBackButton();
    }
});

</script>
