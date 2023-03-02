<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TipoVerbali */

$this->title = Yii::t('app', 'Create Tipo Verbali');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipo Verbalis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-verbali-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
