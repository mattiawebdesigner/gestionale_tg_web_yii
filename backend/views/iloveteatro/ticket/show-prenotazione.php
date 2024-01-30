<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Gestisci prenotazione: {spettacolo}', [
    'spettacolo' => $spettacolo->spettacolo,
]);
?>
<h1><?= Html::encode( $this->title ) ?></h1>

<div class="spettacolo-show-prenotazione">
    
    <div class="dati_prenotazione">
        <h3><?= $prenotazioni->cognome ?> <?= $prenotazioni->nome ?></h3>
        
        <div class="flex gap-2">
            <div class="phone">
                <i class="fa-solid fa-mobile-screen-button"></i> <a href="tel: <?= $prenotazioni->cellulare ?>"><?= $prenotazioni->cellulare ?></a>
            </div>
            <div class="email">
                <i class="fa-solid fa-envelope"></i> <a href="mailto: <?= $prenotazioni->email ?>"><?= $prenotazioni->email ?></a>
            </div>
        </div>
    </div>
    
    <pre>
        <?php
        //print_r($tutte_le_prenotazioni);
        ?>
    </pre>
    
    <div id="theatre-place">
        <?php
        $postazioni->get();
        ?>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/piantina.css');