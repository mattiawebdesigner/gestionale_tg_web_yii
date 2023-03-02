<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Categorie;
use backend\models\Proprietario;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProdottoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Prodotti');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodotto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome',
            //'categoria_id',
            //'descrizione:ntext',
            'quantita' => [
                'label' => Yii::t('app', 'Quantita\''),
                'attribute' => 'categoria_id'
            ],
            //'data_inserimento',
            
            /*[//Description
                'attribute' => "descrizione",
                'label' => 'Descrizione',
                'value' => function ($model) {
                    return '[...]';
                }
            ],*/
            
            [//Category name
                'attribute' => "categoria_id",
                'label' => 'Categoria',
                'value' => function ($model) {
                    return Categorie::findOne(['categoria_id'=>$model->categoria_id])->categoria;
                }
            ],
            
            'proprietario_id' => [
                'label' => Yii::t('app', 'Proprietario'),
                'attribute' => 'proprietario_id',
                'value' => function($model){
                return Proprietario::findOne(['id'=>$model->proprietario_id])->proprietario;
                },
            ],
            
        ],
    ]); ?>


</div>

<?php
$this->registerCssFile('@web/css/pagination.css');