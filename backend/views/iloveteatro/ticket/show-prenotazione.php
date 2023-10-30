<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Gestisci prenotazione: {spettacolo}', [
    'spettacolo' => $spettacolo->spettacolo,
]);
?>
<h1><?= Html::encode( $this->title ) ?></h1>


<div id="theatre-place">
    <?php $postazioni->get() ?>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/piantina.css');
