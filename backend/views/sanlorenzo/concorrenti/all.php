<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Tutti gli iscritti');
?>
<div class="sanlorenzo-concorrenti-all">
    
    <h1><i class="fas fa-eye"></i> <?= Html::encode($this->title) ?></h1>    

    <p>
        <!-- <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Iscrivi un gruppo/solista'), 
                'https://www.teatralmentegioia.it/lanottedisanlorenzo/frontend/web/index.php?r=site%2Fregister-contest&id=1', 
                ['class' => 'btn btn-success', 'target'=>'_blank']) ?>-->
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Iscrivi un gruppo/solista'), 
                ['concorrenti-create'], 
                ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nome_gruppo',
            'nome',
            'cognome',
            'citta_residenza',
            //'data_di_nascita',
            //'luogo_di_nascita',
            //'indirizzo',
            //'numero_civico',
            //'provincia_nascita',
            //'provincia_residenza',
            
            [
                'label' => Yii::t('app', 'Telefono'),
                'attribute' => 'cellulare',
                'format' => 'raw',
                'value' => function(backend\models\SnlConcorrenti $model){
                    return Html::a($model->cellulare, 'tel: '.$model->cellulare);
                },
            ],
            'email:email',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, backend\models\SnlConcorrenti $model, $key, $index, $column) {
                    return Url::toRoute(['/sanlorenzo/concorrenti-'.$action, 'id' => $model->id ]);
                },
                'template' => '{update} {view} {delete}',
            ],
        ],
    ]); ?>
</div>