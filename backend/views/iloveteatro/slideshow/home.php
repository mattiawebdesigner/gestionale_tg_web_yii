<?php
use yii\helpers\Html;

$title = Yii::t('app', 'Galleria per la homepage');
$this->title = $title . " | I Love Teatro";
?>
<h1><i class="fas fa-home"></i> <?= Html::encode($title) ?> </h1>

<div class="gallery-home iloveteatro">
    <?= $this->render('_form', [
        'album' => $album,
        'foto'  => $foto,
        'fotoNew' => $fotoNew,
        //Show delete button
        'deleteBtn' => false,
    ]) ?>
</div>