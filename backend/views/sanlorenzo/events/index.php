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
    
    <h1><?= Html::encode($this->title) ?></h1>   
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="action-bar">
            <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva e chiudi'), ['class' => 'btn btn-success']) ?>

            <?php if($type=="update") : ?>
                <span class="btn btn-danger">
                    <?= Html::a('<i class="fas fa-trash-alt"></i> '.Yii::t('app', 'Cancella'), ['/sanlorenzo/event-delete', 'id' => $category->id],[
                        'data' => [
                            'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questa edizione?'),
                            'method' => 'post',
                        ],
                    ])  ?>
                </span>
                <?php endif; ?>

                <span class="btn btn-danger">
                    <?= Html::a('<i class="fas fa-times"></i> '.Yii::t('app', 'Chiudi'), ['/sanlorenzo/show-events'])  ?>
                </span>
        </div>
    
        <?= $form->field($model, 'edizione')->textInput([
            'placeholder'   => Yii::t('app', 'Anno'),
            'class'         => 'form-control title',
            'maxlength'     => true,
            'value'         => date('Y'),
            'readonly'      => 'readonly',
        ])->label(false) ?>
    
        <?= $form->field($model, 'edizione')->textInput([
            'placeholder'   => Yii::t('app', 'Edizione dell\'evento'),
            'autofocus'     => 'autofocus',
            'class'         => 'form-control title',
            'maxlength'     => true,
        ]) ?>
    
        <?= $form->field($model, 'nome')->textInput([
            'placeholder'   => Yii::t('app', 'Nome dell\'evento'),
            'class'         => 'form-control title',
            'maxlength'     => true,
            'value'         => 'La Notte di San Lorenzo',
        ]) ?>

        <?= $form->field($model, 'contest')->dropDownList(
            yii\helpers\ArrayHelper::map(\backend\models\SnlContest::find()->orderBy(['edizione' => SORT_DESC])->all(), 'id', 'edizione'),
            ['prompt' => '--']
        ) ?>
    
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
                           ]
                       ])->label(false);?>
    <?php ActiveForm::end(); ?>
    
</div>