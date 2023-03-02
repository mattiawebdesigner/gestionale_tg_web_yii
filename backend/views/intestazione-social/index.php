<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IntestazioneSocialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Intestazione Socials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="intestazione-social-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Intestazione Social'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_intestazione',
            'id_social',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, IntestazioneSocial $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_intestazione' => $model->id_intestazione, 'id_social' => $model->id_social]);
                 }
            ],
        ],
    ]); ?>


</div>
