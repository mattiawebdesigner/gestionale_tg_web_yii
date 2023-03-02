<?php
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
?>
    <div class="email-form">
    
    <?php $form = ActiveForm::begin([
        'options' => [
            'data-form' => 'email',
        ]
    ]); ?>
    
    <div class="row">
        <div class="col-sm-8 col-md-8 col-lg-8">
            <?= $form->field($model, 'corpo')->widget(TinyMce::className(), [
                'options' => ['rows' => 20, 'data-input' => 'corpo'],
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
    </div>
    
    <?php ActiveForm::end(); ?>
</div>