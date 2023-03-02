<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Rendiconto */

$this->title = Yii::t('app', 'Aggiornamento Rendiconto: {name}', [
    'name' => $model->nome,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rendiconti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="rendiconto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
