
<h4 style="color: darkblue;"><?= Yii::t('app', 'SOLAMENTE PER I GRUPPI') ?></h4>
<h6>Tabella aggiornata in data <?= date("d-m-Y") ?></h6>

<br /><br /><br />

<table class="table">
    <tr>
        <th>Nome e Cognome</th>
        <th>Data di nascita</th>
        <th>Strumento suonato</th>
    </tr>

    <?php
    for($i = 0; $i<sizeof($componenti); $i ++): ?>
    <tr>
        <td>
            <?= $componenti[$i]->nominativo ?>
        </td>
        <td>
            <?= $componenti[$i]->data_di_nascita ?>
        </td>
        <td>
            <?= $componenti[$i]->strumento ?>
        </td>
    </tr>
    <?php endfor; ?>
    
</table>

<strong>N.B.: </strong>Se nel gruppo ci sono minorenni va allegato al presente modulo di iscrizione anche l’autorizzazione da 
parte del tutore legale.
Vi informiamo che i Vs. dati anagrafici, personali e identificativi saranno utilizzati esclusivamente ai fini inerenti gli scopi
istituzionali. 
I dati dei partecipanti non verranno comunicati o diffusi a terzi.