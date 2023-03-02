<?php
    /**
     * List of all events. 
     * Click on one events and show its reservations.
     */
?>
<?php
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AttivitaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Url;
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Elenco eventi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attività'), 'url' => ['/attivita/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1>


<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'nome',
        'foto' => [
            'label' => Yii::t('app', 'Foto'),
            'attribute' => 'foto',
            'format' => 'html',
            'value' => function ($model){
                return Html::img($model->foto, ['style' => 'width: 150px;']);
            }
        ],
        'descrizione:ntext',
        'luogo',
        'data_ultima_modifica',
        
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => "{reservation}",
            'buttons' =>[
                'reservation' => function($url, $model, $key){
                    return Html::a('<i class="fas fa-bookmark"></i>', $url);
                }
            ]
        ],
    ],
]); ?>

<?php
$this->registerCssFile('@web/css/pagination.css');