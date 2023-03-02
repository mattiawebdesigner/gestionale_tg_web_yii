<?php

use yii\web\View;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Attivita */

$this->title = Yii::t('app', 'Nuova Attivita');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Attivita'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="imgs" class="attivita-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <?= $this->render('_iFrame', [
        'upload' => $upload,
        'media'  => $media
    ]); ?>
</div>
