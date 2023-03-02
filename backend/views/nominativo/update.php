<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Nominativo */

$this->title = Yii::t('app', 'Aggiornamento nominativo: {name}', [
    'name' => $model->nome." ".$model->cognome,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Albo d\'Oro'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome." ".$model->cognome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div id="imgs" class="nominativo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'             => $model,
        'attivita'          => $attivita,
        'searchAttivita'    => $searchAttivita,
        'upload'            => $upload,
        'media'             => $media,
        'myAttivita'        => $myAttivita,
    ]) ?>

</div>

<?php
$this->registerCssFile('@web/css/pagination.css');