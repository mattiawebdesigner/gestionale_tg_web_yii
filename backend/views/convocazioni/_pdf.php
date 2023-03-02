<?php
$odg = explode("\n", $model->ordine_del_giorno);
?>
<h3><strong>Prot. <?= $model->numero_protocollo ?></strong></h3>
<p></p><p></p>

<p><strong><?= Yii::t('app', 'Oggetto') ?>: </strong><?= $model->oggetto ?></p>
<p></p><p></p>

<h5><strong><?= Yii::t('app', 'Ordine del giorno') ?></strong></h5>
<ul>
    <?php foreach($odg as $list): ?>
        <li><?= $list ?></li>
    <?php endforeach; ?>
</ul>
<br /><br />

<?= $model->contenuto ?>

<br /><br /><br /><br />
<table>
    <tr>
        <td><strong><?= Yii::t('app', 'Data') ?></strong> <br /><?= $model->data ?></td>
        <td style="text-align: right"><strong><?= Yii::t('app', 'Firma') ?></strong> <br /><?= $model->firma ?></td>
    </tr>
</table>

<pagebreak />
<?php if($model->delega === "yes") : ?>
<h1 style="text-align: center; color: red;"><?= Yii::t('app', 'Modulo di delega') ?></h1>

<p style="line-height: 3.5">
    <?= Yii::t('app', 'Io sottoscritto {underscore}{underscore}{underscore} delego {underscore}{underscore}{underscore} per la riunione che si terrà in data {data}', [
        'underscore' => '________________________',
        'data' => '<strong>'.$model->data.'</strong>'
    ]) ?>
</p>
<table>
    <tr>
        <td><strong><?= Yii::t('app', 'Data') ?></strong></td>
        <td style="text-align: right"><strong><?= Yii::t('app', 'Firma') ?></strong></td>
    </tr>
</table>

<?php endif; ?>