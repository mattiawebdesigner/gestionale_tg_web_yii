<?php
use backend\models\IltIscrizioni;
use yii\helpers\Html;

$this->title = $model->compagnia;
?>
<div class="iloveteatro-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <h5><i class="fas fa-pencil-eye"></i> <?= Yii::t('app', 'Modifica della scheda della compagnia') ?></h5>
    
    <div class="action-bar">      
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
    
    <?= $this->render('_form', [
        'model'     => $model,
        'pdf'       => $pdf,
        'festival'  => $festival,
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