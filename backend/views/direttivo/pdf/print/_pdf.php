<?php
$i = 0;
?>
<h1 style="text-align: center;"><?= Yii::t('app', 'Elenco dei soci per il consiglio direttivo') ?></h1>

<table style="border: 0px solid;border-collapse: collapse;">
    <tr>
        <td style="width: 35%;font-size: 12pt;"><?= Yii::t('app', 'Protocollo assemblea') ?>:</td>
        <td style="font-size: 12pt;">____________________</td>
    </tr>
    <tr>
        <td style="width: 35%;font-size: 12pt;"><?= Yii::t('app', 'Data assemblea') ?>:</td>
        <td style="font-size: 12pt;">____________________</td>
    </tr>
    <tr>
        <td style="width: 35%;font-size: 12pt;"><?= Yii::t('app', 'Ora di inizio') ?>:</td>
        <td style="font-size: 12pt;">____________________</td>
    </tr>
    <tr>
        <td style="width: 35%;font-size: 12pt;"><?= Yii::t('app', 'Ora di fine') ?>:</td>
        <td style="font-size: 12pt;">____________________</td>
    </tr>
</table>

<table style="border: 1px solid;border-collapse: collapse;">
    <tr>
        <th style="border: 1px solid;width: 35%;width: 35%;font-size: 12pt;"><?= Yii::t('app', 'Nominativo') ?>:</th>
        <th style="border: 1px solid;height: 60px;font-size: 12pt;"><?= Yii::t('app', 'Firma') ?></th>
    </tr>
    <?php foreach($model as $k => $v): ?>
    
    <?php $socio = backend\models\Soci::findOne($v->socio); ?>
    <tr>
        <td style="border: 1px solid;width: 35%;"><?= ++ $i ?>) <?= $socio->cognome ?> <?= $socio->nome ?></td>
        <td style="border: 1px solid;height: 60px;">&nbsp;</td>
    </tr>
    <?php endforeach; ?>
</table>

<table>
    <tr>
        <td style="width: 35%;">
            <?= Yii::t('app', 'Luogo e data') ?> <br /><br />
            _____________________________
        </td>
        
        <td>
            <?= Yii::t('app', 'Firma del presidente dell\'assemblea') ?> <br /><br />
            __________________________________________________ <br /><br />
            <?= Yii::t('app', 'Firma segretario verbalizzante') ?> <br /><br />
            __________________________________________________
        </td>
    </tr>
</table>

<p>
    <?= Yii::t('app', 'N.B.: Nel caso in cui un socio segua online verrà posta la firma dal presidente dell\'assemblea per presa visione') ?>.
</p>