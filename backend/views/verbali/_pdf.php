<?php
$odg = explode("\n", $model->ordine_del_giorno);
?>
<h3><strong>Prot. <?= $model->numero_protocollo ?></strong></h3>
<p></p><p></p>

<p><strong><?= Yii::t('app', 'Oggetto') ?>: </strong><?= $model->oggetto ?></p>
<p></p><p></p>

<p><strong><?= Yii::t('app', 'Ora di inizio') ?>: </strong> <?= $model->ora_inizio ?></p>
<p><strong><?= Yii::t('app', 'Ora di fine') ?>: </strong> <?= $model->ora_fine?></p>
<p></p><p></p>

<h5><strong><?= Yii::t('app', 'Ordine del giorno') ?></strong></h5>
<ul>
    <?php foreach($odg as $list): ?>
        <li><?= $list ?></li>
    <?php endforeach; ?>
</ul>
<br /><br />

<?= $model->contenuto ?>
<table>
    <tr>
        <td style="width: 50%">
            <strong><?= Yii::t('app', 'DATA') ?></strong> <br /><?= date("d/m/Y", strtotime($model->data_inserimento)) ?>
        </td>
        
        <td style="width: 50%;text-align: right;">
            <strong><?= Yii::t('app', 'FIRMA') ?></strong> <br />
            
            <br />
                
            <?php 
            //Visualizza la firma, se presente
            if(is_numeric($model->firma)): ?>
                <img
                     style="width:50mm"
                    src="<?= 
                        Yii::$app->params['site_protocol'].Yii::$app->params['backendWeb'].
                        (backend\models\Firma::findOne(['socio' => $model->firma]))->firma
                    ?>" 
                />
            <?php else : ?>
                <?php
                //Altrimenti visualizza il nome del firmatario
                //usato per i vecchi verbali, prima dell'aggiornamento
                ?>
                <?= $model->firma ?>
            <?php endif; ?>
        </td>
    </tr>
</table>

<?php if($allegati <> null) : ?>
    <?php foreach($allegati as $allegato) : ?>        
        <?php if(end(explode(".", $allegato->allegato) ) <> "pdf") : ?>
            <pagebreak />
            <img src="https://www.teatralmentegioia.it/crm/backend/web/allegati/1642430456-sfondo.png"
                 style="width: 100%;max-height: 100%;" />
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>











