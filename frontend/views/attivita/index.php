<?php

use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AttivitaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Le nostre attivita');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attivita-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome' => [
                'label' => Yii::t('app', 'Nome'),
                'attribute' => 'nome',
                'format' => 'html',
                'value' => function ($model){
                    return "<span class='".($model->annullato=='yes'?'line-through':'')."'>".$model->nome."</span>";
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
            //'descrizione:ntext',
            //'data_ultima_modifica',
            //'data_inserimento',
            'luogo',
            'data_attivita',

            [
                'class' => ActionColumn::class,
                'template' => '{view}',
            ],
        ],
    ]); ?>


</div>

<?php
$this->registerCssFile('@web/css/pagination.css');