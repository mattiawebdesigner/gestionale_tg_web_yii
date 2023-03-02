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
    
    <?= $form->field($socioAnnoSociale, 'validita', [])
            ->dropDownList([
                'si' => 'In regola con i pagamenti',
                'no' => 'Non in regola con i pagamenti'
            ],
            ['options'=>['no'=>['Selected'=>true]]]
        ) ?>

    <?php ActiveForm::end(); ?>
    

</div>
