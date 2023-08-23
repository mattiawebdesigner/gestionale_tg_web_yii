<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use dosamigos\tinymce\TinyMce;

$title = "Il festival";
$this->title = $title . " | I Love Teatro";
?>
<div class="festival-index ilove-form">
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
        <div class="action-bar">
            <span class="btn btn-warning">
                <?= Html::a('<i class="fas fa-table"></i> '.Yii::t('app', ''), ['/iloveteatro/festival-table'])  ?>
            </span>
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva e chiudi'), ['class' => 'btn btn-success']) ?>

            <?php if($type=="update") : ?>
                <span class="btn btn-danger">
                    <?= Html::a('<i class="fas fa-trash-alt"></i> '.Yii::t('app', 'Cancella'), ['/iloveteatro/festival-delete', 'id' => $newFestival->id],[
                        'data' => [
                            'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare il festival?'),
                            'method' => 'post',
                        ],
                    ])  ?>
                </span>
            <?php endif; ?>

            <span class="btn btn-danger">
                <?= Html::a('<i class="fas fa-times"></i> '.Yii::t('app', 'Chiudi'), ['/iloveteatro/festival-table'])  ?>
            </span>
        </div>
    

        <?= $form->field($newFestival, 'edizione')->textarea([
            'placeholder'   => Yii::t('app', 'Edizione del festival'),
            'autofocus'     => 'autofocus',
            'class'         => 'form-control title',
            'maxlength'     => true 
        ])->label(false) ?>
    
        <?= $form->field($newFestival, 'anno')->textInput([
                'value' => $newFestival->anno?:date('Y'), 
                'class' => 'form-control subtitle-1',
                'placeholder' => 'Anno del festival',
            ])->label(false) ?>
        
        <div class="container">
        
            <div class="row">
                <div class="col col-sm-12">
                    <?= $form->field($newFestival, 'descrizione')->widget(TinyMce::className(), [
                        'options' => ['rows' => 20, 'data-input' => 'contenuto'],
                        'language' => 'it',
                        'clientOptions' => [
                            'plugins' => [
                                "advlist autolink lists link charmap print preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste",
                                "image code",
                            ],
                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                            'image_advtab' => true,
                            "file_picker_callback" => new yii\web\JsExpression("function(callback, value, meta) {
                                var input = document.createElement('input');
                                input.setAttribute('type', 'file');
                                input.setAttribute('accept', 'image/*');

                                input.onchange = function() {
                                    //alert('File Input Changed');
                                    //console.log( this.files[0] );

                                    var file = this.files[0];

                                    var reader = new FileReader();
                                    reader.readAsDataURL(file);
                                    reader.onload = function () {
                                        // Note: Now we need to register the blob in TinyMCEs image blob
                                        // registry. In the next release this part hopefully won't be
                                        // necessary, as we are looking to handle it internally.

                                        //Remove the first period and any thing after it 
                                        var rm_ext_regex = /(\.[^.]+)+/;
                                        var fname = file.name;
                                        fname = fname.replace( rm_ext_regex, '');

                                        //Make sure filename is benign
                                        var fname_regex = /^([A-Za-z0-9])+([-_])*([A-Za-z0-9-_]*)$/;
                                        if( fname_regex.test( fname ) ) {
                                            var id = fname + '-' + (new Date()).getTime(); //'blobid' + (new Date()).getTime();
                                            var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                                            var blobInfo = blobCache.create(id, file, reader.result);
                                            blobCache.add(blobInfo);

                                            // call the callback and populate the Title field with the file name
                                            callback(blobInfo.blobUri(), { title: file.name });
                                        }
                                        else {
                                            alert( 'Invalid file name' );
                                        }
                                    };
                                    //To get get rid of file picker input
                                    this.parentNode.removeChild(this);
                                };

                                input.click();
                            }")
                        ]
                    ])->label('<i class="fas fa-file-medical-alt"></i> '.Yii::t('app', 'Descrizione'), ['data-show-sibling' => 'true']); ?>
                </div>
            </div>
            
            <div class="row">
                <div class="col col-sm-6">
                    <?= $form->field($newFestival, 'inizio')->textInput(['type' => 'date']) ?>
                </div>
                <div class="col col-sm-6">
                    <?= $form->field($newFestival, 'fine')->textInput(['type' => 'date']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col col-sm-6">
                    <?= $form->field($newFestival, 'inizio_pubblicazione')->textInput([
                        'type' => 'datetime-local', 
                        'value' => $newFestival->inizio_pubblicazione<>""?date("Y-m-d\TH:i:s", strtotime($newFestival->inizio_pubblicazione)):'']) ?>
                </div>
                <div class="col col-sm-6">
                    <?= $form->field($newFestival, 'fine_pubblicazione')->textInput([
                        'type' => 'datetime-local', 
                        'value' => $newFestival->fine_pubblicazione<>""?date("Y-m-d\TH:i:s", strtotime($newFestival->fine_pubblicazione)):'']) ?>
                </div>
                
            </div>
            <div class="row">
                <div class="col col-sm-6 flex">
                    <?= $form->field($pdf, 'file')
                            ->fileInput(["accept" => ".pdf"])
                            ->label("Carica il regolamento", [
                                'class' => 'file-btn btn btn-large control-label'
                            ]) ?>
                    <div class="filenames"></div>
                </div>  
            </div>
            
            <div class="row">
                <div class="col col-sm-6 flex flex-flow-wrap paste">
                    <div>
                        <?= $form->field($pdfMultiple, 'multipleFile[]')
                                ->fileInput(['multiple' => true, "accept" => ".pdf"])
                                ->label("Carica l'allegato", [
                                    'class' => 'file-btn btn btn-large control-label'
                                ]) ?>
                        <div class="filenames"></div>
                    </div>
                </div>  
            </div>
        </div>
    
    <?php ActiveForm::end(); ?>
    
    <?php if($type<>"create") : ?>
    <?= Html::a("<h3>".Yii::t('app', 'Regolamento')."</h3>", $newFestival->regolamenti, ['target' => '_blank']) ?>
    <br /><br />
    
    <h3><?= Yii::t('app', 'Allegati') ?></h3>
    
    <div class="flex flex-flow-wrap">
        <?php if(isset($allegati)) : ?>
            <?php foreach($allegati as $allegato) : ?>
            <div class="btn btn-link">
                <?= Html::a($allegato->nome, $allegato->allegato, ['target' => '_blank']) ?>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>

<?php

$this->registerCssFile('@web/css/iloveteatro/ilove-form.css');
$this->registerJsFile('@web/js/uploadFile.js', ['depends' => yii\web\JqueryAsset::class]);
$this->registerJs('
    jQuery("input[type=\"file\"]").uploadFile();
    
    //Add allegato
    jQuery(".add-allegato").click(function(){
        var clone_el = jQuery(".copy").clone(true);
        clone_el.show();
        clone_el.removeClass("copy");
        jQuery(".paste").append( clone_el );
    });
');