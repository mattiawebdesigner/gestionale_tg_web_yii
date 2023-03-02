<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Rendiconto */

$this->title = Yii::t('app', 'Create Rendiconto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rendiconti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rendiconto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
