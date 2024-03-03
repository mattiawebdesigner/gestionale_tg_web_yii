<?php
/**
 * visualizza l'elenco completo dei partner presenti nel sistema
 * 
 * @name $partner Modello contenente tutti i partner
 */
use yii\helpers\Html;

$this->title = Yii::t('app', 'Gestione dei partner');
?>
<div class="sponsor-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Aggiungi partner'), ['add-partner'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if(sizeof($partner) === 0): ?>
    <div class="alert alert-info">
        <?= Yii::t('app', 'Nessun partner inserito') ?>
    </div>
    <?php else: ?>
    <h4><?= Yii::t('app', 'Elenco dei partner nel sistema') ?></h4>
    <div class="flex gap-2">
        <?php foreach($partner as $sp): ?>
        <div class="flex">
            <div class="partner" style="background-image: url(<?= $sp->logo ?>)"></div>
            <div>
                <strong><?= $sp->partner ?></strong>
                <div><?= $sp->tipo_di_sponsorizzazione ?></div>
                <div><a href="<?= $sp->sito_internet ?>" target="_blank"><?= $sp->sito_internet ?></a></div>
                <div><?= $sp->note ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
