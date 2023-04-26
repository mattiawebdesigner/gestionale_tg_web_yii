<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\DocumentazioneCategorie;

/* @var $this yii\web\View */
/* @var $model backend\models\Documentazione */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="imgs"  class="documentazione-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
	
    <?= $form->field($upload, 'mediaFile', 
                        ['options' => [
                                        'id' => 'read-file' 
                                      ],
                        ])->fileInput()->label(
            '<i class="fa-solid fa-file"></i> '.Yii::t('app', 'Seleziona un documento'),
            ['class' => 'file control-label'],
     ) ?>
     <div class="filename"></div>
     
     <br />
	 
	 <?= $form->field($model, 'fileName')->textInput(['maxlength' => true])->label( Yii::t('app', 'Nome del file') )?>
     
     <?= $form->field($model, 'visibile_socio')->dropDownList([ 'yes' => Yii::t('app', 'Si'), 'no' => Yii::t('app', 'No'), ], ['prompt' => ''])->label(Yii::t('app', 'Rendere visibile per i soci?')) ?>
	 
     <?= $form->field($model, 'categoria')->hiddenInput(['value' => $id])->label(false) ?>
     
     <div class="form-group">
    	 <button class="btn btn-success" type="submit"><i class="fas fa-upload"></i> <?= Yii::t('app', 'Carica il documento') ?></button>
     </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerCssFile('@web/css/media.css');
$this->registerJsFile('@web/js/upload.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJs('
    jQuery("#read-file").upload();
');