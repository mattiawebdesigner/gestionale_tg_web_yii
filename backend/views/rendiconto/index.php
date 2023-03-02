<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RendicontoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rendiconti');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rendiconto-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Nuova rendicontazione'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Nuovo anno'), ['anno/create'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nome',
            //'data_inserimento',
            //'ultima_modifica',
            'anno',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, \backend\models\Rendiconto $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
