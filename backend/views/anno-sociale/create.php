<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AnnoSociale */

$this->title = Yii::t('app', 'Nuovo anno sociale');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tutti gli anni sociali'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anno-sociale-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
