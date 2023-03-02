<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Soci */

$this->title = Yii::t('app', 'Aggiornamento: {name}', [
    'name' => $model->nome . " " .$model->cognome,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'I soci'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' =>  $model->nome . " " .$model->cognome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Aggiornamento');
?>
<div class="soci-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'annoSociale' => $annoSociale,
        'socioAnnoSociale'   => $socioAnnoSociale,
        /**
         * Validità del socio 
         * (quota pagata => si, no altrimenti)
         */
        'validita'      => $validita,
    ]) ?>

</div>
