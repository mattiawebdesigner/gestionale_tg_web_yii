<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\components\sistema_prenotazione_biglietti\Postazioni;

$this->title = Yii::t('app', 'Nuovo abbonamento');
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="ticket-subscription">
    <div id="theatre-place">
        <?php
        $postazioni->get(false);
        ?>
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
                    <option value="<?= Postazioni::STATO_CREDIT ?>"><?= Yii::t('app', Postazioni::CREDIT_DROPDOWN[Postazioni::STATO_CREDIT]) ?></option>
                    <option value="<?= Postazioni::STATO_CREDIT_THEATRE ?>"><?= Yii::t('app', Postazioni::CREDIT_DROPDOWN[Postazioni::STATO_CREDIT_THEATRE]) ?></option>
                    <option value="<?= Postazioni::STATO_NOT_PAYED ?>" selected="selected"><?= Yii::t('app', Postazioni::CREDIT_DROPDOWN[Postazioni::STATO_NOT_PAYED]) ?></option>
                </select>
            </p>
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