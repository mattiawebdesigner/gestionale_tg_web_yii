<?php
use yii\helpers\Html;

$this->title = "test";
?>
<h1><?= Yii::t('app', 'Scheda elettorale elezioni {anno}', [
    'anno' => $soci[0]['anno']
]) ?></h1>
<h6><?= Yii::t('app', 'Scheda generata il: {data}', [
    'data' => date('d/m/Y H:i:s'),
]); ?></h6>
<!--<table>
    <tr>
        <th class="size-2"></th>
        <th class="text-align-left"><?= Yii::t('app', 'Nominativo socio'); ?></th>
    </tr>
    
    <?php foreach($soci as $k => $v) : ?>
    <tr>
        <td class="size-2"><?= Html::checkbox('') ?></td>
        <td style="font-size: 20px;margin: 0;"><?= $v['cognome']." ".$v['nome'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>-->

<div style="display: flex;">
    <?php foreach($soci as $k => $v) : ?>
    <div>
        <table style="margin-bottom: 10px;">
            <tr>
                <td style="width: 25px;border: 1px solid;margin-right: 10px;">
                    <div style="height: 100%;width: 100%;border: 1px solid;"></div>
                </td>
                <td style="text-align: left;padding: 0;margin: 0;padding-left: 10px;">
                    <span style="font-size: 25px;"><?= $v['cognome']." ".$v['nome'] ?></span>
                </td>
            </tr>
        </table>
    </div>
    <?php endforeach; ?>
</div>