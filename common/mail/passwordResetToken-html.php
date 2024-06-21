<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\User $user */

// Gerar a URL base para a ação reset-password sem o token
$resetUrl = Url::to(['user/reset-password'], true);

// Concatenar o token como um parâmetro de consulta
$resetLink = $resetUrl . '?token=' . urlencode($user->password_reset_token);
?>
<div class="password-reset">
    <p>Olá <?= Html::encode($user->username) ?>,</p>

    <p>Siga o link abaixo para redefinir sua palavra-passe:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
