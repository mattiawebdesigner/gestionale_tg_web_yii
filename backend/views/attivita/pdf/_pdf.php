<?php
$attivita->parametri = json_decode($attivita->parametri);
?>
<div>
    <?= Yii::t('app', 'Evento') ?>: <strong><?= $attivita->nome ?></strong>
</div>
<div>
    <?= Yii::t('app', 'Giorno') ?>: <strong><?= date("d-m-Y", strtotime($attivita->parametri->dates->days[$turn-1]->date)) ?></strong>
</div>
<div>
    <?= Yii::t('app', 'Orario') ?>: <strong><?= date("H:i", strtotime($attivita->parametri->dates->days[$turn-1]->date)) ?></strong>
</div>
<div>
    <?= Yii::t('app', 'Prezzo') ?>: <strong><?= $attivita->parametri->dates->days[$turn-1]->price ?> &euro;</strong>
</div>
<div>
    <?= Yii::t('app', 'Posti totali') ?>: <strong><?= $attivita->parametri->dates->days[$turn-1]->place ?></strong>
</div>

<table style="border: 0px solid;width: 100%;">
    <thead>
        <tr>
            <th style="text-align: center;" colspan="3">
                <h3><?= Yii::t('app', 'Turno {t}', ['t' => $turn]) ?></h3>
            </th>
        </tr>
    </thead>

    <?php foreach($prenotazioni as $p): ?>
    <tr style="background-color: #f0f0f0;">
        <td>
            <strong><?= $p->cognome ?> <?= $p->nome ?></strong>
        </td>
        <td>
            <?= $p->email ?>
        </td>
        <td>
            <?= Yii::t('app', 'Posti prenotati') ?>: <strong style="color: darkgreen;"><?= $p->prenotazioni ?></strong>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
