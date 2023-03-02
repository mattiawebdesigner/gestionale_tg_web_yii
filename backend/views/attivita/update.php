<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */

$this->title = Yii::t('app', 'Aggiorna Attivita: {name}', [
    'name' => $model->nome,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attivita'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Aggiornamento');
?>
<div id="imgs" class="attivita-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
	<?= $this->render('_iFrame', [
	    'upload' => $upload,
	    'media'  => $media
	]); ?>

</div>