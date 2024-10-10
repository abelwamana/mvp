<style>
    /* Ajuste no ícone dos arquivos */
    .file i {
        font-size: 16px; /* Reduz o tamanho do ícone para 32px */
        margin-bottom: 2px; /* Margem entre o ícone e o texto */
        display: inline-block;
        overflow: visible;
        border-radius: 0;
    }

    /* Ajuste no contêiner do ícone */
    .file {
        width: 100%;
        text-align: center;
        overflow: visible;
    }

    /* Ajuste no tamanho dos botões */
    .btn.a {
        padding: 2px 3px; /* Reduz o padding para ocupar menos espaço */
        font-size: 10px; /* Reduz o tamanho da fonte nos ícones dos botões */
        width: 25px;
        height: auto;
        display: inline-block;
        margin: 0 0px;
        vertical-align: middle;
    }

    /* Ajuste para garantir alinhamento entre ícone e botões */
    .file i, .btn.a {
        vertical-align: middle; /* Centraliza verticalmente os elementos */
    }


</style>

<?php

use yii\helpers\Html;

/* @var $structure array */
/* @var $parentPath string */

if (!function_exists('getFileIcon')) {

    function getFileIcon($filename) {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        switch ($ext) {
            case 'pdf':
                return 'pdf-icon';
            case 'doc':
            case 'docx':
                return 'doc-icon';
            case 'xls':
            case 'xlsx':
                return 'xls-icon';
            case 'ppt':
            case 'pptx':
                return 'ppt-icon';
            case 'mp4':
            case 'avi':
                return 'mp4-icon';
            case 'jpg':
            case 'jpeg':
            case 'png':
            case 'gif':
                return 'png-icon';
            default:
                return 'default-icon';
        }
    }

}
?>

<ul>
    <?php foreach ($structure as $folderName => $subFolders): ?>
        <?php if ($folderName !== 'files'): ?>
            <li class="folder-item" data-full-path="<?= isset($parentPath) ? $parentPath . '/' . $folderName : $folderName ?>">
                <div class="folder" data-path="<?= $folderName ?>">
                    <?= Html::encode($folderName) ?>
                </div>
                <?php if (!empty($subFolders)): ?>
                    <div class="subfolders hidden">
                        <?=
                        $this->render('_folders', [
                            'structure' => $subFolders,
                            'parentPath' => isset($parentPath) ? $parentPath . '/' . $folderName : $folderName
                        ])
                        ?>
                    </div>
                <?php endif; ?>
            </li>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if (isset($structure['files']) && !empty($structure['files'])): ?>
        <?php foreach ($structure['files'] as $file): ?>
            <li class="folder-item">
                <div class="file">
                    <i class="fa <?= getFileIcon($file) ?>" aria-hidden="true"></i>
                    <?= Html::a(Html::encode($file), ['arquivo/download', 'file' => str_replace('/', '%2F', (isset($parentPath) ? $parentPath . '/' . $file : $file))]) ?>

                    <!-- Botões de Editar e Eliminar reduzidos e alinhados -->
                    <div style="display: inline-block; text-align: center;">
                        <?= Html::a('<i class="fas fa-edit"></i>', ['arquivo/update', 'fileName' => $file], ['class' => 'btn btn-primary a']) ?>
                        <?=
                        Html::a('<i class="fas fa-trash"></i>', ['arquivo/delete', 'fileName' => $file], ['class' => 'btn btn-danger a',
                            'data' => [
                                'confirm' => 'Tem certeza de que deseja eliminar este arquivo?',
                                'method' => 'post',
                            ],
                        ])
                        ?>
                         <?= Html::a('<i class="fas fa-info-circle"></i>', ['arquivo/viewpage', 'file' => $file], ['class' => 'btn btn-info a']) ?>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
