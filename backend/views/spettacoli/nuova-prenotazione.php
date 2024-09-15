<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\components\sistema_prenotazione_biglietti\Postazioni;

$this->title = Yii::t('app', 'Nuova prenotazione: {spettacolo}', [
    'spettacolo' => $model->spettacolo
]);
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="ticket-nuova-prenotazione">
    
    <div id="sistema_prenotazione_biglietti">
        <div id="theatre-place" style="background-image: url(<?= $model->backgroundPiantina; ?>);"> 
            <?php $postazioni->get() ?>
        </div>

        <?php // Sezione con l'elenco delle prenotazioni ?>
        <div id="theatre-reservations">
            <?php $form = ActiveForm::begin(['options' => ['id' => 'reservations-form']]); ?>
                <p>
                    <input type="text" name="dati[nome]" placeholder="Nome" />
                    <input type="text" name="dati[cognome]" placeholder="Cogome" />
                </p>
                <p>
                    <input type="email" name="dati[email]" placeholder="Email" />
                    <input type="text" name="dati[cellulare]" placeholder="Cellulare" />
                </p>
                <p>
                    <label for="tipo-prenotazione"><?= Yii::t('app', 'Tipologia di posto') ?></label>
                    <select name="tipo-prenotazione">
                        <?php foreach(Postazioni::CREDIT_DROPDOWN as $k => $v): ?>
                        <option value="<?= $k ?>" <?= Postazioni::STATO_NOT_PAYED ? 'selected="selected"' : ''  ?>><?= Yii::t('app', $v) ?></option>
                        <?php endforeach; ?>
                    </select>
                </p>
                <input type="hidden" name="dati[spettacolo_id]" value="<?= $model->id ?>" />
                <input type="submit" value="Prenota" class="btn btn-iloveteatro" />
            <?php ActiveForm::end(); ?>

            <table class="table table-striped"></table>
        </div>



        <?php // Sezione per confermare la cancellazione di una prenotazione ?>
        <div id="theatre-reservations-delete">
            <?php $form = ActiveForm::begin(['options' => ['id' => 'reservations-delete-form']]); ?>
                <input type="hidden" name="dati[spettacolo_id]" value="<?= $model->id ?>" />
                <input type="submit" value="<?= Yii::t('app', 'Cancella prenotazioni'); ?>" class="btn btn-iloveteatro" />

                <input type="hidden" name="reservations-delete" value="true" />
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