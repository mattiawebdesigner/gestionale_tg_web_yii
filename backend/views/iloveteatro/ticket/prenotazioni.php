<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\IltPosto;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Prenotazioni: {spettacolo}', [
    'spettacolo' => $spettacolo->spettacolo
]);
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="prenotazioni-index">
    <div class="cover b-image-cover b-image-norepeat b-image-center-center" style="background-image: url(<?= $spettacolo->banner ?>)"></div>
    
    <p>&nbsp;</p>
    <div class="info flex gap-1">
        <div><i class="fa-solid fa-door-open"></i> <?= Yii::t('app', 'Apertura porte: ') ?> <?= $spettacolo->ora_porta ?></div>
        <div><i class="fa-solid fa-person-booth"></i> <?= Yii::t('app', 'Inizio spettacolo: ') ?> <?= $spettacolo->ora_sipario ?></div>
        <div><i class="fa-solid fa-calendar"></i> <?= Yii::t('app', 'Data: ') ?> <?= date('d-m-Y', strtotime($spettacolo->data)) ?></div>
    </div>
    
    <p>&nbsp;</p>
    
    <div class="actions">
        <?= Html::a("<i class='fa-solid fa-ticket'></i> Inserisci una prenotazione", 
                Url::toRoute(['iloveteatro/prenotazione-ticket', 'spettacolo_id' => $spettacolo->id]),
                ['class' => 'btn btn-warning']
        ) ?>
    </div>
    
    <div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        
        <?= Html::input('text', 'cerca', $search ?? '', [
            'class' => 'form form-control',
            'placeholder' => Yii::t('app', 'Cerca una prenotazione'),
        ]) ?>
        <span class="f-size-small"><?= Yii::t('app', 'Premere invio per cercare'); ?></span>
        <?php ActiveForm::end(); ?>
    </div>
    
    <p>&nbsp;</p>
    
    <div>
        <strong><?= Yii::t('app', 'Totale prenotazioni: {nOfSeatBooked}', [
            'nOfSeatBooked' => $nOfSeatBooked,
            ]) ?></strong>
    </div>
    
    <p>&nbsp;</p>
    
    <?php if(is_null($prenotazioni) || empty($prenotazioni)): ?>
    <p class="alert alert-info">
        <?= Yii::t('app', 'Non ci sono prenotazioni disponibili') ?>
    </p>
    <?php endif; ?>
    
    <?php if($search <> ""): ?>
    
    <?= Html::a('<i class="fa-solid fa-broom"></i> Pulisci ricerca', ['prenotazioni', 'spettacolo_id' => $spettacolo->id], [
        'class' => 'btn btn-warning'
    ]) ?>
    
    <?php endif; ?>
    
    <p>&nbsp;</p>
    
    
    <div class="prenotazioni flex">
        <?php foreach($prenotazioni as $prenotazione): ?>
            <div class="item">
                
                <div class="eye">
                    <?= Html::a('<i class="fa-solid fa-eye"></i> ', ['show-ticket', 
                                                                    'spettacolo_id' => $spettacolo->id,
                                                                    'email' => $prenotazione->email,
                                                                ], [
                        'class' => 'btn btn-info',
                        'title' => Yii::t('app', 'Segna la prenotazione come pagata'),
                    ]) ?>
                </div>
                
                <div><?= Yii::t('app', 'Cognome e Nome') ?>: <strong><?= $prenotazione->cognome ?> <?= $prenotazione->nome ?></strong></div>
                <div><?= Yii::t('app', 'Email') ?>: <strong><?= $prenotazione->email ?></strong></div>
                <div><?= Yii::t('app', 'Telefono') ?>: <strong><?= $prenotazione->cellulare ?></strong></div>
                
                <?php if(isset($nOfSeatState[$prenotazione->email]['nOfSeatPaid'])): ?>
                <hr />
                <div>
                    <?= Yii::t('app', 'Biglietti pagati') ?>: <strong class="c-darkgreen">
                    <?= $nOfSeatState[$prenotazione->email]['nOfSeatPaid'] ?>
                    </strong>
                </div>
                <div>
                    <?= Yii::t('app', 'Biglietti da pagare') ?>: <strong class="c-iloveteatro">
                    <?= $nOfSeatState[$prenotazione->email]['nOfSeatNotPaid'] ?>
                    </strong>
                </div>
                <div>
                    <?= Yii::t('app', 'Totali biglietti') ?>: <strong>
                    <?= $nOfSeatState[$prenotazione->email]['tot'] ?>
                    </strong>
                </div>
                <?php endif; ?>
                
                <?php if(isset($nOfSeatState[$prenotazione->email]['subcribers'])): ?>
                <hr />
                <div>
                    <?= Yii::t('app', 'Abbonamenti pagati') ?>: <strong class="c-darkgreen">
                    <?= $nOfSeatState[$prenotazione->email]['subcribers']['nOfSeatPaid'] ?>
                    </strong>
                </div>
                <div>
                    <?= Yii::t('app', 'Abbonamenti da pagare') ?>: <strong class="c-iloveteatro">
                    <?= $nOfSeatState[$prenotazione->email]['subcribers']['nOfSeatNotPaid'] ?>
                    </strong>
                </div>
                <div>
                    <?= Yii::t('app', 'Abbonamenti totali') ?>: <strong>
                    <?= $nOfSeatState[$prenotazione->email]['subcribers']['tot'] ?>
                    </strong>
                </div>
                <?php endif; ?>
                
                <?php if(!is_null($prenotazione->data_registrazione)) : ?>
                <div><?= Yii::t('app', 'Data della prenotazione') ?>: <strong><?= date('d-m-Y', strtotime($prenotazione->data_registrazione)) ?></strong></div>
                <?php endif; ?>
            </div>
            
        <?php endforeach; ?>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/prenotazioni.css');