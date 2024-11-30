<?php
/**
 * Gestione degli spettacoli teatrali
 */
use yii\helpers\Url;
?>
<div class="col-lg-4">
    <h2><i class="fa-solid fa-masks-theater"></i> <?= Yii::t('app', 'Gestione spettacoli') ?> <small class="c-red"><?= Yii::t('app', 'beta') ?></small></h2>

    <p><?= Yii::t('app', <<<DOC
            Gestione degli spettacoli teatrali con possibilità di 
            prenotare i biglietti (senza modalità di pagamento)
            attraverso una comoda piantina del teatro
DOC) ?></p>

    <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/spettacoli']) ?>"><?= Yii::t('app', 'Gestisci') ?></a></p>
</div>