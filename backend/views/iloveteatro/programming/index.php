<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Programmazione');
?>
<h1><?= Html::encode( $this->title ) ?></h1>

<p>
    <?= Html::a('<i class="fa-solid fa-plus"></i> '.Yii::t('app', 'Nuovo spettacolo'), [
        'show-create'
    ], ['class' => 'btn btn-success btn-rotate btn-rotate-stop']); ?>
</p>

<div class="programming-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'spettacolo',
            'ora_porta:time',
            'ora_sipario:time',
            'data:date',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function($action, $model, $key, $index) {
                    return Url::toRoute(['iloveteatro/'.$action,'id' => $model->id]);
                },
                'template' => '{view-show} {delete-show}',
                'buttons' => [
                    'view-show' => function($url, $model, $key){
                        return Html::a('<i class="fa-solid fa-eye"></i>', $url);
                    },
                    'delete-show' => function($url, $model, $key){
                        $options = [
                            'title' => Yii::t('app', 'Cancella'),
                            'aria-label' => Yii::t('app', 'Cancella'),
                            'data-confirm' => Yii::t('app', 'Sicuro di voler cancellare lo spettacolo?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                            'class' => 'btn-llyc'
                        ];
                        
                        return Html::a('<i class="fa-solid fa-trash-alt"></i>', $url, $options);
                    }
                ]
            ]
        ],
    ]) ?>
</div>