<?php
use yii\helpers\Url;
use backend\models\Prenotazioni;

$evento->parametri  = json_decode($evento->parametri);
$n_of_turns         = sizeof((array)$evento->parametri->dates->days)+1;
?>
<div class="turns">                    
    <div><strong><?= $n_of_turns ?> <?= Yii::t('app', 'turni (clicca per prenotare)') ?></strong></div>
    <a class="date" href="<?= Url::to(['attivita/info', 'id'=>$evento->id, 'turn'=>1]) ?>">
        <i class="fas fa-calendar-alt"></i> <strong><?= date("d-m-Y H:i", strtotime($evento->data_attivita)) ?></strong>
        <i class="fas fa-euro-sign"></i> <strong><?= $evento->costo ?></strong>
        <i class="fas fa-chair"></i> 
        <strong><?= $evento->posti_disponibili == null ? Yii::t('app', "Nessuna limitazione di posti") : $evento->posti_disponibili-(Prenotazioni::find()->where(["attivita_id" => $evento->id, 'turno' => 0])->one()->prenotazioni??0) ?></strong>
        <?= Yii::t('app', 'Posti disponibili') ?>
    </a>
    <?php foreach($evento->parametri->dates->days as $k => $turn): ?>
    <a class="date d-block" href="<?= Url::to(['attivita/info', 'id'=>$evento->id, 'turn'=>($k+2)]) ?>">
        <i class="fas fa-calendar-alt"></i> <strong><?= date("d-m-Y H:i", strtotime($turn->date)) ?></strong>
        <i class="fas fa-euro-sign"></i> <strong><?= $turn->price ?></strong>
        <i class="fas fa-chair"></i> 
        <?= !isset($turn->place) ? "<strong>".Yii::t('app', "Nessuna limitazione di posti")."</strong>" : "<strong>".($turn->place-(Prenotazioni::find()->where(["attivita_id" => $evento->id, 'turno' => $k+2])->one()->prenotazioni??0))."</strong>"." ".Yii::t('app', 'Posti disponibili') ?></strong>
    </a>
    <?php endforeach; ?>
</div>