<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Categorie;
use backend\models\Proprietario;

/* @var $this yii\web\View */
/* @var $model backend\models\Prodotto */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prodotti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="prodotto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-table"></i> ', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-pen"></i> '.Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nome' => [
                'attribute' => 'categoria_id',
                'label' => Yii::t('app', 'Categoria'),
                'value' => Categorie::findOne(['categoria_id'=>$model->categoria_id])->categoria,
            ],
            //'categoria_id',
            //'descrizione:ntext',
            
            /*[
                'label' => Yii::t('app', 'Descrizione'),
                'attribute' => 'descrizione',
                'value' => function($model){
                    return "[...]";
                },
            ],*/
            
            'quantita',
            'data_inserimento',
            'proprietario_id' => [
                'attribute' => 'proprietario_id',
                'label' => 'Proprietario',
                'value' => Proprietario::findOne(['id'=>$model->proprietario_id])->proprietario,
            ],
        ],
    ]) ?>
    
    <h3><?= Yii::t('app', 'Descrizione') ?></h3>
    <hr />
    <?= $model->descrizione ?>
</div>

<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css")
?>