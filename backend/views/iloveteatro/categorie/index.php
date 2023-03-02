<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VerbaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categorie');
?>
<div class="verbali-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Nuova categoria'), ['/iloveteatro/categoria-create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'categoria',
            
            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, backend\models\IltCategorie $model, $key, $index, $column) {
                    return Url::toRoute(['/iloveteatro/categorie-'.$action, 'id' => $model->id ]);
                },
                'template' => '{view} {update} {delete} {download}',
            ],
        ],
    ]); ?>


</div>
