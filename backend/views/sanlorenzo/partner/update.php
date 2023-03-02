<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */

$this->title = Yii::t('app', 'Aggiorna partner: {name}', [
    'name' => $model->partner,
]);
?>
<div id="imgs" class="attivita-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'max'   => $max,
        'type'  => 'update',
    ]) ?>

</div>