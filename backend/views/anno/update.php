<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Anno */

$this->title = Yii::t('app', 'Update Anno: {name}', [
    'name' => $model->anno,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Annos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->anno, 'url' => ['view', 'anno' => $model->anno]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="anno-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
