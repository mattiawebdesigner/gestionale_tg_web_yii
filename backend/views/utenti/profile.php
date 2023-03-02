<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'Profilo');
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="utenti-profile">
	
    <div class="tabs">
        <div class="row">
          <div class="col-4 col-md-3">
            <div class="nav nav-tabs nav-tabs-vertical" id="nav-vertical-tab" role="tablist" aria-orientation="vertical">
              <a class="nav-link active" 
                 id="nav-vertical-tab-personal-tab" 
                 data-toggle="tab" 
                 href="#nav-vertical-tab-personal" 
                 role="tab" 
                 aria-controls="nav-vertical-tab-personal" 
                 aria-selected="true"><?= Yii::t('app', 'Dati personali') ?></a>
                
              <a class="nav-link" 
                 id="nav-vertical-tab-password-tab" 
                 data-toggle="tab"
                 href="#nav-vertical-tab-password" 
                 role="tab" 
                 aria-controls="nav-vertical-tab-password" 
                 aria-selected="false"><?= Yii::t('app', 'Password') ?></a>
            </div>
          </div>
          <div class="col-8 col-md-9">
            <div class="tab-content" id="nav-vertical-tabContent">
              <div class="tab-pane p-3 fade show active" 
                   id="nav-vertical-tab-personal" 
                   role="tabpanel" 
                   aria-labelledby="nav-vertical-tab1-tab">
                       <?= $this->render("_personal", [
                           'model' => $model
                       ]); ?>
              </div>
                
              <div class="tab-pane p-3 fade" 
                   id="nav-vertical-tab-password" 
                   role="tabpanel" 
                   aria-labelledby="nav-vertical-tab2-tab">
                       <?= $this->render("_password", [
                           'model' => $model
                       ]); ?>
              </div>
            </div>
          </div>
        </div>
    </div>

</div>

<?php
$this->registerJsFile('@web/js/password_generator.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJs("
    jQuery('.password-generator').password_generator();
");
$this->registerCssFile("@web/css/tabs.css");