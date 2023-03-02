<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attivitas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="attivita-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nome' => [
                'label' => Yii::t('app', 'Nome'),
                'attribute' => 'nome',
                'format' => 'html',
                'value' => function ($model){
                    return "<span class='line-through'>".$model->nome."</span>";
                }
            ],
            'foto' => [
                'label' => Yii::t('app', 'Foto'),
                'attribute' => 'foto',
                'format' => 'html',
                'value' => function($model){
                    return Html::img("../../backend/web/".$model->foto);
                }
            ],
            'descrizione',
            //'data_ultima_modifica',
            //'data_inserimento',
            'luogo',
            'data_attivita:date',
        ],
    ]) ?>

</div>
