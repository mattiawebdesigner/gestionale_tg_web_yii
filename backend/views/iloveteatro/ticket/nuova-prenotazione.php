<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\IltPosto;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Nuova prenotazione: {spettacolo}', [
    'spettacolo' => $model->spettacolo
]);
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="ticket-nuova-prenotazione">
    
    <div id="theatre-place">
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
            <input type="hidden" name="dati[spettacolo_id]" value="<?= $model->id ?>" />
            <input type="submit" value="Prenota" class="btn btn-iloveteatro" />
        <?php ActiveForm::end(); ?>

        <table class="table table-striped"></table>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/piantina.css');
$this->registerCssFile('//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css');
$this->registerJsFile('https://code.jquery.com/ui/1.13.2/jquery-ui.js', ['depends' => yii\web\JqueryAsset::class]);
$this->registerJsFile('@web/js/iloveteatro/sistema_prenotazione_biglietti.js', ['depends' => yii\web\JqueryAsset::class]);
$this->registerJs('
    //$("#theatre-place").sistema_prenotazione_biglietti();
    //$(".seat").tooltip();
');
?>