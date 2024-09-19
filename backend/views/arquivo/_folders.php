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
                        <?= $this->render('_folders', [
                            'structure' => $subFolders,
                            'parentPath' => isset($parentPath) ? $parentPath . '/' . $folderName : $folderName
                        ]) ?>
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
                </div>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>