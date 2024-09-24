<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model backend\models\AnnoSociale */

$this->title = "Anno Sociale: ".$anno;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tutti gli anni sociali'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="anno-sociale-view">

    <h1><?= Html::encode($this->title) ?></h1>
	
	<p>
        <?= Html::a('<i class="fas fa-table"></i> ', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-user-plus"></i> ', ['add', 'anno' => $anno], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<i class="fas fa-pen"></i> ', ['update', 'anno' => $anno], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', ''), ['delete', 'anno' => $anno], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => $model,
        'pagination' => [
            'pageSize' => 20
        ]
    ]);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'cognome',
            'nome',
            'email:email',
            'data_di_nascita:date',
            [//Sostenitore
                'attribute' => "sostenitore",
                'label' => Yii::t('app', 'Socio sostenitore'),
                'value' => function ($model) {
                    return $model->socioAnnoSociales[0]->sostenitore;
                }
            ],
            [//Validit�
                'attribute' => "validita",
                'label' =>  Yii::t('app', 'Socio in stato di validita\''),
                'value' => function ($model) {
                    return $model->socioAnnoSociales[0]->validita;
                }
            ],
            
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add} {view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) use ($anno) {
                        return Html::a(
                            '<i class="fas fa-eye"></i>',
                            ['/soci/view', 'id' => $model->id, 'anno' => $anno],
                            [
                                'title' => Yii::t('app', 'Visualizza socio'),
                            ]
                        );
                    },
                    'update' => function ($url, $model) use ($anno) {
                        return Html::a(
                            '<i class="fas fa-pencil"></i>',
                            ['/soci/update', 'id' => $model->id, 'anno' => $anno],
                            [
                                'title' => Yii::t('app', 'Aggiorna socio'),
                            ]
                        );
                    },
                    'add' => function ($url, $model) use($anno){
                        return Html::a(//Remove socio
                                '<i class="fas fa-user-minus"></i>',
                                ['/anno-sociale/remove', 'id' => $model->id, 'anno' => $anno, "action" => 'user'],
                                [
                                    'title' => 'Aggiungi all\'anno selezionato il socio',
                                ]
                               );
                    }
                ],
             ],
        ],
    ])
    ?>
</div>

<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css");
$this->registerCssFile('@web/css/pagination.css');
?>










