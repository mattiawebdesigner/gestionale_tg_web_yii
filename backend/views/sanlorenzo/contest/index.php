<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

$this->title = ($type == "create") 
        ?  Yii::t('app', 'Nuova edizione') 
        : Yii::t('app', 'Aggiornamento edizione {edizione}', [
            'edizione' => $model->edizione
        ]);
?>
<div class="sanlorenzo-events-index sanlorenzo-form">
    
    <h1><?= ($type=="update") ? '<i class="fas fa-pencil"></i>' : '<i class="fas fa-eye"></i>' ?> <?= Html::encode($this->title) ?></h1>   
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="action-bar">
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva e chiudi'), ['class' => 'btn btn-success']) ?>

            <?php if($type=="update") : ?>
                <span class="btn btn-danger">
                    <?= Html::a('<i class="fas fa-trash-alt"></i> '.Yii::t('app', 'Cancella'), ['/sanlorenzo/delete-contest', 'id' => $model->id],[
                        'data' => [
                            'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questa edizione?'),
                            'method' => 'post',
                        ],
                    ])  ?>
                </span>
                <?php endif; ?>

                <span class="btn btn-danger">
                    <?= Html::a('<i class="fas fa-times"></i> '.Yii::t('app', 'Chiudi'), ['/sanlorenzo/index'])  ?>
                </span>
        </div>
    
        <?= $form->field($model, 'edizione')->textInput([
            'placeholder'   => Yii::t('app', 'Edizione del contest'),
            'autofocus'     => 'autofocus',
            'class'         => 'form-control title',
            'maxlength'     => true,
        ]) ?>
    
        <?php if($type == "create"): ?>
            <?= $form->field($model, 'allegato_a')->fileInput(['multiple' => 'multiple']) ?>
            <?= $form->field($model, 'allegato_b')->fileInput(['multiple' => 'multiple']) ?>
            <?= $form->field($model, 'allegato_c_minorenni')->fileInput(['multiple' => 'multiple']) ?>
            <?= $form->field($model, 'allegato_c_maggiorenni')->fileInput(['multiple' => 'multiple']) ?>
            <?= $form->field($model, 'regolamento')->fileInput(['multiple' => 'multiple']) ?>
        <?php else: ?>
            <?= $form->field($model, 'allegato_a')->fileInput(['multiple' => 'multiple']) ?>
            <?= $form->field($model, 'allegato_b')->fileInput(['multiple' => 'multiple']) ?>
            <?= $form->field($model, 'allegato_c_minorenni')->fileInput(['multiple' => 'multiple']) ?>
            <?= $form->field($model, 'allegato_c_maggiorenni')->fileInput(['multiple' => 'multiple']) ?>
            <?= $form->field($model, 'regolamento')->fileInput(['multiple' => 'multiple']) ?>
        <?php endif; ?>
    
        <?= $form->field($model, 'nome')->textInput([
            'placeholder'   => Yii::t('app', 'Nome dell\'evento'),
            'class'         => 'form-control title',
            'maxlength'     => true,
        ]) ?>
    
        <?= $form->field($model, 'descrizione')->widget(TinyMce::className(), [
                           'options' => ['rows' => 40, 'data-input' => 'contenuto'],
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
    <?php ActiveForm::end(); ?>
    
</div>