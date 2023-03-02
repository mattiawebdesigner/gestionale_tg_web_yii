<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VerbaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Gli articoli');
?>
<div class="verbali-index">

    <h1><i class="fa-solid fa-eye"></i> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Nuovo articolo'), ['/sanlorenzo/nuovo-articolo'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'titolo',
            [
                'label' => 'contenuto',
                'attribute' => 'contenuto',
                'value' => function(){
                    return "[...]";
                }
            ],
            'data_pubblicazione',
            'fine_pubblicazione',
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, backend\models\SnlArticoli $model, $key, $index, $column) {
                    return Url::toRoute(['/sanlorenzo/articoli-'.$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}',
            ],
            
        ],
    ]); ?>


</div>
