<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Olá <?= Html::encode($user->username) ?>,</p>

    <p>Siga o link abaixo para redefinir sua senha:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
