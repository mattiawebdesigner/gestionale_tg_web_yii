<?php
use yii\helpers\Url;
use backend\models\Prenotazioni;

$n_of_turns = sizeof((array)$evento->parametri->dates->days);
?>

<div class="turns">                    
    <div><strong><?= $n_of_turns ?> <?= Yii::t('app', 'turni (clicca per prenotare)') ?></strong></div>
    <?php foreach($evento->parametri->dates->days as $k => $turn): ?>
    <a class="date d-block" href="<?= Url::to(['attivita/info', 'id'=>$evento->id, 'turn'=>($k+1)]) ?>">
        <i class="fas fa-calendar-alt"></i> <strong><?= date("d-m-Y H:i", strtotime($turn->date)) ?></strong>
        <i class="fas fa-euro-sign"></i> <strong><?= $turn->price>0?$turn->price:Yii::t('app', 'Ingresso gratuito') ?></strong>
        <i class="fas fa-chair"></i> 
        <?= !isset($turn->place) 
            ? 
            "<strong>".Yii::t('app', "Nessuna limitazione di posti")."</strong>" 
            :
            "<strong>".
                (
                    $turn->place-(Prenotazioni::find()->where(["attivita_id" => $evento->id, 'turno' => $k+1])->sum("prenotazioni"))
                ).
            "</strong>"." ".Yii::t('app', 'Posti disponibili') ?></strong>
    </a>
    <?php endforeach; ?>
</div>