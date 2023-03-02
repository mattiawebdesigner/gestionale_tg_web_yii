<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model backend\models\Utenti */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="utenti-form">
	
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'value' => '']) ?>
    <span class="password-generator cursor-pointer"><i class="fas fa-random"></i> <?= Yii::t('app', 'Genera password') ?></span>
    <br /><br />
    
    <?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => true, 'value' => '']) ?>

    <?= $form->field($model, 'indirizzo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'socio_id')->hiddenInput()->label(false) ?>

    <?= $form->field($auth_assignment, 'created_at')->hiddenInput(['value' => strtotime("now")])->label(false) ?>
    
    <?= $form->field($model, 'status')->dropDownList(
        [
            '9'  => 'Inattivo',
            '10' => 'Attivo',
            '0'  => 'Cancellato',
        ]
    ) ?>
    
    <div class="form-group">
    	<?= $form->field($auth_assignment, 'item_name')->dropDownList(ArrayHelper::map(AuthItem::find()->all(), "name", "name"),['multiple' => 'mulitple']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> '.Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJsFile('@web/js/password_generator.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJs("
    jQuery('.password-generator').password_generator();
");