<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Utenti;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SociSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Seleziona un socio per creargli un account');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soci-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            //'id',
            'cognome',
            'nome',
            'email:email',
            //'indirizzo',
            //'data_registrazione',
            //'data_di_nascita',

            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function($action, $model, $key, $index) {
                    return '';
                },
                'template' => '{select}',
                'buttons'           => [
                    'select' => function ($url, $model, $key) {
                                    $user = Utenti::find()->where(['socio_id' => $model->id])->one();
                                    
                                    return $user == null ? Html::a("", ['/utenti/create', 'id' => $model->id], ['class' => 'form form-radio']) : '';
                                }
                ],
            ],
        ],
    ]); ?>


</div>

<?php
$this->registerCssFile('@web/css/pagination.css',['depends' => yii\bootstrap4\BootstrapAsset::class]);