<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UtentiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Utenti');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="utenti-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-add"></i> '.Yii::t('app', 'Nuovo utente'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nome',
            'cognome',
            'email:email',
            //'password',
            //'data_di_registrazione',
            //'data_ultima_modifica',
            //'indirizzo',
            //'status',
            //'password_hash',
            //'auth_key',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php
$this->registerCssFile('@web/css/pagination.css',['depends' => yii\bootstrap4\BootstrapAsset::class]);