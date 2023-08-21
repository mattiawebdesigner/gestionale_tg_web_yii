<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VerbaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Articoli');
?>
<div class="verbali-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Nuovo articolo'), ['/iloveteatro/nuovo-articolo'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'titolo',
            [
                'label' => 'Contenuto',
                'attribute' => 'contenuto',
                'value' => function(){
                    return "[...]";
                }
            ],
            [
                'label' => 'Categoria',
                'attribute' => 'categoria',
                'value' => function ($model){
                    return backend\models\IltCategorie::findOne(['id' => $model->categoria])->categoria;
                }
            ],
            'data_pubblicazione',
            [
                'label' => 'Fine Pubblicazione',
                'attribute' => 'fine_pubblicazione',
                'value' => function ($model){
                    return isset($model->fine_pubblicazione)&&!is_null($model->fine_pubblicazione)?date("d-m-Y H:i", strtotime($model->fine_pubblicazione)):"";
                }
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, backend\models\IltArticoli $model, $key, $index, $column) {
                    return Url::toRoute(['/iloveteatro/articoli-'.$action, 'id' => $model->id]);
                },
                'template' => '{update} {delete}',
            ],
            
        ],
    ]); ?>


</div>
