<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */

$this->title = Yii::t('app', 'Aggiorna giurato: {name}', [
    'name' => $model->nome,
]);
?>
<div id="imgs" class="attivita-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type'  => 'update',
    ]) ?>

</div>