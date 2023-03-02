<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

$this->title = ($type=="create")?Yii::t('app', 'Nuovo articolo'):Yii::t('app', 'Modifica articolo: {nome}', [
    'nome' => $articles->titolo,
]);
?>
<div class="sanlorenzo-article-create sanlorenzo-form">
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="action-bar">
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva e chiudi'), ['class' => 'btn btn-success']) ?>
            
            <?php //Delete button only for upload page ?>
            <?php if($type=="update") : ?>
            <span class="btn btn-danger">
                <?= Html::a('<i class="fas fa-trash-alt"></i> '.Yii::t('app', 'Cancella'), ['/sanlorenzo/articoli-delete', 'id' => $articles->id],[
                    'data' => [
                        'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questo articolo?'),
                        'method' => 'post',
                    ],
                ])  ?>
            </span>
            <?php endif; ?>
            <?php //End delete button ?>
            
            <span class="btn btn-danger">
                <?= Html::a('<i class="fas fa-times"></i> '.Yii::t('app', 'Chiudi'), ['/sanlorenzo/all-articles'])  ?>
            </span>
        </div>

        <?= $form->field($articles, 'titolo')->textarea([
            'placeholder'   => Yii::t('app', 'Titolo dell\'articolo'),
            'autofocus'     => 'autofocus',
            'class'         => 'form-control title',
            'maxlength'     => true 
        ])->label(false) ?>

        <?= $form->field($articles, 'in_evidenza')->dropDownList([
           \backend\models\SnlArticoli::NOT_IN_EVIDENCE   => 'No',
           \backend\models\SnlArticoli::IN_EVIDENCE       => 'Si'
        ]) ?>

        <div class="flex gap-1">
            <div class="content">
                <?= $form->field($articles, 'contenuto')->widget(TinyMce::className(), [
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
            </div>

            <div class="option-group">
                <div class="close" data-open-class="option-open">
                </div>

                <div class="option option-open">
                    <?= $form->field($articles, 'categoria')->dropDownList(
                        ArrayHelper::map(backend\models\SnlCategorie::find()->all(), 'id', 'categoria')
                    ) ?>

                    <?php if($articles->immagine_in_evidenza <> "" ) : ?>
                    <?php else : ?>
                    <?php endif; ?>

                    <?= $form->field($uploadForm, 'mediaFile')->fileInput()->label(Yii::t('app', '<div class="btn btn-warning"><i class="fa-solid fa-file-arrow-up"></i> Carica immagine in evidenza</div>')) ?>

                    <?= $form->field($articles, 'inizio_pubblicazione')->textInput([
                        'type' => 'datetime-local',
                        'value' => ($articles->inizio_pubblicazione<>"")?date("Y-m-d\TH:i:s", strtotime($articles->inizio_pubblicazione)):date("Y-m-d\TH:i:s"),
                     ]) ?>
                    <?= $form->field($articles, 'fine_pubblicazione')->textInput([
                        'type' => 'datetime-local',
                        'value' => ($articles->fine_pubblicazione<>"")?date("Y-m-d\TH:i:s", strtotime($articles->fine_pubblicazione)):"0000-00-00T00:00:00",
                     ]) ?>
                    <?= $form->field($articles, 'meta_description')->textarea() ?>
                    <?= $form->field($articles, 'meta_keyword')->textarea()->label(Yii::t('app', 'Meta keyword: (Separare con una virgola)')) ?>
                    <?= $form->field($articles, 'utente')->dropDownList(
                        //ArrayHelper::map(backend\models\Utenti::find()->all(), 'id', 'nome')
                        ArrayHelper::map(backend\models\Utenti::find()->where(
                                                ['in', 'id', \backend\models\AuthAssignment::find()->select(['user_id'])->where(['item_name' => 'San Lorenzo'])->asArray()]
                        )
                                                                      ->all(), 'id', 'nome')
                    ) ?>
                    <?= $form->field($articles, 'edizione')->dropDownList(
                            array_merge(
                                    ['0' => 'Nessuna edizione'], 
                                    ArrayHelper::map(backend\models\SnlEdizione::find()->orderBy(['edizione' => SORT_DESC])->all(), 'id', 'edizione')
                             )
                    ) ?>
                </div>
            </div>
        </div>

        <div class="cover">
            <?php if($articles->immagine_in_evidenza <> "" ) : ?>
                <?= Html::img($articles->immagine_in_evidenza) ?>
            <?php endif; ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerJs('
    $("[data-open-class]").click(function(){
        var open_class = "."+$(this).data("open-class");
        
        $(this).toggleClass("open");
        $(open_class).toggle();
    });
');
$this->registerCssFile('@web/css/sanlorenzo/sanlorenzo-form.css');