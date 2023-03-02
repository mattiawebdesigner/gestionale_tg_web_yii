<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model[0]->nome;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gallerie'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

//Initialize variable
$i = $j = 0;
?>
<div id="album" class="gallery-index">
    <h1><?= Html::encode( $this->title ) ?></h1>
    
    <p class="description">
        <?= $model[0]->descrizione ?>
    </p>
    
    <div class="container">
        <div class="row">
            <?php foreach($model[0]->fotos as $v) : ?>
            <div data-image-position="<?= $i ++??0 ?>" class="foto col col-sm-5 col-md-3 col-lg-2"
                 style="background-image: url(../../backend/web/<?= $v->url ?>)">
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

    
<div id="gallery" class="fullscreen">
    <div class="close">
        <i class="fas fa-times"></i>
    </div>
    
    <div class="wrap">
            
        <div class="relative">
                <div class="prev"><i class="fas fa-arrow-circle-left"></i></div>
            <?php foreach($model[0]->fotos as $v) : ?>
            <div class="image" data-image-position="<?= $j ++??0 ?>" data-show="false">
                <div class="img-box">
                    <div class="img">
                        <img src="../../backend/web/<?= $v->url ?>" alt="<?= $v->alt_text; ?>" title="<?= $v->title_text; ?>" />
                    </div>
                </div>
                
                <?php if($v->descrizione <> "") : ?>
                <div class="container-info">
                    <div class="description">
                        <?= $v->descrizione ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
                <div class="next"><i class="fas fa-arrow-circle-right"></i></div>
        </div>
    </div>
        
</div>

<?php
$this->registerCssFile('@web/css/gallery.css');
$this->registerJsFile('@web/js/fullscreen_gallery.js', ['depends' => yii\web\JqueryAsset::class]);
$this->registerJs('
    jQuery("#gallery").fullscreen_gallery();
');