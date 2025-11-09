<div class="date">
    <i class="fas fa-chair"></i>
    <?= Yii::t('app', '{p} posti liberi', [
        'p' => $model->parametri->dates->days[$turnCorrect<0?0:$turnCorrect]->place - $posti_occupati
    ])?>
</div>