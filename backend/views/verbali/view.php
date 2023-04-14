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
        <?= Html::a('<i class="fas fa-table"></i> ', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-download"></i> ', ['download', 'numero_protocollo' => $model->numero_protocollo], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="fas fa-paper-plane"></i> ', ['send', 'numero_protocollo' => $model->numero_protocollo], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="fas fa-pen"></i> '.Yii::t('app', ''), ['update', 'numero_protocollo' => $model->numero_protocollo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', ''), ['delete', 'numero_protocollo' => $model->numero_protocollo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', '{icon}Modifiche al verbale', [
            'icon' => '<i class="fa-solid fa-clock-rotate-left"></i> ',
        ]), ['modifiche', 'numero_protocollo' => $model->numero_protocollo], ['target' => '_blank', 'class' => 'btn btn-link'])  ?>
    </p>
    
    <h4>Prot: <?= $model->numero_protocollo ?></h4>
    <h5><i class="fas fa-calendar"></i> <?= $model->data ?></h5>
    <h5><i class="fas fa-clock"></i> <?= $model->ora_inizio ?></h5>
    <h5><i class="fas fa-calendar-times"></i> <?= $model->ora_fine ?></h5>
    <h5><i class="fas fa-signature"></i> <?= $model->firma ?></h5>

    <p></p>
    
    <?= $model->contenuto ?>
    
    <h4><?= Yii::t('app', 'Allegati') ?></h4>
    
    <?php if($allegati == null) : ?>
        <div class="alert alert-info"><?= Yii::t('app', 'Non ci sono allegati per questo verbale'); ?></div>
    <?php else : ?>
        <ul>
        <?php foreach($allegati as $key => $value) : ?>
            <li>
                <a href="<?= $value->allegato ?>"> <?= $value->nome_originale    ?></a> <br />
                <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', ''), 
                                [
                                    '/allegati/delete', 
                                    'id' => $value->id,
                                    'id_verbale' => $model->numero_protocollo
                                ], [
                    'class' => '',
                    'data' => [
                        'confirm' => Yii::t('app', 'Sicuro di voler cancellare questo allegato?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
