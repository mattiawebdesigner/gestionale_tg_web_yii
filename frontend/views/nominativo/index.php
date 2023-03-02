<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NominativoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nominativi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nominativo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'nome',
            'cognome',
            //'data_di_nascita',
            'foto' => [
                'label' => Yii::t('app', 'Foto'),
                'attribute' => 'foto',
                'format' => 'html',
                'value' => function($model){
                    return Html::img('../../backend/web/'.$model->foto, ['style' => 'width: 150px;']);
                }
            ],
            [
                'label' => '',
                'format' => 'html',
                'value' => function($model){
                    return Html::a('<i class="fas fa-calendar-check"></i>', ['nominativo/attivita', 'id' => $model->id]);
                }
           ],
        ],
    ]); ?>


</div>

<?php
$this->registerCssFile('@web/css/pagination.css');