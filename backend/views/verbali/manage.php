<?php
/**
 * Manage "Verbali" or "Convocazioni"
 */
use yii\helpers\Url;


$this->title = Yii::t('app', 'Gestione dei verbali');
?>
<h1><?= $this->title ?></h1>
<hr />

<div class="container verbali-manage">
    <div class="row">
        <div class="col-lg-4">
            <h2><i class="fas fa-paper-plane"></i> <?= Yii::t('app', 'Convocazioni') ?></h2>

            <p><?= Yii::t('app', 'Scrivi le convocazioni da inviare ai soci') ?></p>

            <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/convocazioni/index']) ?>"><?= Yii::t('app', 'Gestisci') ?></a></p>
        </div>
        
        <div class="col-lg-4">
            <h2><i class="fas fa-scroll"></i> <?= Yii::t('app', 'Verbali') ?></h2>

            <p><?= Yii::t('app', 'Scrivi i verbali delle riunioni') ?></p>

            <p><a class="btn btn-outline-secondary" href="<?= Url::to(['/verbali/index']) ?>"><?= Yii::t('app', 'Gestisci') ?></a></p>
        </div>
    </div>
</div>