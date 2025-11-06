<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AttivitaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Attivita');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attivita-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Nuova Attività'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'foto' => [
                'label' => Yii::t('app', 'Foto'),
                'attribute' => 'foto',
                'format' => 'html',
                'value' => function ($model){
                    return Html::img($model->foto, ['style' => 'width: 150px;']);
                }
            ],
            //'descrizione:ntext',
            'luogo',
            'data_ultima_modifica',
            //'data_inserimento',
            //'data_attivita',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php
$this->registerCssFile('@web/css/pagination.css');