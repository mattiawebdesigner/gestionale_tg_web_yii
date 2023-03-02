<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Articoli commentati')
?>
<div class="crm-sanlorenzo-all-comments-articles">
    <h1><i class="fa-solid fa-comments"></i> <?= Html::encode($this->title) ?></h1>
    
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
                'label' => 'Commenti',
                'value' => function ($model) {
                    return backend\models\SnlArticoliCommenti::find()->where(['articolo' => $model->id])->count();
                }
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, backend\models\SnlArticoli $model, $key, $index, $column) {
                    return Url::toRoute(['/sanlorenzo/article-comments-'.$action, 'id' => $model->id]);
                },
                'template' => '{view}',
            ],
            
        ],
    ]); ?>
</div>