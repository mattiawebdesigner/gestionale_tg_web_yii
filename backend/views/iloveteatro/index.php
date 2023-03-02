<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Gestionale {festival}', [
    'festival' => 'I Love Teatro',
]);
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="home-index">
    <div id="sections" class="flex flex-flow-wrap gap-1">
        
        <div class="section">
            <h4><i class="fas fa-photo-video"></i> <?= Yii::t('app', 'Slideshow') ?></h4>
            <p><?= Yii::t('app', 'Gestisci gli slideshow, sia della homepage che della sezione gallery') ?></p>
            <?= Html::a(Yii::t('app', 'Vai'), ['slideshow']) ?>
        </div>
        
        <div class="section">
            <h4><i class="fa-solid fa-masks-theater"></i> <?= Yii::t('app', 'Programmazione spettacoli') ?></h4>
            <p><?= Yii::t('app', 'Aggiungi gli spettacoli nella programmazione del festival') ?></p>
            <?= Html::a(Yii::t('app', 'Vai'), ['programming']) ?>
        </div>
        
        <div class="section">
            <h4><i class="fa-solid fa-ticket"></i> <?= Yii::t('app', 'Ticket') ?></h4>
            <p><?= Yii::t('app', 'Gestisci le prenotazioni') ?></p>
            <?= Html::a(Yii::t('app', 'Vai'), ['ticket']) ?>
        </div>
        
        <div class="section">
            <h4><i class="far fa-newspaper"></i> <?= Yii::t('app', 'Articoli') ?></h4>
            <p><?= Yii::t('app', 'Gestisci gli articoli') ?></p>
            <?= Html::a(Yii::t('app', 'Vai'), ['tutti-articoli']) ?>
        </div>
        
        <div class="section">
            <h4><i class="fas fa-heartbeat"></i> <?= Yii::t('app', 'I festival') ?></h4>
            <p><?= Yii::t('app', 'Gestisci i festival') ?></p>
            <?= Html::a(Yii::t('app', 'Vai'), ['festival-table']) ?>
        </div>
        
        <div class="section">
            <h4><i class="fas fa-comments"></i> <?= Yii::t('app', 'I commenti') ?></h4>
            <p><?= Yii::t('app', 'Gestisci i commenti') ?></p>
            <?= Html::a(Yii::t('app', 'Vai'), ['commenti']) ?>
        </div>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/home.css');