<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Gli artisti', );
?>
<div class="sanlorenzo-partner-view">
    <h1><i class="fa-solid fa-palette"></i> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Aggiungi un\'artista'), ['sanlorenzo/artista-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome',
            'postazione',
            'tipologia',
            [
                'label' => 'Descrizione',
                'attribute' => 'descrizione',
                'value' => function(){
                    return "[...]";
                }
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, backend\models\SnlArtisti $model, $key, $index, $column) {
                    return Url::toRoute(['/sanlorenzo/artisti-'.$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}',
            ],
            
        ],
    ]); ?>

</div>