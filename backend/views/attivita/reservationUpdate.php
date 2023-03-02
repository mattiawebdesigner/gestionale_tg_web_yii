<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */

$this->title = Yii::t('app', 'Aggiorna prenotazione: {email}', [
    'email' => $model->email,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attivitas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div id="imgs" class="attivita-update">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_formReservation', [
        'model'      => $model,
        'placesLeft' => $placesLeft,
    ]) ?>
</div>