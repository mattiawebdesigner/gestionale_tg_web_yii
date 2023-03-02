<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\Convocazioni;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ConvocazioniSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Convocazioni');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Convocazioni e verbali'), 'url' => ['/verbali/manage']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convocazioni-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Nuova Convocazione'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'numero_protocollo',
            'ordine_del_giorno',
            'oggetto',
            'data',
            'data_inserimento',
            //'ultima_modifica',
            //'tipo',
            //'contenuto:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Convocazioni $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'numero_protocollo' => $model->numero_protocollo]);
                 }
            ],
        ],
    ]); ?>


</div>
