<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RendicontoVoci */

$this->title = Yii::t('app', 'Create Rendiconto Voci');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rendiconto Vocis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rendiconto-voci-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
