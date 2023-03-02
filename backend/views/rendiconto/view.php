<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Rendiconto */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rendiconti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div id="rendiconto" class="rendiconto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-table"></i> ', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-file-invoice-dollar"></i> '.Yii::t('app', 'Gestisci voci'), 
                ['/voci/create', 'id' => $model->id], 
                ['class' => 'btn btn-success']
        ) ?>
        <?= Html::a('<i class="fas fa-download"></i> ', ['download', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('<i class="fas fa-pen"></i> '.Yii::t('app', 'Aggiorna informazioni rendiconto'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', 'Cancella rendiconto'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <div class="info">
        <div title="Data di inserimento"><i class="far fa-calendar-check"></i> <?= $model->data_inserimento ?></div>
        <div title="Data ultima modifica"><i class="far fa-calendar-alt"></i> <?= $model->ultima_modifica ?></div>
        <div title="Anno di riferimento del rendiconto"><i class="fas fa-globe-europe"></i> <?= $model->anno ?></div>
    </div>
    
    <div class="clearfix"></div>
    <p></p>
    
    <div class="total">        
        <table class="table">
            <tr>
                <th><?= Yii::t('app', 'Totale entrate')?></th>
                <td><?= $totIn ?> &euro;</td>
            </tr>
            <tr>
                <th><?= Yii::t('app', 'Totale uscite')?></th>
                <td><?= $totOut ?> &euro;</td>
            </tr>
            <tr>
                <th><?= Yii::t('app', 'Totale')?></th>
                <td><?= $totIn-$totOut ?> &euro;</td>
            </tr>
        </table>
    </div>
    
    <div class=" rendiconto container">
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
                <h4><?= Yii::t('app', 'Entrate') ?></h4>
                
                <table class="table table-striped">
                                        
                    <?php if(sizeof($in) == 0): ?>
                    <p class="alert alert-info"><?= Yii::t('app', 'Nessuna voce') ?></p>
                    <?php endif; ?>
                    
                    <?php foreach($in as $key => $value) : ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($value->data_contabile)) ?></td>
                            <td><?= $value->voce ?></td>
                            <td><?= $value->prezzo ?> &euro;</td>
                        </tr>
                    <?php endforeach; ?>
                        
                </table>
                
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6">
                <h4><?= Yii::t('app', 'Uscite') ?></h4>
                
                <table class="table table-striped">
                    
                    <?php if(sizeof($out) == 0): ?>
                    <p class="alert alert-info"><?= Yii::t('app', 'Nessuna voce') ?></p>
                    <?php endif; ?>
                    
                    <?php foreach($out as $key => $value) : ?>
                        <tr>
                            <td><?= date('d-m-Y', strtotime($value->data_contabile)) ?></td>
                            <td><?= $value->voce ?></td>
                            <td><?= $value->prezzo ?> &euro;</td>
                        </tr>
                    <?php endforeach; ?>
                        
                </table>
                
            </div>
        </div>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/rendiconto.css');