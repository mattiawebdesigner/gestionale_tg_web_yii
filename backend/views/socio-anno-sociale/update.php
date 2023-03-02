<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SocioAnnoSociale */

$this->title = Yii::t('app', 'Update Socio Anno Sociale: {name}', [
    'name' => $model->socio,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Socio Anno Sociales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->socio, 'url' => ['view', 'socio' => $model->socio, 'anno' => $model->anno]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="socio-anno-sociale-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
