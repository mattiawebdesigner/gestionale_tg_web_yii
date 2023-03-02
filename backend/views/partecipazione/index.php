<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PartecipazioneSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Partecipaziones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partecipazione-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Partecipazione'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'attivita',
            'nominativo',
            'data_partecipazione',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php
$this->registerCssFile('@web/css/pagination.css');