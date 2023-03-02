<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SociSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Soci');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soci-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-add"></i> '.Yii::t('app', 'Nuovo socio'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-add"></i> '.Yii::t('app', 'Aggiungi anno sociale'), ['/anno-sociale/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="tabs">
      <div class="row">
        <div class="col-4 col-md-3">
            <div class="nav nav-tabs nav-tabs-vertical" id="nav-vertical-tab" role="tablist" aria-orientation="vertical">
                <?php foreach ($annoSociale as $key => $i): ?>
                    <a class="vertical-tab nav-link <?= $key==0 ? "show active" : "" ?> 
                       id="nav-vertical-tab1-tab" 
                       data-toggle="tab" 
                       data-click="<?= $i->anno ?>"
                       data-anno="<?= $i->anno ?>"
                       href="#nav-vertical-tab<?= $i->anno ?>" 
                       role="tab" 
                       aria-controls="nav-vertical-tab1" 
                       aria-selected="true"><?= $i->anno ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-8 col-md-9">
          <div class="tab-content" id="nav-vertical-tabContent">
                <?php foreach($annoSociale as $key => $i): ?>
                    <div class="tab-pane p-3 fade <?= $key==0 ? "show active" : "" ?> " 
                         id="nav-vertical-tab<?= $i->anno ?>" 
                         role="tabpanel" 
                         aria-labelledby="nav-vertical-tab1-tab">
                        
                        <h3><?= Yii::t('app', 'Anno Sociale: ') ?> <?= $i->anno ?></h3>

                        <div class="load fa-3x">
                            <i class="fas fa-circle-notch fa-spin"></i>
                        </div>
                        <div class="attachment-partner container">
                            <div class="not-found"><?= Yii::t('app', 'Nessun socio trovato') ?></div>
                        </div>
                        
                    </div>
                    
                <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
    
</div>


<?php
$this->registerCssFile("@web/css/fontawesome-free-6.0.0-beta2-web/css/all.min.css");
$this->registerCssFile('@web/css/pagination.css');
$this->registerCssFile('@web/css/tabs.css');
$this->registerJsFile("@web/js/soci.js", ['depends' => yii\web\JqueryAsset::class]);
$this->registerJs("$('.tabs').soci();");