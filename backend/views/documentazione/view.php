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
        <?= Html::a('<i class="fas fa-table"></i>', ['index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-pencil"></i> '.Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'link',
            'mime',
            'visibile_socio',
        ],
    ]) ?>
		
	<embed src="<?= $model->link ?>" />

</div>
<?php
$this->registerCss('
embed{
    width: 100%;
    height: 30vw;
}
');

















