<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Prenotazione: {cognome} {nome}', [
    'cognome' => $prenotazioni->cognome,
    'nome' => $prenotazioni->nome
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spettacoli'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $spettacolo->spettacolo), 'url' => ['view-show', 'id' => $spettacolo->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', "Tutte le prenotazioni"), 'url' => ['prenotazioni', 'spettacolo_id' => $spettacolo->id]];
$this->params['breadcrumbs'][] = $this->title;

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
    
    
    <div id="sistema_prenotazione_biglietti">
        <div  class="btn btn-warning buy-place">
            <span class="mode-in"><i class="fa-solid fa-dollar-sign"></i> <?= Yii::t('app', 'Segna le prenotazioni come pagate') ?></span>
            <span class="mode-out d-none-n-i"><i class="fa-solid fa-dollar-sign"></i> <?= Yii::t('app', 'Esci dalla modalità prenotazioni come pagate') ?></span>
        </div>
        
        <div id="theatre-place" 
             style="background-image: url(<?= $spettacolo->backgroundPiantina; ?>);
                    background-position-x: <?= (json_decode($spettacolo->backgroundPosition))->x; ?>;
                    background-position-y: <?= (json_decode($spettacolo->backgroundPosition))->y; ?>"
        >
            <?php
            $postazioni->get(false);
            ?>
        </div>
        
        <div class="legend">
            <?php
                //\backend\components\sistema_prenotazione_biglietti\Postazioni::legend(false, true);
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
                <input type="submit" value="Prenota" class="btn btn-crm" />
            <?php ActiveForm::end(); ?>

            <table class="table table-striped"></table>
        </div>
        
        <?php // Posti non numerati prenotati ?>
        <div id="theatre-reservations-delete-nn-place" class="flex flex-row gap-1">
            <div><?= Yii::t('app', 'Posti non numerati prenotati: '); ?> </div>
            <div>
                <?php foreach($postazioni->getMyBooked() as $k => $v): ?>
                    <?php if(is_array($v)): ?>
                        <?php foreach($v as $k1 => $v1): ?>
                            <?php if($k1 === "palco"): ?>
                                <?php foreach($v1 as $k2 => $v2): ?>
                                    <?php foreach($v2 as $k3 => $v3): ?>
                                        <?php if($k3 === "non_numerato"): $show_nn_trash = true ?>
                                            <input type="number" name="nn-place" form="reservations-nn-delete-form" value="<?= $v3 ?>" min="0" max="<?= $v3 ?>" />
                                            <input type="hidden" name="prenotazione[<?= $k ?>][nome][]" form="reservations-nn-delete-form" value="<?= $k ?>"  />
                                            <input type="hidden" name="prenotazione[<?= $k ?>][palco][]" form="reservations-nn-delete-form" value="<?= $k2 ?>" />
                                            <input type="hidden" name="prenotazione[<?= $k ?>][fila][]" form="reservations-nn-delete-form" value="non_numerato" />
                                            <input type="hidden" name="prenotazione[<?= $k ?>][posto][]" form="reservations-nn-delete-form" value="non_numerato" />
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
                                            
                <?php if(!($show_nn_trash ?? false)){ echo 0; }?>
            </div>
            <div>
                <?php if($show_nn_trash ?? false) : $form = ActiveForm::begin(['options' => ['id' => 'reservations-nn-delete-form']]); ?>
                    <input type="hidden" name="dati[spettacolo_id]" value="<?= $spettacolo->id ?>" />
                    
                    <button type="submit" class="btn btn-crm remove-reservation fa fa-trash-alt"></button>

                    <input type="hidden" name="reservations-delete" value="true" />
                <?php ActiveForm::end(); endif; ?>
            </div>
        </div>
        
        <?php // Sezione per confermare la cancellazione di una prenotazione ?>
        <div id="theatre-reservations-delete">
            <?php $form = ActiveForm::begin(['options' => ['id' => 'reservations-delete-form']]); ?>
                <input type="hidden" name="dati[spettacolo_id]" value="<?= $spettacolo->id ?>" />
                <input type="submit" value="<?= Yii::t('app', 'Cancella prenotazioni'); ?>" class="btn btn-crm" />

                <input type="hidden" name="reservations-delete" value="true" />
            <?php ActiveForm::end(); ?>

            <table class="table table-striped"></table> 
        </div>
        
        <?php // Sezione per confermare la cancellazione di una prenotazione ?>
        <div id="theatre-reservations-buy">
            <?php $form = ActiveForm::begin(['options' => ['id' => 'reservations-buy-form']]); ?>
                <input type="hidden" name="dati[spettacolo_id]" value="<?= $spettacolo->id ?>" />
                <input type="hidden" name="dati[email]" value="<?= $prenotazioni->email ?>" />
                <input type="submit" value="<?= Yii::t('app', 'Segna come pagate'); ?>" class="btn btn-crm" />

                <input type="hidden" name="reservations-buy" value="true" />
            <?php ActiveForm::end(); ?>

            <table class="table table-striped"></table> 
        </div>
    </div>
    
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/piantina.css');
$this->registerCssFile('//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css');
$this->registerJsFile('https://code.jquery.com/ui/1.13.2/jquery-ui.js', ['depends' => yii\web\JqueryAsset::class]);
$this->registerJsFile('@web/js/iloveteatro/sistema_prenotazione_biglietti.js', ['depends' => yii\web\JqueryAsset::class]);
$this->registerJs("
    jQuery('#sistema_prenotazione_biglietti').sistema_prenotazione_biglietti();
");