<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Partner', );
?>
<div class="sanlorenzo-partner-view">
    <h1><i class="fa-solid fa-handshake"></i> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Aggiungi un partner'), ['sanlorenzo/partner-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'partner',
            [
                'label' => 'Contenuto',
                'attribute' => 'note',
                'value' => function(){
                    return "[...]";
                }
            ],
            'tipo_di_sponsorizzazione',
            'postazioni',
            'ordinamento',                    
            [
                'label' => Yii::t('app', 'Tipologia di partner Internet'),
                'attribute' => 'tipologia_di_partner',
                'format' => 'html',
                'value' => function($model){
                    return ($model->tipologia_di_partner == \backend\models\SnlPartner::SPONSOR ? 'Sponsor' : 'Pubblica Amministrazione o Associazione');
                }
            ],
            [
                'label' => Yii::t('app', 'Sito Internet'),
                'attribute' => 'sito_internet',
                'format' => 'html',
                'value' => function($model){
                    return Html::a($model->sito_internet, $model->sito_internet);
                }
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, backend\models\SnlPartner $model, $key, $index, $column) {
                    return Url::toRoute(['/sanlorenzo/partner-'.$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}',
            ],
            
        ],
    ]); ?>

</div>