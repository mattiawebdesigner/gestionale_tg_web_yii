<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Documentazione */

$this->title = Yii::t('app', 'Carica un documento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentaziones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentazione-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'  => $model,
        'upload' => $upload,
    ]) ?>

</div>