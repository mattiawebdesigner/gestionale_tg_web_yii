<?php
    use backend\models\Prenotazioni;
    
    if(
        $n_of_turns == 1 && ($model->posti_disponibili-$posti_occupati) == 0 && $model->posti_disponibili!=null
    ): ?>
        <?= Yii::t('app', '{p} posti liberi', [
            'p' => $model->posti_disponibili-$posti_occupati
        ])?>
<?php elseif(($model->parametri->dates->days[$turn-2]->place - Prenotazioni::find()->where(['attivita_id' => $model->id, 'turno' => $turn])->sum('prenotazioni')) == 0): ?>
        <div class="date">
            <i class="fas fa-chair"></i> 
            <?= Yii::t('app', '{p} posti liberi', [
                'p' => $model->parametri->dates->days[$turn-2]->place - Prenotazioni::find()->where(['attivita_id' => $model->id, 'turno' => $turn])->sum('prenotazioni')
            ])?>
        </div>
<?php endif; ?>