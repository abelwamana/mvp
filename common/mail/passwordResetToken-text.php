<?php

/** @var yii\web\View $this */
/** @var common\models\User $user */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/reset-password', 'token' => $user->password_reset_token]);

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
?>
Olá <?= $user->username ?>,

Siga o link abaixo para redefinir sua palavra-passe:

<?= $resetLink ?>
 <p><?= $signature ?></p>