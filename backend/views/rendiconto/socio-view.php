<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Rendicontazioni');

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rendiconto-socio">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="tabs">
      <div class="row">
        <div class="col-4 col-md-3">
            <div class="nav nav-tabs nav-tabs-vertical" id="nav-vertical-tab" role="tablist" aria-orientation="vertical">
                <?php foreach ($model as $i): ?>
                    <a class="vertical-tab nav-link" 
                       id="nav-vertical-tab1-tab" 
                       data-toggle="tab" 
                       data-click="<?= $i->anno ?>"
                       href="#nav-vertical-tab<?= $i->anno ?>" 
                       role="tab" 
                       aria-controls="nav-vertical-tab1" 
                       aria-selected="true"><?= $i->anno ?></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-8 col-md-9">
          <div class="tab-content" id="nav-vertical-tabContent">
                <?php foreach($model as $i): ?>
                    <div class="tab-pane p-3 fade" 
                         id="nav-vertical-tab<?= $i->anno ?>" 
                         role="tabpanel" 
                         aria-labelledby="nav-vertical-tab1-tab">

                        <div class="load fa-3x">
                            <i class="fas fa-circle-notch fa-spin"></i>
                        </div>
                        <div class="attachment-rendiconto container">
                            <div class="not-found"><?= Yii::t('app', 'Nessuna rendicontazione trovata') ?></div>
                        </div>
                        
                    </div>
                    
                <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
</div>

<?php
$this->registerJsFile("@web/js/rendiconto-soci.js", ['depends' => yii\web\JqueryAsset::class]);
$this->registerJs('
    jQuery(".verbali-socio").rendiconto_socio({
    });
');
$this->registerCssFile("@web/css/verbaliSocio.css");
$this->registerCssFile("@web/css/tabs.css");