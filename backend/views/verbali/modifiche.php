<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Modifiche del verbale {protocollo}', [
    'protocollo' => $numero_protocollo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Convocazioni e verbali'), 'url' => ['manage']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Verbale {protocollo}',
[
    'protocollo' => $numero_protocollo,
]), 'url' => ['view', 'numero_protocollo' => $numero_protocollo]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verbali-modifiche">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <h5><?= Yii::t('app', 'Elenco delle modifiche') ?></h5>
    
    <table class="table">
    <thead>
      <tr>
        <th scope="col"><?= Yii::t('app', 'Protoccollo verbale') ?></th>
        <th scope="col"><?= Yii::t('app', 'Ultima modifica') ?></th>
        <th scope="col"><?= Yii::t('app', 'Utente che ha modificato') ?></th>
      </tr>
    </thead>
    <?php foreach($modifiche as $m) : ?>
    <tbody>
        <tr>
            <td><?= $numero_protocollo ?></td>
            <td><?= date('d/m/Y H:i:s', strtotime($m->versioneVerbale->data_modifica)) ?></td>
            <td><?= Html::a($m->versioneVerbale->utente->nome." ".$m->versioneVerbale->utente->cognome) ?></td>
        </tr>
    </tbody>
    <?php endforeach; ?>
    </table>
</div>