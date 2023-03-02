<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Utenti */

$this->title = Yii::t('app', 'Aggiornamento: {name} {cognome}', [
    'name'      => $model->nome,
    'cognome'   => $model->cognome,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Utentis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome." ".$model->cognome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="utenti-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'auth_assignment' => $auth_assignment,
        'auth_item' => $auth_item,
    ]) ?>

</div>
