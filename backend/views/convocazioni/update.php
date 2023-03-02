<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Convocazioni */

$this->title = Yii::t('app', 'Aggiornamento convocazione: {name}', [
    'name' => $model->numero_protocollo,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Convocazioni'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->numero_protocollo." ".$model->oggetto, 'url' => ['view', 'numero_protocollo' => $model->numero_protocollo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Aggiornamento');
?>
<div class="convocazioni-update">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <span class="btn btn-warning">
            <?= Html::a('<i class="fas fa-download"></i> ', ['download', 'numero_protocollo' => $model->numero_protocollo])  ?>
        </span>
    </p>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
