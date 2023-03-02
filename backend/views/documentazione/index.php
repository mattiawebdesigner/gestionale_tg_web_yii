<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DocumentazioneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Documentazione');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentazione-index">
    <p class="alert alert-info">Questa sezione non è ancora visibile per i soci</p>
    

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-add"></i> '.Yii::t('app', 'Aggiungi documentazione'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fileName',
            //'link',
            'mime',
            'visibile_socio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
