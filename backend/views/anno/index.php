<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AnnoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Annos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anno-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Anno'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'anno',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Anno $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'anno' => $model->anno]);
                 }
            ],
        ],
    ]); ?>


</div>
