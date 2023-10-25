<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Soci */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soci-form">
	
    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data_di_nascita')->textInput(['type' => 'date']) ?>
	
    <?= $form->field($model, 'indirizzo')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'luogo_di_nascita')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'provincia_di_nascita')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'CAP')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'citta_di_residenza')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'provincia_di_residenza')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'cellulare')->textInput(['maxlength' => true]) ?>
	
    <?= $form->field($model, 'codice_fiscale')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($socioAnnoSociale, 'validita', [])
            ->dropDownList([
                'si' => 'In regola con i pagamenti',
                'no' => 'Non in regola con i pagamenti'
            ],
            ['options'=>['no'=>['Selected'=>true]]]
        ) ?>

    <?php ActiveForm::end(); ?>
    
    
    <?php if(!isset($create)) : ?>
        <h3><?= Yii::t('app', 'Firma'); ?></h3>

        <?php if(!empty($firma->firma)) : ?>
        <img style="max-width: 250px" src="<?= Yii::$app->params['site_protocol'].Yii::$app->params['backendWeb'].$firma->firma ?>" />

        <div>
            <label><?= Yii::t('app', 'Modifica la firma'); ?></label>
        </div>
        <?php else: ?>
        <label><?= Yii::t('app', 'Aggiungi la firma'); ?></label>
        <?php endif; ?>
    
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($firma, 'firma')
                ->fileInput()
                ->label(false) ?>
            <div class="form-group">
                <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva firma'), ['class' => 'btn btn-success']) ?>
            </div>
        <?php ActiveForm::end(); ?>
    <?php endif; ?>
</div>
