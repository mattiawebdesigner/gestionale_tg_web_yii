<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Gli stand alimentari', );
?>
<div class="sanlorenzo-partner-view">
    <h1><i class="fa-solid fa-burger"></i> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Aggiungi uno stand alimentare'), ['sanlorenzo/stand-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome',
            'tipologia',
            'dimensione',
            [
                'label' => 'Postazione',
                'attribute' => 'n_postazione',
                'value' => function($model){
                    return $model->n_postazione;
                }
            ],
            [
                'label' => 'Logo',
                'attribute' => 'logo',
                'format' => 'raw',
                'value' => function($model){
                    return Html::img($model->logo, ['style' => 'max-width: 50%;']);
                }
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, backend\models\SnlStandAlimentari $model, $key, $index, $column) {
                    return Url::toRoute(['/sanlorenzo/stand-'.$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}',
            ],
            
        ],
    ]); ?>

</div>