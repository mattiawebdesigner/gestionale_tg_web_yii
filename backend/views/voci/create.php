<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Voci */

$this->title = Yii::t('app', 'Gestione voci{rendiconto}',[
    'rendiconto' => ': '.$rendiconto->nome,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rendiconto: {rendiconto}', [
    'rendiconto' => $rendiconto->nome
]), 'url' => ['/rendiconto/view', 'id' => $rendiconto->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="voci-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'in'    => $in,
        'out'   => $out,
    ]) ?>

</div>
