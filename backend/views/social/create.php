<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Social */

$this->title = Yii::t('app', 'Create Social');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Socials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
