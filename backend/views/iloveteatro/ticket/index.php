<?php
use yii\helpers\Html;
use app\models\IltPrenotazioni;

$this->title = Yii::t('app', 'Ticket');
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="ticket-index">
    
    <p><?= Html::a('<i class="fa-solid fa-chart-gantt"></i>' . Yii::t('app', 'Grafico delle vendite'),
        ['iloveteatro/chart'],
        ['class' => 'btn btn-warning']) ?></p>
    
    <strong><?= Html::a('Scarica il vademecum per le prenotazioni', 'http://www.teatralmentegioia.it/iloveteatro/frontend/web/images/Vademecum_prenotazioni.pdf', [
        'target' => '_blank',
    ]) ?></strong>
    
    <p><?= Html::a('<i class="fa-solid fa-ticket-simple"></i> ' . Yii::t('app', 'Nuovo abbonamento'),
        ['iloveteatro/subscription'],
        ['class' => 'btn btn-info']) ?></p>
    
    
    <div id="album" class="programmazione-index">
        <div class="container">
            <div class="row">
                <?php foreach($spettacoli as $a): ?>
                    <div class="col col-sm-3 preview" style="background-image: url('<?= $a->locandina ?>');">
                            <div class="n-ticket p-absolute">
                            <?= Yii::t('app', 'Posti occupati: ') ?> <strong><?= (IltPrenotazioni::find()->where(['spettacolo' => $a->id])->count()) ?></strong>
                        </div>
                        <div class="n-ticket-paid p-absolute">
                            <?= Yii::t('app', 'Posti pagati: ') ?> <strong><?= (IltPrenotazioni::find()->where(['spettacolo' => $a->id])->andWhere(['pagato' => IltPrenotazioni::PAGATO])->count()) ?></strong>
                        </div>
                    <?= Html::a(<<<A
                            <div class="title">$a->spettacolo</div>
A, ['prenotazioni', 'spettacolo_id' => $a->id]) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <pre>
        <?php //print_r($spettacoli) ?>
    </pre>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/album.css');
$this->registerCssFile('@web/css/iloveteatro/ticket.css');