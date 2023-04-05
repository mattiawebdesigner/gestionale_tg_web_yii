<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model backend\models\Nominativo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sanlorenzo-form">

    <?php $form = ActiveForm::begin(); ?>

		<div class="form-group">
        <?php if($type=="update"): ?>
            <?= Html::submitButton('<i class="fa-solid fa-floppy-disk"></i> ' . Yii::t('app', 'Aggiorna il giurato'), ['class' => 'btn btn-success']) ?>
        <?php else : ?>
            <?= Html::submitButton('<i class="fa-solid fa-floppy-disk"></i> ' . Yii::t('app', 'Salva il nuovo giurato'), ['class' => 'btn btn-success']) ?>
        <?php endif; ?>
    </div>
    
    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>
    
    <?php if($type=="update"): ?>
        <?= $form->field($model, 'foto')->fileInput(['required' => false]) ?>
    <?php else: //create ?>
        <?= $form->field($model, 'foto')->fileInput(['required' => false]) ?>
    <?php endif; ?>
    
    
    <?= $form->field($model, 'descrizione')->widget(TinyMce::className(), [
                            'options' => ['rows' => 30, 'data-input' => 'contenuto'],
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
                                   'pagebreak_separator' => '<pagebreak />',
                                   //'font_family_formats' => 'Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; AkrutiKndPadmini=Akpdmi-n',
                                   /*color_map: [
                                        '000000', 'Black',
                                        '808080', 'Gray',
                                        'FFFFFF', 'White',
                                        'FF0000', 'Red',
                                        'FFFF00', 'Yellow',
                                        '008000', 'Green',
                                        '0000FF', 'Blue'
                                  ],*/
                                
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

    
    <?php if($type=='update'): ?>
        <div class="cover"><img src="<?= $model->foto?>" /></div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>



<?php
$this->registerCssFile('@web/css/sanlorenzo/sanlorenzo-form.css', ['depends' => yii\bootstrap4\BootstrapAsset::class]);