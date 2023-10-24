<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Direttivo');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Convocazioni e verbali'), 'url' => ['/verbali/manage']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direttivo-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="componenti">
        <?php foreach($model as $componente): ?>
        <div class="componente">
            <h3 class="color-tg-1">
                <?= $componente->ruolo ?>
            </h3>
            <div class="flex gap-1 m-3">
                <div>
                    <?php $socio = backend\models\Soci::findOne($componente->socio); ?>

                    <div class="dati">
                        <div><strong><?= Yii::t('app', 'Nome e Cognome:');?></strong> <?= $socio->nome ?> <?= $socio->cognome ?></div>
                        <div><strong><?= Yii::t('app', 'Email:');?></strong> <?= Html::a($socio->email, "mailto: ".$socio->email)?></div>
                        <div><strong><?= Yii::t('app', 'Data di nascita:');?></strong> <?= date('d/m/Y', strtotime($socio->data_di_nascita)) ?></div>
                        <div><strong><?= Yii::t('app', 'Indirizzo:');?></strong> <?= $socio->indirizzo ?></div>
                    </div>
                </div>
                <div>
                    <div><strong><?= Yii::t('app', 'Verbale di nomina') ?></strong></div> 
                    <?= Html::a(Yii::t('app', 'Prot.:'.' '.$componente->verbale_di_nomina), ['verbali/view', 'numero_protocollo' => $componente->verbale_di_nomina], ['target' => '_blank']); ?>
                </div>
                <div>
                    <div><strong><?= Yii::t('app', 'Data di nomina') ?></strong></div>
                    <?= date('d/m/Y', strtotime($componente->data_di_nomina)) ?>
                </div>
                
                <div>
                    <div><strong><?= Yii::t('app', 'Firma registrata') ?></strong></div>
                    
                    <?php
                    //Recupero la firma del socio, se esiste
                    $firma = backend\models\Firma::findOne(['socio' => $componente->socio]);
                    if($firma): ?>
                        <img style="max-width: 250px" src="<?= Yii::$app->params['site_protocol'].Yii::$app->params['backendWeb'].$firma->firma ?>" />
                    <?php else: ?>
                        <div class="alert alert-info">
                            <?= Yii::t('app', 'Nessuna firma registrata') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    
    <pre>
        <?php
        //print_r($model);
        ?>
    </pre>
</div>