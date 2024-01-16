<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$title = Yii::t('app', 'QR Code');
?>
<h1><?= Html::encode($title) ?></h1>

<div class="qr-index">
    
    <h4><?= Yii::t('app', 'Crea un QR Code con il logo'); ?></h4>
    <?php $form = ActiveForm::begin([
        'options' => [
            'data-form' => 'verbale',
        ]
    ]); ?>
    
    <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Genera QR'), ['class' => 'btn btn-success']) ?>
    
    <?= $form->field($model, 'testo')->textInput(); ?>
    
    <?= $form->field($model, 'logo')->fileInput(['required' => false]); ?>
    
    <?php ActiveForm::end(); ?>
    
    
    
    <hr />
    <h4><?= Yii::t('app', 'Crea un QR Code senza logo'); ?></h4>
    
    <?php $form = ActiveForm::begin([
        'options' => [
            'data-form' => 'verbale',
        ]
    ]); ?>
    
    <?= Html::submitButton('<i class="far fa-save"></i> '.Yii::t('app', 'Genera QR'), ['class' => 'btn btn-success']) ?>
    
    <?= $form->field($model, 'testo')->textInput(); ?>
    
    <?php ActiveForm::end(); ?>
</div>