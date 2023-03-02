<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RendicontoVoci */

$this->title = Yii::t('app', 'Update Rendiconto Voci: {name}', [
    'name' => $model->id_rendiconto,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rendiconto Vocis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_rendiconto, 'url' => ['view', 'id_rendiconto' => $model->id_rendiconto]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="rendiconto-voci-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
