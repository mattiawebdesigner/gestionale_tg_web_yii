<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Voci */
/* @var $form yii\widgets\ActiveForm */
?>

<div id="rendiconto" class="voci-form container">
    <?php //Form to copy ?>
    <?php $form = ActiveForm::begin(); ?>
        <div data-element data-copy="true" class="element">
            <div data-collapse class="btn btn-info"><i class="fas fa-compress"></i></div>
            
            <h5 data-title-paste></h5>
            
            <div class="clearfix"></div>

            <div data-toggle>
                <?= $form->field($model, 'voce[]')->textInput(['maxlength' => true, 'data-title'=>true]) ?>

                <?= $form->field($model, 'data_contabile[]')->textInput(['type' => 'date']) ?>

                <?= $form->field($model, 'prezzo[]')->textInput(['maxlength' => true, 'type' => 'number', 'step' => '0.01']) ?>

                <?= $form->field($model, 'tipologia[]')->hiddenInput(
                        ['class' => 'type form-control'],
                    )->label(false) ?>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
    
    <?php //Real form to send ?>
    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
        <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
        
    <div class="row">
        <div id="form-in" data-in class="col-sm-6 col-md-6 col-lg-6">
            <?= $this->render('_in', [
                'in' => $in
            ]) ?>
        </div>

        <div id="form-out" data-out class="col-sm-6 col-md-6 col-lg-6">
            <?= $this->render('_out', [
                'out' => $out,
            ]) ?>
        </div>
    </div>
    
    <div class="clearfix"></div>

    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerCssFile("@web/css/rendiconto.css");
$this->registerJsFile("@web/js/rendiconto.js", ['depends' => \yii\web\JqueryAsset::class]);
$this->registerJs("
    jQuery('document').ready(function(){
        
        jQuery('#rendiconto').rendiconto();
        
        /*jQuery('#form-in').rendiconto();
        jQuery('#form-out').rendiconto();*/
    });
");