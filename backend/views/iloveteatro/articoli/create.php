<?php
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$title = Yii::t('app', 'Nuovo articolo');

$this->title = $title." | I Love Teatro";
?>

<div id="articoli-nuovo" class="ilove-form">
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <div class="action-bar">
        <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Salva e chiudi'), ['class' => 'btn btn-success']) ?>
        
        <?php if($type=="update") : ?>
            <span class="btn btn-danger">
                <?= Html::a('<i class="fas fa-trash-alt"></i> '.Yii::t('app', 'Cancella'), ['/iloveteatro/articoli-delete', 'id' => $model->id],[
                    'data' => [
                        'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questo articolo?'),
                        'method' => 'post',
                    ],
                ])  ?>
            </span>
        <?php endif; ?>
        
        <span class="btn btn-danger">
            <?= Html::a('<i class="fas fa-times"></i> '.Yii::t('app', 'Chiudi'), ['/iloveteatro/tutti-articoli'])  ?>
        </span>
    </div>

    <?= $form->field($model, 'titolo')->textarea([
        'placeholder'   => Yii::t('app', 'Aggiungi un titolo'),
        'autofocus'     => 'autofocus',
        'class'         => 'form-control title',
        'maxlength'     => true 
    ])->label(false) ?>

    <div class="flex">
        <div class="content">
            <?= $form->field($model, 'contenuto')->widget(TinyMce::className(), [
                        'options' => ['rows' => 20, 'data-input' => 'contenuto'],
                        'language' => 'it',
                        'clientOptions' => [
                            'plugins' => [
                                "advlist autolink lists link charmap print preview anchor",
                                "searchreplace visualblocks code fullscreen",
                                "insertdatetime media table contextmenu paste"
                            ],
                            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                        ]
                    ])->label(false);?>
        </div>
        
        <div class="option">
            <div class="radio">
                <?= $form->field($model, 'pubblicato')->radioList([
                    '0'  => 'Cestinato',
                    '1'  => 'Non pubblicato',
                    '10' => 'Pubblicato',
                ])->label(false) ?>
            </div>
            
            <?= $form->field($model, 'meta_description')->textarea() ?>
            <?= $form->field($model, 'meta_keyword')->textarea()->label(Yii::t('app', 'Meta keyword: (Separare con una virgola)')) ?>

            <?= $form->field($model, 'inizio_pubblicazione')->textInput([
                'type' => 'datetime-local',
                'value' => ($model->inizio_pubblicazione<>"")?date("Y-m-d\TH:i:s", strtotime($model->inizio_pubblicazione)):date("Y-m-d\TH:i:s"),
             ]) ?>
            <?= $form->field($model, 'fine_pubblicazione')->textInput([
                'type' => 'datetime-local',
                'value' => ($model->fine_pubblicazione<>"")?date("Y-m-d\TH:i:s", strtotime($model->fine_pubblicazione)):"0000-00-00T00:00:00",
             ]) ?>
            <?= $form->field($model, 'commenti')->checkbox(['label' => Yii::t('app', 'Consenti i commenti')]) ?>
            
            <div class="image">
                <?php if($model->immagine_in_evidenza <> "" ) : ?>
                <div class="image" style="background-image: url(../web/iloveteatro/media_uploads/<?= $model->immagine_in_evidenza ?>);"></div>
                <?php endif; ?>
                
                <?= $form->field($uploadForm, 'mediaFile')->fileInput(['required' => false])->label(Yii::t('app', 'Immagine in evidenza')) ?>
            </div>
            
            <?= $form->field($model, 'categoria')->dropDownList(
                ArrayHelper::map(\backend\models\IltCategorie::find()->all(), 'id', 'categoria')
            ) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerCssFile('@web/css/iloveteatro/ilove-form.css');