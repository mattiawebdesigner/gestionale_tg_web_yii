<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Gestione sito La Notte di San Lorenzo');
?>
<div id="sanlorenzo-index">
    <h1 class="center"><?= $this->title ?></h1>
    <hr class="hr" />
    
    <h4><i class="far fa-newspaper"></i> <?= Yii::t('app', 'Gestione degli articoli') ?></h4>
    <div class="flex gap-1">
        <div class="item">
            <h5>
                <i class="fas fa-plus-circle"></i>
                <?= Html::a(Yii::t('app', 'Nuovo articolo'), ['sanlorenzo/nuovo-articolo']) ?>
            </h5>
        </div>
        <div class="item">
            <h5>
                <i class="far fa-eye"></i>
                <?= Html::a(Yii::t('app', 'Visualizza gli articoli'), ['sanlorenzo/all-articles']) ?>
            </h5>
        </div>
    </div>
    <br /><br />
    
    <h4><?= Yii::t('app', 'Gestione dell\'evento') ?></h4>
    <div class="flex gap-1">
        <div class="item">
            <h5>
                <i class="fas fa-plus-circle"></i>
                <?= Html::a(Yii::t('app', 'Nuova edizione di San Lorenzo'), ['sanlorenzo/create-events']) ?>
            </h5>
        </div>
        <div class="item">
            <h5>
                <i class="far fa-eye"></i>
                <?= Html::a(Yii::t('app', 'Le edizioni'), ['sanlorenzo/show-events']) ?>
            </h5>
        </div>
    </div>
    <br />
    
    <div class="flex gap-1">
        <div class="item">
            <h5>
                <i class="fas fa-plus-circle"></i>
                <?= Html::a(Yii::t('app', 'Nuovo contest'), ['sanlorenzo/create-contest']) ?>
            </h5>
        </div>
        
        <div class="item">
            <h5>
                <i class="fas fa-eye"></i>
                <?= Html::a(Yii::t('app', 'Il contest'), ['sanlorenzo/view-contest', 'id' => \backend\models\SnlContest::findOne(backend\models\SnlEdizione::findOne(['anno' => date('Y')])->contest)->id]) ?>
            </h5>
        </div>
    </div>
    <br />
    
    <div class="flex gap-1">
        <div class="item">
            <h5>
                <i class="fas fa-eye"></i>
                <?= Html::a(Yii::t('app', 'Gli iscritti'), ['sanlorenzo/subscribers']) ?>
            </h5>
        </div>
    </div>
    <br />
    
    <div class="flex gap-1">
        <div class="item">
            <h5>
                <i class="fas fa-handshake"></i>
                <?= Html::a(Yii::t('app', 'I Partner'), ['sanlorenzo/partner-index']) ?>
            </h5>
        </div>
    </div>
    <br />
    
    <div class="flex gap-1">
        <div class="item">
            <h5>
                <i class="fas fa-gavel"></i>
                <?= Html::a(Yii::t('app', 'I Giudici'), ['sanlorenzo/giudici-index']) ?>
            </h5>
        </div>
    </div>
    <br />
    
    <div class="flex gap-1">
        <div class="item">
            <h5>
                <i class="fas fa-palette"></i>
                <?= Html::a(Yii::t('app', 'Gli Artisti'), ['sanlorenzo/artisti-index']) ?>
            </h5>
        </div>
    </div>
    <br />
    
    <div class="flex gap-1">
        <div class="item">
            <h5>
                <i class="fas fa-burger"></i>
                <?= Html::a(Yii::t('app', 'Gli stand alimentari'), ['sanlorenzo/stand-index']) ?>
            </h5>
        </div>
    </div>
</div>