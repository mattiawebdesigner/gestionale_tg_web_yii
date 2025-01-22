<?php
use backend\models\IltIscrizioni;
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->compagnia;
?>
<div class="iloveteatro-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <h5><i class="fas fa-pencil-eye"></i> <?= Yii::t('app', 'Scheda della compagnia') ?></h5>
    
    <div class="action-bar">
        <?= Html::a('<i class="fas fa-table"></i> ', ['iscritti'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="fas fa-pencil"></i> '.Yii::t('app', 'Effettua una modifica'), ['update-troupe', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Iscrivi una compagnia'), ['add-troupe'], ['class' => 'btn btn-success']) ?>
        
        <p></p>
        
        <div>
            <?= $this->render('_statusBtn', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
    
    <p></p>
    
    <?php if($model->attivo === IltIscrizioni::DELETED) : ?>
    <p class="alert alert-danger">
        <?= Yii::t('app', 'E\' già stata rifiutata l\'iscrizione per questa compagnia'); ?>
    </p>
    <?php elseif($model->attivo === IltIscrizioni::SUBSCRIBED) : ?>
    <p class="alert alert-success">
        <?= Yii::t('app', 'E\' già stata approvata l\'iscrizione per questa compagnia'); ?>
    </p>
    <?php endif; ?>
    
    <p></p>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'compagnia',
            'codice_fiscale_compagnia',
            'partita_iva',
            'nome_referente',
            'cognome_referente',
            'attivo' =>[
                'attribute' => 'attivo',
                'value' => function($m){
                    if($m->attivo === IltIscrizioni::SUBSCRIBED){
                        return Yii::t('app', 'Iscrizione approvata');
                    }else if($m->attivo === IltIscrizioni::DELETED){
                        return Yii::t('app', 'Cancellato');
                    }else if($m->attivo === IltIscrizioni::TO_BE_APPROVED){
                        return Yii::t('app', 'Iscrizione da approvare');
                    }
                },
            ]
        ],
    ]) ?>
    
    <h5><?= Yii::t('app', 'Allegati') ?></h5>
    <div class="flex gap-1 flex-wrap-wrap">
        <?php foreach($allegati as $allegato) : ?>
        <div>
            <?= Html::a(Yii::t('app', $allegato->nome), 
                        $allegato->allegato, 
                    ['target' => '_blank']) ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>