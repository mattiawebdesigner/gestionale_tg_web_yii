<?php
    use backend\models\Prenotazioni;
    if(
        $n_of_turns == 1 && ($model->posti_disponibili-$posti_occupati) == 0 && $model->posti_disponibili!=null
    ): ?>
    <div class="alert alert-warning">
        <?= Yii::t('app', 'Non ci sono posti disponibili')?>
    </div>
<?php elseif(($model->parametri->dates->days[$turnCorrect]->place - Prenotazioni::find()->where(['attivita_id' => $model->id, 'turno' => $turn])->sum('prenotazioni')) == 0): ?>
    <div class="alert alert-warning">
        <?= Yii::t('app', 'Non ci sono posti disponibili')?>
    </div>
<?php endif; ?>