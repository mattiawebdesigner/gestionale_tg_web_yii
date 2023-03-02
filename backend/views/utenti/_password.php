<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Utenti */
/* @var $form yii\widgets\ActiveForm */
?>		
    <?php $form = ActiveForm::begin(); ?>
		
		<h3><?= Yii::t('app', 'Modifica la password') ?></h3>
		
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'value' => '']) ?>
        
        <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => true, 'value' => '']) ?>
		
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
        </div>
    
    <?php ActiveForm::end(); ?>