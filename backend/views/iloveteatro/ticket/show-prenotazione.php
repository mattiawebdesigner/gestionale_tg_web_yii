<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$totNOfSeat         = $nOfSeatState[$prenotazioni->email]['tot']??0;
$totNOfSeatPaid     = $nOfSeatState[$prenotazioni->email]['nOfSeatPaid']??0;
$totNOfSeatNotPaid  = $nOfSeatState[$prenotazioni->email]['nOfSeatNotPaid']??0;
if(isset($nOfSeatState[$prenotazioni->email]['subcribers'])){
    $totNOfSeat         += $nOfSeatState[$prenotazioni->email]['subcribers']['tot'];
    $totNOfSeatPaid     += $nOfSeatState[$prenotazioni->email]['subcribers']['nOfSeatPaid'];
    $totNOfSeatNotPaid  += $nOfSeatState[$prenotazioni->email]['subcribers']['nOfSeatNotPaid'];
}

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
    
    <div class="informazione-posti">
        <div><?= Yii::t('app', 'Posti Totali: {tot}', ['tot' => "<strong>".$totNOfSeat."</strong>"]) ?></div>
        <div><?= Yii::t('app', 'Posti pagati: {tot}', ['tot' => "<strong>".$totNOfSeatPaid."</strong>"]) ?></div>
        <div><?= Yii::t('app', 'Posti da pagare: {tot}', ['tot' => "<strong>".$totNOfSeatNotPaid."</strong>"]) ?></div>
        <p></p>
        <div><?= Yii::t('app', 'Riservati per la stampa: {tot}', ['tot' => "<strong>".($nOfSeatState[$prenotazioni->email]['nOfSeatPress']??0)."</strong>"]) ?></div>
    </div>
    
    
    <div id="">
        <div  class="btn btn-warning">
            <i class="fa-solid fa-dollar-sign"></i> <?= Yii::t('app', 'Segna le prenotazioni come pagate') ?>
        </div>
        
        <div id="theatre-place">
            <?php
            $postazioni->get(false);
            ?>
        </div>
    </div>
    
    <div class="legend">
        <?php
            \backend\components\sistema_prenotazione_biglietti\Postazioni::legend(false, true);
        ?>
    </div>
    
    <?php // Sezione con l'elenco delle prenotazioni ?>
    <div id="theatre-reservations">
        <?php $form = ActiveForm::begin(['options' => ['id' => 'reservations-form']]); ?>
            <p>
                <input type="text" name="dati[nome]" placeholder="Nome" value="<?= $prenotazioni->nome ?>" readonly="readonly" />
                <input type="text" name="dati[cognome]" placeholder="Cogome" value="<?= $prenotazioni->cognome ?>" readonly="readonly" />
            </p>
            <p>
                <input type="email" name="dati[email]" placeholder="Email" value="<?= $prenotazioni->email ?>" readonly="readonly" />
                <input type="text" name="dati[cellulare]" placeholder="Cellulare" value="<?= $prenotazioni->cellulare ?>" />
            </p>
            <input type="hidden" name="dati[spettacolo_id]" value="<?= $spettacolo->id ?>" />
            <input type="submit" value="Prenota" class="btn btn-iloveteatro" />
        <?php ActiveForm::end(); ?>

        <table class="table table-striped"></table>
    </div>
    
    
    
    <?php // Sezione per confermare la cancellazione di una prenotazione ?>
    <div id="theatre-reservations-delete">
        <?php $form = ActiveForm::begin(['options' => ['id' => 'reservations-delete-form']]); ?>
            <input type="hidden" name="dati[spettacolo_id]" value="<?= $spettacolo->id ?>" />
            <input type="submit" value="<?= Yii::t('app', 'Cancella prenotazioni'); ?>" class="btn btn-iloveteatro" />
            
            <input type="hidden" name="reservations-delete" value="true" />
        <?php ActiveForm::end(); ?>

        <table class="table table-striped"></table> 
    </div>

</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/piantina.css');
$this->registerCssFile('//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css');
$this->registerJsFile('https://code.jquery.com/ui/1.13.2/jquery-ui.js', ['depends' => yii\web\JqueryAsset::class]);
$this->registerJsFile('@web/js/iloveteatro/sistema_prenotazione_biglietti.js', ['depends' => yii\web\JqueryAsset::class]);