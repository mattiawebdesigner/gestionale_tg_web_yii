<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\IltFestival;

$title = Yii::t('app', "Elenco dei festival");
$this->title = $title . " | I Love Teatro";
?>
<h1><?= Html::encode($title) ?></h1>
    
<div class="fstival-table">
    
    <div class="action-bar">
        <?= Html::a('<i class="fas fa-plus"></i> '.Yii::t('app', 'Nuovo festival'), ['iloveteatro/festival'], ['class' => 'btn btn-success']) ?>
    </div>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'anno',
            'edizione',
            'inizio',
            'fine',
            'inizio_pubblicazione',
            'fine_pubblicazione',

            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, IltFestival $model, $key, $index, $column) {
                    return Url::toRoute(["festival-".$action, 'id' => $model->id]);
                },
                'template' => '{view} {delete}',
                'buttons' => [
                ],
            ],
        ],
    ]); ?>
</div>