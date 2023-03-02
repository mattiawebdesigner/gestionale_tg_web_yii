<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Prodotto */

$this->title = Yii::t('app', 'Create Prodotto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Prodottos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodotto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
