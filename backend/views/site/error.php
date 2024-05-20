<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception*/

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

   

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        O erro acima occorreu enquanto o servidor tentava processar a sua requisição
    </p>
    <p>
        Por favor entre em contacto com o Administrador.
    </p>

</div>
