<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Soci */

$this->title = Yii::t('app', 'Nuovo socio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Soci'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soci-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'             => $model,
        'annoSociale'       => $annoSociale,
        'socioAnnoSociale'  => $socioAnnoSociale,
        'firma'             => $firma,
        'create'            => true,
    ]) ?>

</div>
