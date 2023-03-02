<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AnnoSocialeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Anno Sociale');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anno-sociale-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-add"></i> '.Yii::t('app', 'Nuovo Anno Sociale'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'anno',
            'quotaSocioOrdinario',
            'quotaSocioSostenitore',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{add} {view} {update} {delete}',
                'buttons' => [
                    'add' => function ($url, $model) {
                    return Html::a(
                        '<i class="fas fa-user-plus"></i>',
                        ['/anno-sociale/add', 'anno' => $model->anno],
                        [
                            'title' => Yii::t('app', 'Aggiungi un socio all\'anno'),
                        ]
                        );
                    },
                    'view' => function ($url, $model) {
                        return Html::a(
                            '<i class="fas fa-eye"></i>',
                            ['/anno-sociale/view', 'anno' => $model->anno],
                            [
                                'title' => Yii::t('app', 'Visualizza soci'),
                            ]
                        );
                    }
                 ],
            ],
        ],
    ]); ?>


</div>

<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css");
$this->registerCssFile('@web/css/pagination.css');