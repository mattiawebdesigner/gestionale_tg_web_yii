<?php
$this->title = "test";
?>
<h1><?= $model->nome ?></h1>

<p><?= Yii::t('app', 'Anno di riferimento') ?>: <strong><?= $model->anno ?></strong></p>

<table style="border: 1px solid #E04926;">
    <tr>
        <th style="border-bottom: 1px solid #E04926;"><?= Yii::t('app', 'Data'); ?></th>
        <th style="border-bottom: 1px solid #E04926;"><?= Yii::t('app', 'Voce'); ?></th>
        <th style="border-bottom: 1px solid #E04926;"><?= Yii::t('app', 'Entrata'); ?></th>
        <th style="border-bottom: 1px solid #E04926;"><?= Yii::t('app', 'Uscita'); ?></th>
    </tr>
    
    <?php foreach($out as $key => $value): ?>
    <tr>
        <td><?= date('d-m-Y', strtotime($value->data_contabile)) ?></td>
        <td><?= $value->voce ?></td>
        <td><?= $value->tipologia==='entrata' ? str_replace(".", ",", $value->prezzo).'&euro;' : '' ?></td>
        <td><?= $value->tipologia==='uscita' ? str_replace(".", ",", $value->prezzo).'&euro;' : '' ?></td>
    </tr>
    <?php endforeach; ?>
    
    <tr>
        <td colspan="2" rowspan="2" style="border-top: 1px solid #E04926;">
            <strong><?= Yii::t('app', 'Totale') ?></strong>
        </td>
        <td style="border-top: 1px solid #E04926;border-left: 1px solid #E04926;">
            <?= str_replace(".", ",", $totIn) ?> &euro;
        </td>
        <td style="border-top: 1px solid #E04926;border-left: 1px solid #E04926;">
            <?= str_replace(".", ",", $totOut) ?> &euro;
        </td>
    </tr>
    
    <tr>
        <td colspan="2" style="border-top: 1px solid #E04926;border-left: 1px solid #E04926;">
            <strong><?= $totIn-$totOut ?> &euro;</strong>
        </td>
    </tr>
</table>