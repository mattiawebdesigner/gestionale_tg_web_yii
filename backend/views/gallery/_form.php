<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="tg_gallery" class="gallery-form">
    
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    
    <div data-copy>
    </div>

    <div class="action-bar row">
        <div class="title col col-sm-9 col-lg-8">
            <?= $form->field($gallery, 'nome')->textInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Nome della galleria')])->label(false) ?>
            <?= $form->field($gallery, 'sito_di_riferimento')->hiddenInput(['maxlength' => true, 'placeholder' => Yii::t('app', 'Nome dele galleria')])->label(false) ?>
        </div>
        <div class="buttons col col-sm-3 col-lg-4">
            <!--<span class="btn btn-warning add-slide"><i class="fas fa-plus-circle"></i> <?= Yii::t('app', '')?></span>-->
            <?= $form->field($fotoNew, 'url[]')->fileInput(['multiple' => true, 'accept' => 'image/*', 'style' => 'display: none;'])
                     ->label('<i class="fas fa-plus-circle"></i>', ['class' => 'btn btn-warning add-slide']) ?>
            <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
            <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', 'Cancella galleria'), ['delete', 'id' => $gallery->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
            
            <?= $form->field($gallery, 'tipo')->textInput(['value' => 'foto', 'readonly' => true])->label(false) ?>
            <!--<?= $form->field($gallery, 'tipo')
                        ->dropDownList([ 'foto' => 'Foto', 'video' => 'Video', ], ['prompt' => ''])->label(false) ?>-->
        </div>
    </div>
    
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-12">
            <?= $form->field($gallery, 'descrizione')
                ->textarea(['maxlength' => true, 'rows' => 8, 'id' => 'description', 'data-hide' => 'true'])
                ->label('<i class=""></i> '.Yii::t('app', 'Descrizione'), ['data-show-sibling' => 'true']); ?>
        </div>
    </div>
    
    <div id="slide-append"></div>
    
    <?php if( $foto <> null) : //se ci sono foto... ?>
        <?php foreach ($foto as $f) : ?>
            <?= $this->render('_foto', [
               'form' => $form,
               'foto' => $f,
               'gallery' => $gallery,
            ]) ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$this->registerCssFile('@web/css/tg_gallery.css');
$this->registerJsFile('@web/js/charsLeft.js', ['depends' => yii\web\JqueryAsset::class]);
$this->registerJsFile('@web/js/tg_gallery.js', ['depends' => yii\web\JqueryAsset::class]);
$this->registerJsFile('@web/js/thumbImageFile.js', ['depends' => yii\web\JqueryAsset::class]);
$this->registerJs('
    $(function() {
      $.charsLeft( "#description" );
      $.charsLeft( "#tg_gallery .row.slide textarea" );
    });
    $("#tg_gallery").tg_gallery();

    $("input[type=\"file\"]").thumbImageFile();
    
    $("#foto-url").change(function(event){
        $("#w0").submit();
    });
');