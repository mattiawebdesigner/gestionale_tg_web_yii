<div class="date">
    <i class="fas fa-chair"></i>
    <?= Yii::t('app', '{p} posti liberi', [
        'p' => $model->parametri->dates->days[$turnCorrect]->place - $posti_occupati
    ])?>
</div>