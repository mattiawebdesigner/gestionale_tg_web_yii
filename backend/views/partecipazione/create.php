<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Partecipazione */

$this->title = Yii::t('app', 'Create Partecipazione');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Partecipaziones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="partecipazione-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
