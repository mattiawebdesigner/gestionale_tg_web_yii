<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AnnoSociale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="anno-sociale-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
    </div>

    <?= $form->field($model, 'anno')
             ->textInput(['maxlength' => true, 
                            'type'=>'number', 
                            'min'=>1900, 
                            'max'=>2099, 
                            'value' => date('Y')]) ?>

    <?= $form->field($model, 'quotaSocioOrdinario')->textInput(['maxlength' => true, 'type'=>'number']) ?>

    <?= $form->field($model, 'quotaSocioSostenitore')->textInput(['maxlength' => true, 'type'=>'number']) ?>

    <?php ActiveForm::end(); ?>

</div>
