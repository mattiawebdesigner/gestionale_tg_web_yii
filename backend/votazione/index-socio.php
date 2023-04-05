<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use backend\models\Votazione;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VociSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tutte le votazioni');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="votazione-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'anno',
            /*'data_creazione' =>[
                'attribute' => 'data_creazione',
                'value' => function($model){
                    return date("d/m/Y", strtotime($model->data_creazione));
                },
            ],*/
            'info' =>[
                'attribute' => 'info',
                'format' => 'html',
                'label' => Yii::t('app', 'Data e orari'),
                'value' => function($model){
                    if(is_null($model->info) || empty($model->info)) return "";
                    
                    $decode = json_decode($model->info);
                    
                    $out = "<ul>";
                    foreach($decode as $k => $v){
                        $out .= "<li>";
                        $out .= "il ".$v->data." dalle ";
                        $out .= $v->ora_inizio." alle ";
                        $out .= $v->ora_fine;
                        $out .= "</li>";
                    }
                    $out .= "</ul>";
                    
                    return $out;
                },
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Votazione $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model){
                        return Html::a('<span class="fas fa-eye"></span>', Url::to(["votazione/view-socio", "id" => $model->id]), [

					'title' => Yii::t('yii', ''),

				]);                                


                    }
                ],
            ],
            
        ],
    ]); ?>
</div>