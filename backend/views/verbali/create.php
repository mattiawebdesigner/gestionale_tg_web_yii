<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Verbali */

$this->title = Yii::t('app', 'Nuovo Verbale');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Verbalis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="verbali-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'     => $model,
        'allegati'  => $allegati,
        'firme'     => $firme,
    ]) ?>

</div>
