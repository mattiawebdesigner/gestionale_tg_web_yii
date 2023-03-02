<h4><?= Yii::t('app', 'Uscite') ?></h4>

<span class="btn btn-info" data-btn-copy data-type="uscita"><i class="fas fa-plus"></i> <?= Yii::t('app', 'Aggiungi') ?></span>


<div data-paste="true"></div>

<h5><?= Yii::t('app', 'Dati già salvati') ?></h5>
<h6><small>Doppio click per modificare</small></h6>


<table data-upload class="table">
    <?php if(sizeof($out) == 0): ?>
    <p class="alert alert-info"><?= Yii::t('app', 'Nessuna voce') ?></p>
    <?php endif; ?>

    <?php foreach($out as $key => $value) : ?>
        <tr data-action-panel class="action-panel">
            <td><span data-type="uscita" data-id="<?= $value->id ?>" data-save><?= Yii::t('app', 'Salva') ?></span></td>
            <td><span data-type="uscita" data-id="<?= $value->id ?>" data-delete><?= Yii::t('app', 'Cancella') ?></span></td>
            <td><span data-cancel><?= Yii::t('app', 'Annulla') ?></span></td>
        </tr>
        <tr>
            <td data-input-type="date" data-id="<?= $value->id ?>" data-field="data_contabile">
                <span><?= $value->data_contabile ?></span></td>
            <td data-input-type="text" data-id="<?= $value->id ?>" data-field="voce"><span><?= $value->voce ?></span></td>
            <td data-input-type="text" data-id="<?= $value->id ?>" data-field="prezzo"><span><?= $value->prezzo ?></span> &euro;</td>
        </tr>
    <?php endforeach; ?>

</table>