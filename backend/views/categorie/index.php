<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategorieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categorie');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorie-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-add"></i> '.Yii::t('app', 'Nuova Categoria'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'categoria_id',
            'categoria',
            //'descrizione:ntext',
            /*[
                'label' => Yii::t('app', 'Descrizione'),
                'attribute' => 'descrizione',
                'value' => function($model){
                    return "[...]";
                },
            ],*/

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css");
$this->registerCssFile('@web/css/pagination.css');