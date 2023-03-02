<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Convocazioni */

$this->title = Yii::t('app', 'Nuova Convocazione');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Convocazioni'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="convocazioni-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
