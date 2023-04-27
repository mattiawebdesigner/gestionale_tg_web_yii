<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Documentazione */

$this->title = $model->fileName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentaziones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="documentazione-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-table"></i>', ['index', 'id' => $cartellaId], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa-solid fa-download"></i> '.Yii::t('app', 'Scarica'), $model->link, ['class' => 'btn btn-warning', 'download' => true]) ?>
        <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
		
    <embed src="<?= $model->link ?>" />

</div>
<?php
$this->registerCss('
embed{
    width: 100%;
    height: 30vw;
}
');

















