<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Tutte le edizioni');
?>
<div class="sanlorenzo-events-all">
    
    <h1><i class="fa-solid fa-star-and-crescent"></i> <?= Html::encode($this->title) ?></h1>    

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Nuovo evento'), ['/sanlorenzo/create-event'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome',
            'edizione',
            'anno',
            //'descrizione',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, backend\models\SnlEdizione $model, $key, $index, $column) {
                    return Url::toRoute(['/sanlorenzo/event-'.$action, 'id' => $model->id ]);
                },
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>