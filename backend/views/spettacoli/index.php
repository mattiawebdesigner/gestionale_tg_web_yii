<?php
/**
 * Elenco degli spettacoli
 */

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\VerbaliSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Spettacoli');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verbali-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('<i class="fas fa-add"></i> '.Yii::t('app', 'Aggiungi spettacolo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'spettacolo',
            'data',
            'ora_porta',
            'ora_sipario',
            /*[
                'label' => 'Banner',
                'attribute'  => 'banner',
                'format' => 'raw',
                'value' => function($data){
                    return "<img src='{$data->banner}' alt='Locandina spettacolo {$data->spettacolo}' style='width: 100%' />";
                }
            ],*/
            [
                'label' => 'Locandina',
                'attribute'  => 'locandina',
                'format' => 'raw',
                'value' => function($data){
                    return "<img src='{$data->locandina}' alt='Locandina spettacolo {$data->spettacolo}' style='width: 100px' />";
                }
            ],
            [
                'label' => 'Sinossi',
                'attribute'  => 'sinossi',
                'format' => 'text',
                'value' => function(){
                    return "[...]";
                }
            ],
            //'piantina',
            //'data_inserimento',
            //'ultima_modifica',
                    
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
</div>


<?php
$this->registerCssFile('@web/css/pagination.css',['depends' => yii\bootstrap4\BootstrapAsset::class]);