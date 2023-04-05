<?php
use yii\helpers\Html;

$this->title = "test";
?>
<h1><?= Yii::t('app', 'Elenco soci con diritto di voto') ?></h1>
<h2><?= Yii::t('app', 'Elezioni {anno}', [
    'anno' => $soci[0]['anno']
]) ?></h2>
<h6><?= Yii::t('app', 'Scheda generata il: {data}', [
    'data' => date('d/m/Y H:i:s'),
]); ?></h6>
<table class="border">
    <tr>
        <th class="size-1"><?= Yii::t('app', 'Nominativo socio'); ?></th>
        <th class="text-align-left"><?= Yii::t('app', 'Firma'); ?></th>
    </tr>
    
    <?php foreach($soci as $k => $v) : ?>
    <tr>
        <td class="size-1"><?= $v['cognome']." ".$v['nome'] ?></td>
        <td class="">&nbsp;</td>
    </tr>
    <?php endforeach; ?>
</table>