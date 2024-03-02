<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Gestione sponsor');
?>
<div class="sponsor-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Aggiungi sponsor'), ['add-sponsor'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Aggiungi sponsor al festival'), ['add-sponsor-festival'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if(sizeof($sponsor) === 0): ?>
    <div class="alert alert-info">
        <?= Yii::t('app', 'Nessuno sponsor inserito') ?>
    </div>
    <?php else: ?>
    <h4><?= Yii::t('app', 'Elenco degli sponsor nel sistema') ?></h4>
    <div class="flex gap-2">
        <?php foreach($sponsor as $sp): ?>
        <div class="sponsor" style="background-image: url(<?= $sp->immagine ?>)"></div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
