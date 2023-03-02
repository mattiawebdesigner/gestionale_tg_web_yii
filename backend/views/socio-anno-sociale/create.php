<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SocioAnnoSociale */

$this->title = Yii::t('app', 'Create Socio Anno Sociale');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Socio Anno Sociales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socio-anno-sociale-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
