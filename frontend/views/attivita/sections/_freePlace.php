<?php
    use backend\models\Prenotazioni;
    
    //Corregge il valore del turno per il suo corretto utilizzo
    //Se si tratta del primo turno la differenza $turn-2 darebbe -1 e non è valido,
    //quindi correggo riportando il suo valore a 1.
    //Se si tratta dei turni dal 2 in poi (registrati nel campo JSON parametri
    //sul database) allora effettuo il calcolo della diferrenza $turn-2
    $turnCorrect = (($turn-2)===-1)?1:$turn-2;
    
    if(
        $n_of_turns == 1 && ($model->posti_disponibili-$posti_occupati) == 0 && $model->posti_disponibili!=null
    ): ?>
        <?= Yii::t('app', '{p} posti liberi', [
            'p' => $model->posti_disponibili-$posti_occupati
        ])?>
<?php elseif(($model->parametri->dates->days[$turnCorrect]->place - Prenotazioni::find()->where(['attivita_id' => $model->id, 'turno' => $turn])->sum('prenotazioni')) == 0): ?>
        <div class="date">
            <i class="fas fa-chair"></i> 
            <?= Yii::t('app', '{p} posti liberi', [
                'p' => $model->parametri->dates->days[$turnCorrect]->place - Prenotazioni::find()->where(['attivita_id' => $model->id, 'turno' => $turn])->sum('prenotazioni')
            ])?>
        </div>
<?php endif; ?>