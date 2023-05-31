<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Rendiconto */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rendicontazioni'), 'url' => ['socio-view']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div id="rendiconto" class="rendiconto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-table"></i> ', ['socio-view'], ['class' => 'btn btn-success', 'title' => Yii::t('app', 'Visualizza tutte le tabelle')]) ?>
        <?= Html::a('<i class="fas fa-download"></i> ', ['download', 'id' => $model->id], ['class' => 'btn btn-warning', 'title' => Yii::t('app', 'Scarica il rendiconto')]) ?>
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
                            <td>
                                <p><?= $value->voce ?></p>
                                
                                <?php $rules = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()); ?>
                                
                                <p class="text-muted small">
                                    <?php if(array_key_exists("Super User", $rules) || array_key_exists("segreteria", $rules)): ?>
                                    <?= Yii::t('app', 'Data di inserimento: {data}', [
                                        'data' => date('d-m-Y H:i:s', strtotime($value->data_inserimento)),
                                    ]) ?>
                                    <?php endif; ?>
                                </p>
                            </td>
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
                            <td>
                                <p><?= $value->voce ?></p>
                                
                                <?php $rules = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()); ?>
                                
                                <p class="text-muted small">
                                    <?php if(array_key_exists("Super User", $rules) || array_key_exists("segreteria", $rules)): ?>
                                    <?= Yii::t('app', 'Data di inserimento: {data}', [
                                        'data' => date('d-m-Y H:i:s', strtotime($value->data_inserimento)),
                                    ]) ?>
                                    <?php endif; ?>
                                </p>
                            </td>
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