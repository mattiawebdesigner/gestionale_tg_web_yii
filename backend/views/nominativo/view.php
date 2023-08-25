<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Nominativo */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Albo d\'Oro'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="nominativo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'cognome',
            'data_inserimento',
            'data_ultima_modifica',
            'data_di_nascita',
            'foto' => [
                'label' => Yii::t('app', 'Foto del profilo'),
                'attribute' => 'foto',
                'format' => 'html',
                'value' => function ($model){
                    return Html::img($model->foto, ['style' => 'max-width: 350px;']);
                },
            ],
        ],
    ]) ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome',
            'data_attivita',
            'luogo',
            'foto' => [
                'label'     => Yii::t('app', 'Foto evento'),
                'attribute' => 'foto',
                'format'    => 'html',
                'value'     => function ($model){
                                    return Html::img($model->foto, ['style' => 'width: 150px;']);
                                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
	
</div>

<?php
$this->registerCssFile('@web/css/pagination.css',['depends' => yii\bootstrap4\BootstrapAsset::class]);