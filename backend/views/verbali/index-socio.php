<?php
/* 
 * 
*/
$this->title = Yii::t('app', 'Convocazioni e verbali');
?>
<h1><?= $this->title ?></h1>

<div class="verbali-socio">
    <div class="tabs">
      <div class="row">
        <div class="col-4 col-md-3">
            <div class="nav nav-tabs nav-tabs-vertical" id="nav-vertical-tab" role="tablist" aria-orientation="vertical">
                <?php for($i=date("Y"); $i>=$start; $i --): ?>
                    <a class="vertical-tab nav-link <?= date("Y")===$i ? 'active' : '' ?>" 
                       id="nav-vertical-tab1-tab" 
                       data-toggle="tab" 
                       data-click="<?= $i ?>"
                       href="#nav-vertical-tab<?= $i ?>" 
                       role="tab" 
                       aria-controls="nav-vertical-tab1" 
                       aria-selected="true"><?= $i ?></a>
                <?php endfor; ?>
            </div>
        </div>
        <div class="col-8 col-md-9">
          <div class="tab-content" id="nav-vertical-tabContent">
                <?php for($i=date("Y"); $i>=$start; $i --): ?>
                    <div class="tab-pane p-3 fade <?= date("Y")===$i ? 'show active' : '' ?>" 
                         id="nav-vertical-tab<?= $i ?>" 
                         role="tabpanel" 
                         aria-labelledby="nav-vertical-tab1-tab">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" 
                                   id="nav-tab1-tab" 
                                   data-toggle="tab" 
                                   href="#nav-convocazioni-<?= $i ?>" 
                                   role="tab" 
                                   aria-controls="nav-tab1" 
                                   aria-selected="true"><?= Yii::t('app', 'Convocazioni') ?></a>
                                <a class="nav-item nav-link" 
                                   id="nav-tab2-tab" 
                                   data-toggle="tab" 
                                   href="#nav-verbali-<?= $i ?>" 
                                   role="tab" 
                                   aria-controls="nav-tab2" 
                                   aria-selected="false"><?= Yii::t('app', 'Verbali') ?></a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane p-4 fade show active" 
                                 id="nav-convocazioni-<?= $i ?>" 
                                 role="tabpanel"
                                 aria-labelledby="nav-tab1-tab">
                                
                                <div class="load fa-3x">
                                    <i class="fas fa-circle-notch fa-spin"></i>
                                </div>
                                <div class="attachment-convocazioni container">
                                    <div class="not-found"><?= Yii::t('app', 'Nessuna convocazione trovata') ?></div>
                                </div>
                                
                            </div>
                            <div class="tab-pane p-4 fade" 
                                 id="nav-verbali-<?= $i ?>" 
                                 role="tabpanel" 
                                 aria-labelledby="nav-tab2-tab">
                                
                                <div class="load fa-3x">
                                    <i class="fas fa-circle-notch fa-spin"></i>
                                </div>
                                <div class="attachment-verbali container">
                                    <div class="not-found"><?= Yii::t('app', 'Nessun verbale trovato') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php endfor; ?>
          </div>
        </div>
      </div>
    </div>
</div>    
<?php
$this->registerJsFile("@web/js/verbali-socio.js", ['depends' => yii\web\JqueryAsset::class]);
$this->registerJs('
    jQuery(".verbali-socio").verbali_socio({
        "verbali-attachment" : ".attachment-verbali",
        "convocazioni-attachment" : ".attachment-convocazioni",
    });
');
$this->registerCssFile("@web/css/verbaliSocio.css");
$this->registerCssFile("@web/css/tabs.css");