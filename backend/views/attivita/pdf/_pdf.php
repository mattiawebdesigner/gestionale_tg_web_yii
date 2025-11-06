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

<table style="border: 0px solid;">
    <thead>
        <tr>
            <th style="text-align: center;">
                <h3><?= Yii::t('app', 'Turno {t}', ['t' => $turn]) ?></h3>
            </th>
        </tr>
    </thead>

    <?php foreach($prenotazioni as $p): ?>
    <tr>
        <td style="background-color: #f0f0f0;">
            <table>
                <tr>
                    <td style="text-align: left;"><strong><?= $p->cognome ?> <?= $p->nome ?></strong></td>
                    <td style="text-align: left;"><?= $p->email ?></strong></td>
                    <td style="text-align: left;"><?= $p->nome ?></strong></td>
                </tr>
            </table>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
