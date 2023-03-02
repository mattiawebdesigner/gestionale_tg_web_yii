<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\Verbali;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VerbaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Verbali');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Convocazioni e verbali'), 'url' => ['manage']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verbali-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Nuovo verbale'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'numero_protocollo',
            'oggetto',
            'ordine_del_giorno',
            'data',
            'ora_inizio',
            //'ora_fine',
            'data_inserimento',
            //'ultima_modifica',
            //'firma',
            //'tipo',
            //'contenuto:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Verbali $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'numero_protocollo' => $model->numero_protocollo]);
                },
                'template' => '{view} {update} {delete} {download}',
                'buttons' => [
                    'download' => function ($url, $model){
                        return Html::a('<span class="fas fa-download"></span>', $url, [

					'title' => Yii::t('yii', 'Create'),

				]);                                


                    }
                ],
            ],
            
        ],
    ]); ?>


</div>
