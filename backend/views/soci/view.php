<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Soci */

$this->title = $model->nome. " ". $model->cognome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Soci'), 'url' => ['all']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="soci-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-table"></i> ', ['all'], ['class' => 'btn btn-success']) ?>
        <!--<?= Html::a('<i class="fas fa-user-plus"></i> ', ['anno-sociale/index'], ['class' => 'btn btn-info']) ?>-->
        <?= Html::a('<i class="fas fa-pen"></i> '.Yii::t('app', 'Update'), ['update', 'id' => $model->id, 'anno'=>$anno], ['class' => 'btn btn-primary']) ?>
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
            'nome',
            'cognome',
            'indirizzo',
            'email:email',
            'data_registrazione',
            'data_di_nascita',
        ],
    ]) ?>
    
    <?php if($firma) : ?>
        <h5><?= Yii::t('app', 'Firma registrata'); ?></h5>
        
        <img style="max-width: 250px" src="<?= Yii::$app->params['site_protocol'].Yii::$app->params['backendWeb'].$firma->firma ?>" />
    <?php endif; ?>
    
    <h5><?= Yii::t('app', 'Anni sociali') ?></h5>
    <ul>
        <?php foreach($years as $year): ?>
        <li><?= Html::a($year->anno, ['anno-sociale/view', 'anno' => $year->anno]) ?></li>
        <?php endforeach; ?>
    </ul>

</div>

<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css")
?>