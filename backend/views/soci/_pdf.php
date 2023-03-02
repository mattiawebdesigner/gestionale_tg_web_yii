<?php
$this->title = "test";
?>
<h1><?= Yii::t('app', 'Elenco soci con diritto di voto') ?></h1>
<h6><?= Yii::t('app', 'Elenco generato il: {data}', [
    'data' => date('d/m/Y H:i:s'),
]); ?></h6>
<table class="border">
    <tr>
        <th class="size-1"><?= Yii::t('app', 'Cognome e Nome'); ?></th>
        <th class="size-2"><?= Yii::t('app', 'Firma'); ?></th>
    </tr>
    
    <?php foreach($soci as $k => $v) : ?>
    <tr>
        <td class="size-1"><?= $v->socio0->cognome; ?> <?= $v->socio0->nome; ?></td>
        <td class="size-2">&nbsp;</td>
    </tr>
    <?php endforeach; ?>
</table>