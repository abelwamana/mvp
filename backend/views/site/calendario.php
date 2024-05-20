<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap4\Alert;
use yii\widgets\Breadcrumbs;

$this->title = 'Calendário';
?>
    <!--Breadcrumbs-->
<?php if (isset($this->params['breadcrumbs']) && count($this->params['breadcrumbs']) > 1) : ?>
    <nav aria-label="breadcrumb" class="float-sm-right">
        <ol class="breadcrumb">
            <?php foreach ($this->params['breadcrumbs'] as $breadcrumb) : ?>
                <li class="breadcrumb-item"><?= isset($breadcrumb['/event/index']) ? Html::a($breadcrumb['label'], $breadcrumb['/site/calendario2']) : $breadcrumb['label'] ?></li>
            <?php endforeach; ?>
        </ol>
    </nav> 
<?php endif; ?>

<?= Html::a('Lista de Eventos', ['/event/index'], ['class' => 'btn btn-primary']) ?>
<div>
<?= yii2fullcalendar\yii2fullcalendar::widget([
      'options' => [
        
        //... more options to be defined here!
      ],
    ]);
?>
</div>