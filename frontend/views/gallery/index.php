<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Album fotografici');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="album" class="gallery-index">
    <h1><?= Html::encode( $this->title ) ?></h1>
    
    <div class="container">
        <div class="row">
            <?php foreach($model as $v) : ?>
            <div class="gallery col col-sm-5 col-md-3 col-lg-3"
                 style="background-image: url(../../backend/web/<?= $v->fotos[0]->url ?>)">
                <h5><?= Html::a($v->nome, ['album', 'album_id' => $v->id]) ?></h5>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php
$this->registerCssFile('@web/css/gallery.css');