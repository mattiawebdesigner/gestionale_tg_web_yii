<?php
    use backend\models\Prenotazioni;
    
    if(
        $n_of_turns == 1 && ($model->posti_disponibili-$posti_occupati) > 0 && $model->posti_disponibili!=null
    ): ?>
        <div class="date">
            <i class="fas fa-chair"></i> 
            <?= Yii::t('app', '{p} posti liberi', [
                'p' => $model->posti_disponibili-$posti_occupati
            ])?>
        </div>
<?php elseif(($model->parametri->dates->days[$turnCorrect]->place - Prenotazioni::find()->where(['attivita_id' => $model->id, 'turno' => $turn])->sum('prenotazioni')) == 0): ?>
        <div class="date">
            <i class="fas fa-chair"></i>
            <?= Yii::t('app', '{p} posti liberi', [
                'p' => $model->parametri->dates->days[$turnCorrect]->place - Prenotazioni::find()->where(['attivita_id' => $model->id, 'turno' => $turn])->sum('prenotazioni')
            ])?>
        </div>
<?php endif; ?>