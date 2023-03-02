<?php
use yii\helpers\Html;

$title = Yii::t('app', 'Impostazioni');
$this->title = $title . " | I Love Teatro";
?>
<h1><?= Html::encode($title) ?></h1>

<p class="alert alert alert-warning">
    <?= Yii::t('app', 'Al momento questa sezione non è attiva') ?>
</p>