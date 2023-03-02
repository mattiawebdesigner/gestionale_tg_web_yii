<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Giurati', );
?>
<div class="sanlorenzo-partner-view">
    <h1><i class="fa-solid fa-gavel"></i> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Aggiungi un giurato'), ['sanlorenzo/giudice-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome',
            'cognome',
            [
                'label' => 'Descrizione',
                'attribute' => 'descrizione',
                'value' => function(){
                    return "[...]";
                }
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, backend\models\SnlGiudici $model, $key, $index, $column) {
                    return Url::toRoute(['/sanlorenzo/giudici-'.$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}',
            ],
            
        ],
    ]); ?>

</div>