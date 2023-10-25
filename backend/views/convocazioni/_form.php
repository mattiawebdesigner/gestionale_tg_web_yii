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
            'data-form' => 'convocazione',
        ]
    ]); ?>
    
    <div class="row">
        <div class=" col-sm-12 col-md-12 col-lg-12 form-group">
            <span data-save="convocazione" class="btn btn-success">
                <?= '<i class="far fa-save"></i> '.Yii::t('app', 'Salva')  ?>
            </span>
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva e chiudi'), ['class' => 'btn btn-success']) ?>
            <span class="btn btn-danger">
                <?= Html::a('<i class="fas fa-times"></i> '.Yii::t('app', 'Chiudi'), ['index'])  ?>
            </span>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-8 col-md-8 col-lg-8">
            <?= $form->field($model, 'contenuto')->widget(TinyMce::className(), [
                'options' => ['rows' => 20, 'data-input' => 'contenuto'],
                'language' => 'it',
                'clientOptions' => [
                                'plugins' => [
                                       //"advlist autolink lists link charmap print preview"
                                       "lists",
                                       "anchor",
                                       "autolink",
                                       "link",
                                       "charmap",
                                       "fullscreen",
                                       "preview",
                                       "searchreplace visualblocks code fullscreen",
                                       "insertdatetime media table contextmenu paste",
                                       "pagebreak",
                                       "code",
                                       "visualblocks",
                                       "table",
                                       "media",
                                       "image",
                                   ],
                                   'toolbar1' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | fontfamily forecolor backcolor | bullist numlist outdent indent | link image anchor ",
                                   'toolbar2' => "table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
                                   'toolbar3' =>  "pagebreak | charmap code | fullscreen preview | visualblocks print",
                                   'toolbar4' => "media image",
                                   
                                    //'pagebreak_separator' => '<pagebreak />',
                                
                                    'file_picker_callback' => new yii\web\JsExpression("function(cb, value, meta) {
                                        var input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'image/*');

                                        // Note: In modern browsers input[type=\"file\"] is functional without 
                                        // even adding it to the DOM, but that might not be the case in some older
                                        // or quirky browsers like IE, so you might want to add it to the DOM
                                        // just in case, and visually hide it. And do not forget do remove it
                                        // once you do not need it anymore.

                                        input.onchange = function() {
                                          var file = this.files[0];

                                          var reader = new FileReader();
                                          reader.onload = function () {
                                            // Note: Now we need to register the blob in TinyMCEs image blob
                                            // registry. In the next release this part hopefully won't be
                                            // necessary, as we are looking to handle it internally.
                                            var id = 'blobid' + (new Date()).getTime();
                                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                            var base64 = reader.result.split(',')[1];
                                            var blobInfo = blobCache.create(id, file, base64);
                                            blobCache.add(blobInfo);

                                            // call the callback and populate the Title field with the file name
                                            cb(blobInfo.blobUri(), { title: file.name });
                                          };
                                          reader.readAsDataURL(file);
                                        };

                                        input.click();
                                       }"),
                                        'automatic_uploads' => true,
                                        'file_picker_types'=> 'file image media',
                ]
            ])->label(false);?>
        </div>

    
        <div class="col-sm-4 col-md-4 col-lg-4">
            <?= $form->field($model, 'numero_protocollo')->textInput(['data-id'=>$model->numero_protocollo??"0",'data-input' => 'numero_protocollo','maxlength' => true, 'placeholder' => Yii::t('app', 'Protocollo')])->label(false) ?>

            <?= $form->field($model, 'oggetto')->textInput(['data-input' => 'oggetto','maxlength' => true, 'placeholder' => Yii::t('app', 'Oggetto')])->label(false) ?>

            <?= $form->field($model, 'ordine_del_giorno')->textarea(['data-input' => 'ordine_del_giorno','rows' => 5,'maxlength' => true, 'placeholder' => Yii::t('app', 'Ordine del giorno')])->label(false) ?>

            <?= $form->field($model, 'data')->textInput(['data-input' => 'data','type' => 'date']) ?>

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
            
            <?= $form->field($model, 'delega')
                     ->dropDownList([ 'yes' => Yii::t('app', 'Si'), 
                                       'no' => Yii::t('app', 'No'), ], ['prompt' => 'Seleziona una scelta']) ?> 
            
            <?= $form->field($model, 'bozza')
                     ->dropDownList([ '10' => Yii::t('app', 'Si'), 
                                       '1' => Yii::t('app', 'No'), ], ['prompt' => 'Seleziona una scelta']) ?> 
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJsFile("@web/js/saveForm.js", ['depends' => yii\web\JqueryAsset::class]);
$this->registerJs("
    jQuery('[data-save]').saveForm({
        url : 'convocazioni/save'
    });
");