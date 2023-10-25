<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Verbali */

$this->title = $model->oggetto;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Verbali'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="verbali-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('<i class="fas fa-download"></i> ', ['download', 'numero_protocollo' => $model->numero_protocollo], ['class' => 'btn btn-warning']) ?>
    </p>
    
    <h4>Prot: <?= $model->numero_protocollo ?></h4>
    <h5><i class="fas fa-calendar"></i> <?= $model->data ?></h5>
    <h5><i class="fas fa-clock"></i> <?= $model->ora_inizio ?></h5>
    <h5><i class="fas fa-calendar-times"></i> <?= $model->ora_fine ?></h5>
    <h5><i class="fas fa-signature"></i>
        <?php
        if(isset($model->firma['firma_autografa'])): ?>
            <img style="width: 250px;" src="<?= $model->firma['firma_autografa'] ?>" />
        <?php else: ?>
            <?= $model->firma['firma'] ?>
        <?php endif; ?>
    </h5>

    <p></p>
    
    <?= $model->contenuto ?>

    <h4><?= Yii::t('app', 'Allegati') ?></h4>
    
    <?php if($allegati == null) : ?>
        <div class="alert alert-info"><?= Yii::t('app', 'Non ci sono allegati per questo verbale'); ?></div>
    <?php else : ?>
        <ul>
        <?php foreach($allegati as $key => $value) : ?>
            <li><a href="<?= $value->allegato ?>"> <?= $value->nome_originale    ?></a></li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
