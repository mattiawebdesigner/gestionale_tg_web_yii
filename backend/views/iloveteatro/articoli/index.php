<?php
use yii\helpers\Html;

$title = "Gestione Articoli";

$this->title = $title." | I Love Teatro";
?>
<h1><?= $title ?></h1>

<div id="articoli-index" class="index-page">
    <div class="item">
        <?= Html::a('<i class="far fa-plus-square"></i> <span>Nuovo articolo</span>', ['/iloveteatro/nuovo-articolo']); ?>
    </div>
    <div class="item">
        <?= Html::a('<i class="far fa-eye"></i> <span>Tutti gli articoli</span>', ['/iloveteatro/tutti-articoli']); ?>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/index-page.css');