<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Partecipazione */

$this->title = Yii::t('app', 'Update Partecipazione: {name}', [
    'name' => $model->attivita,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partecipaziones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->attivita, 'url' => ['view', 'attivita' => $model->attivita, 'nominativo' => $model->nominativo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="partecipazione-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
