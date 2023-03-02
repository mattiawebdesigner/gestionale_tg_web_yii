<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Gallery */

$this->title = Yii::t('app', 'Creazione galleria');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Creazione galleria'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'gallery' => $gallery,
        'fotoNew' => $fotoNew,
        'foto'    => $foto,
    ]) ?>

</div>
