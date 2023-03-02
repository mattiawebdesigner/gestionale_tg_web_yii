<?php
use yii\helpers\Html;

$title = Yii::t('app', 'Slideshow');
$this->title = $title . " | I Love Teatro";
?>
<h1><?= Html::encode($title) ?></h1>

<div class="slideshow-index index-page">
    <div class="item">
        <?= Html::a('<i class="fas fa-home"></i> <span>Homepage</span>', ['/iloveteatro/album-update', 'id' => 1]); ?>
    </div>
    <div class="item">
        <?= Html::a('<i class="far fa-images"></i> <span>Album fotografici</span>', ['/iloveteatro/slideshow-album']); ?>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/index-page.css');