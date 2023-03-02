<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RendicontoVociSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rendiconto Vocis');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rendiconto-voci-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Rendiconto Voci'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_rendiconto',
            'id_voce',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, RendicontoVoci $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_rendiconto' => $model->id_rendiconto]);
                 }
            ],
        ],
    ]); ?>


</div>
