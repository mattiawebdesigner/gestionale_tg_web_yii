<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\SocioAnnoSociale */

$this->title = $model->socio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Socio Anno Sociales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="socio-anno-sociale-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'socio' => $model->socio, 'anno' => $model->anno], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'socio' => $model->socio, 'anno' => $model->anno], [
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
            'socio',
            'anno',
            'data_registrazione',
        ],
    ]) ?>

</div>
