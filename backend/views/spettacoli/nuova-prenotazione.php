<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\components\sistema_prenotazione_biglietti\Postazioni;

$this->title = Yii::t('app', 'Nuova prenotazione: {spettacolo}', [
    'spettacolo' => $model->spettacolo
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Spettacoli'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $model->spettacolo), 'url' => ['view-show', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="ticket-nuova-prenotazione">
    
    <div id="sistema_prenotazione_biglietti">
        <div id="theatre-place" 
             style="background-image: url(<?= $model->backgroundPiantina; ?>);
                    background-position-x: <?= (json_decode($model->backgroundPosition))->x; ?>;
                    background-position-y: <?= (json_decode($model->backgroundPosition))->y; ?>"
        > 
            <?php $postazioni->get(false) ?>
        </div>

        <?php // Sezione con l'elenco delle prenotazioni ?>
        <div id="theatre-reservations">
            <?php $form = ActiveForm::begin(['options' => ['id' => 'reservations-form']]); ?>
                <p>
                    <input type="text" name="dati[nome]" placeholder="Nome" />
                    <input type="text" name="dati[cognome]" placeholder="Cogome" />
                </p>
                <p>
                    <input type="email" name="dati[email]" placeholder="Email" required />
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
                <input type="submit" value="Prenota" class="btn btn-crm" />
            <?php ActiveForm::end(); ?>

            <table class="table table-striped"></table>
        </div>



        <?php // Sezione per confermare la cancellazione di una prenotazione ?>
        <div id="theatre-reservations-delete">
            <?php $form = ActiveForm::begin(['options' => ['id' => 'reservations-delete-form']]); ?>
                <input type="hidden" name="dati[spettacolo_id]" value="<?= $model->id ?>" />
                <input type="submit" value="<?= Yii::t('app', 'Cancella prenotazioni'); ?>" class="btn btn-crm" />

                <input type="hidden" name="reservations-delete" value="true" />
            <?php ActiveForm::end(); ?>

            <table class="table table-striped"></table> 
        </div>
    </div>
    
    <div class="description">
        <h3><?= Yii::t('app', 'Sinossi') ?></h3>
        
        <div class="flex gap-1">
            <div><i class="fa-solid fa-calendar"></i> <?= date('d-m-Y', strtotime($model->data)) ?></div>
            <div><i class="fa-solid fa-door-open"></i> <?= date("H:s", strtotime($model->ora_porta)) ?></div>
            <div><i class="fa-solid fa-person-booth"></i> <?= date("H:s", strtotime($model->ora_sipario)) ?></div>
        </div>
        
        <p><?= $model->sinossi ?></p>
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