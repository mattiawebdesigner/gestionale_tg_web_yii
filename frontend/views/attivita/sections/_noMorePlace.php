<?php if(($model->parametri->dates->days[$turnCorrect<0?0:$turnCorrect]->place - $posti_occupati) == 0):?>
    <div class="alert alert-warning">
        <?= Yii::t('app', 'Non ci sono posti disponibili')?>
    </div>
<?php endif; ?>