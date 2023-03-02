<?php

/* @var $this yii\web\View */
/* @var $model backend\models\Gallery */

$this->title = $gallery->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallerie'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="gallery-view">
    
    <?= $this->render('_form', [
        'gallery'       => $gallery,
        'galleryFoto'   => $galleryFoto,
        'foto'          => $foto,
        'fotoNew'       => $fotoNew,
    ]) ?>
    
</div>