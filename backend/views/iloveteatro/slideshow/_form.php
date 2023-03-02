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
            <?= $form->field($album, 'nome')->textInput(['maxlength' => true, 
                                                            'class' => $album->id===1?'pointer-events-none':''
                                                        ])->label(false) ?>
        </div>
        <div class="buttons col col-sm-3 col-lg-4">
            <?= $form->field($fotoNew, 'url[]')->fileInput(['multiple' => true, 'accept' => 'image/*', 'style' => 'display: none;'])
                     ->label('<i class="fas fa-plus-circle"></i>', ['class' => 'btn btn-warning add-slide']) ?>
            <?= Html::a('<i class="fas fa-trash-alt"></i> '.Yii::t('app', 'Cancella album'), 
                        [
                            '/iloveteatro/album-delete', 
                            'id' => $album->id
                        ],[
                        'data' => [
                            'confirm' => Yii::t('app', 'Sei sicuro di voler cancellare questo articolo?'),
                            'method' => 'post',
                        ],
                        'class' => 'btn btn-danger',
                    ])  ?>
            <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
            
            <?php if($deleteBtn) : ?>
            <?= Html::a('<i class="fas fa-trash"></i> '.Yii::t('app', 'Cancella galleria'), ['delete', 'id' => $album->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
            <?php endif; ?>
            
        </div>
    </div>
    
    <div class="row">
        <div class="col col-sm-12 col-md-12 col-lg-12">
            <?= $form->field($album, 'descrizione')
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
                'album'=> $album,
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
    
    $("#iltfoto-url").change(function(event){
        $("#w0").submit();
    });
');