<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\models\Verbali */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="verbali-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'data-form' => 'verbale',
        ]
    ]); ?>
    
    <div class="row">
        <div class=" col-sm-12 col-md-12 col-lg-12 form-group">
            <!--<span data-save="verbale" class="btn btn-success">
                <?= '<i class="far fa-save"></i> '.Yii::t('app', 'Salva')  ?>
            </span>-->
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva e chiudi'), ['class' => 'btn btn-success']) ?>
            <span class="btn btn-danger">
                <?= Html::a('<i class="fas fa-times"></i> '.Yii::t('app', 'Chiudi'), ['index'])  ?>
            </span>
            <span class="btn btn-warning">
                <?= Html::a('<i class="fas fa-download"></i> ', ['download', 'numero_protocollo' => $model->numero_protocollo])  ?>
            </span>
            <span class="btn btn-link">
                <?= Html::a(Yii::t('app', '{icon}Modifiche al verbale', [
                    'icon' => '<i class="fa-solid fa-clock-rotate-left"></i> ',
                ]), ['modifiche', 'numero_protocollo' => $model->numero_protocollo], ['target' => '_blank'])  ?>
            </span>
        </div>
    </div>
    
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-12">
            <p><strong><?= Yii::t('app', 'Estensioni consentite: jpg, jpeg, png, pdf') ?></strong></p>
            <?= $form->field($allegati, 'allegato')->fileInput(['multiple' => 'true'])
                 ->label(Yii::t('app', 'Seleziona file da allegare'), ['class' => 'control-label btn btn-light']) ?>
            <div class="filenames"></div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-8 col-md-8 col-lg-8">
            <?= $form->field($model, 'contenuto')->widget(TinyMce::className(), [
                'options' => ['rows' => 20, 'data-input' => 'contenuto'],
                'language' => 'it',
                'clientOptions' => [
                    'plugins' => [
                        "advlist autolink lists link charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste",
                        "lists",
                        "table",
                    ],
                    'toolbar1' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | lists advlist",
                    'toolbar2' => "table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
                    'toolbar3' =>  "pagebreak | charmap code | fullscreen preview | visualblocks print",
                ]
            ])->label(false);?>
        </div>

    
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'numero_protocollo')->textInput(['data-id'=>$model->numero_protocollo??"0",'data-input' => 'numero_protocollo','maxlength' => true, 'placeholder' => Yii::t('app', 'Protocollo')])->label(false) ?>

            <?= $form->field($model, 'oggetto')->textInput(['data-input' => 'oggetto','maxlength' => true, 'placeholder' => Yii::t('app', 'Oggetto')])->label(false) ?>

            <?= $form->field($model, 'ordine_del_giorno')->textarea(['data-input' => 'ordine_del_giorno','rows' => 5,'maxlength' => true, 'placeholder' => Yii::t('app', 'Ordine del giorno')])->label(false) ?>

            <?= $form->field($model, 'data')->textInput(['data-input' => 'data','type' => 'date']) ?>

            <?= $form->field($model, 'ora_inizio')->textInput(['data-input' => 'ora_inizio','type' => 'time']) ?>

            <?= $form->field($model, 'ora_fine')->textInput(['data-input' => 'ora_fine','type' => 'time']) ?>
            
            <?= $form->field($model, 'firma')
                     ->dropDownList(
                         ArrayHelper::map($firme, 'id', function ($socio, $defaultValue) {

                            return $socio->cognome . ' ' . $socio->nome;

                        }),
            )->label(Yii::t('app', 'Nominativo di chi firma il verbale (verrà inserita la firma)')) ?>
            
            
            <?= $form->field($model, 'tipo')
                     ->dropDownList(
                         ArrayHelper::map(\backend\models\TipoVerbali::find()->all(), 'id', 'tipologia'),
                         ['data-input' => 'tipo']
            )->label(Yii::t('app', 'Tipologia di verbale')) ?>
            
            <?= $form->field($model, 'bozza')
                     ->dropDownList([ '10' => Yii::t('app', 'Si'), 
                                       '1' => Yii::t('app', 'No'), ], ['prompt' => 'Seleziona una scelta']) ?> 
    
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerCssFile('@web/css/uploadFiles.css');
$this->registerJsFile("@web/js/saveForm.js", ['depends' => yii\web\JqueryAsset::class]);
$this->registerJsFile("@web/js/uploadFile.js", ['depends' => yii\web\JqueryAsset::class]);
$this->registerJs("
    jQuery('[data-save]').saveForm({
        url : 'verbali/save'
    });
    jQuery('input:file').uploadFile();
");