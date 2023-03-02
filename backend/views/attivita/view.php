<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attivita'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="attivita-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-table"></i>', ['index', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-pencil"></i> '.Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome',
            //'foto',
            [
                'label' => Yii::t('app', 'Foto'),
                'attribute' => 'foto',
                'value' => function ($model){                    
                    return (!is_null($model->foto)||!isEmpty($model->foto) ? Html::img($model->foto, ['style' => 'width: 350px']) : "");
                },
                'format' => 'html'
            ],
            'descrizione:ntext',
            'data_ultima_modifica',
            'data_inserimento',
            'luogo',
            'data_attivita',
            [
                'label' => Yii::t('app', 'A pagamento'),
                'attribute' => 'pagamento',
                'value' => function($model){
                return $model->pagamento == "yes" ? Yii::t('app', 'Si') : Yii::t('app', 'No');
                }
            ],
            [
                'label' => Yii::t('app', 'Quota'),
                'attribute' => 'costo',
                'value' => function($model){
                    return $model->costo . " &euro;";
                },
                'format' => 'html',
            ],
            [
                'label' => Yii::t('app', 'Prenotazione disponibile'),
                'attribute' => 'prenotazione',
                'value' => function($model){
                return $model->prenotazione == "yes" ? Yii::t('app', 'Si') : Yii::t('app', 'No');
                }
            ],
            'posti_disponibili',
            'annullato'
        ],
    ]) ?>

</div>
