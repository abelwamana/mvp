<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\User $user */

// Gerar a URL base para a ação reset-password sem o token
$resetUrl = Url::to(['user/reset-password'], true);

 $signature = "
                                        <div style=\"color: #003399;font-family: Georgia, serif; font-size: 11px;\">
                                        SGI FRESAN/Camões, I.P.
                                        <br>
                                        Email: geral@sgi-fresancamoes.com
                                        <br>
                                        <br>
                                        FRESAN | Fortalecimento da Resiliência e da Segurança Alimentar e Nutricional
                                        <br>
                                        Ação financiada pela União Europeia
                                        <br>
                                        Camões – Instituto da Cooperação e da Língua, I.P.
                                        </div>
                                        <br>
                                        <img src=\"https://sgi-fresancamoes.com/admin/images/rodapeEm.jpg\" alt=\"Imagem Rodapé\" style=\"width: 430px; max-width: 100%;\">
                                         ";

// Concatenar o token como um parâmetro de consulta
$resetLink = $resetUrl . '?token=' . urlencode($user->password_reset_token);
?>
<div class="password-reset">
    <p>Olá <?= Html::encode($user->username) ?>,</p>

    <p>Siga o link abaixo para redefinir sua palavra-passe:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
    <p><?= $signature ?></p>
</div>
