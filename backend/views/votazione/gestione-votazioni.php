<?php

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SociSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Gestisci le votazioni');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soci-gestione-votazioni">
    <div class="row">        
        <div class="col-lg-4">
            <h2><i class="fa-solid fa-plus"></i> <?= Yii::t('app', 'Nuova votazione') ?></h2>

            <p><?= Yii::t('app', 'Indici una nuova votazione') ?></p>

            <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/votazione/create']) ?>"><?= Yii::t('app', 'Crea') ?></a></p>
        </div>
        
        <div class="col-lg-4">
            <h2><i class="fa-solid fa-square-poll-vertical"></i> <?= Yii::t('app', 'Tutte le votazioni') ?></h2>

            <p><?= Yii::t('app', 'Visualizza gli esiti delle votazioni passate') ?></p>

            <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/votazione/index']) ?>"><?= Yii::t('app', 'Gestisci') ?></a></p>
        </div>
    </div>
</div>