<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Categorie */

$this->title = Yii::t('app', 'Update Categorie: {name}', [
    'name' => $model->categoria_id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->categoria_id, 'url' => ['view', 'categoria_id' => $model->categoria_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="categorie-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
