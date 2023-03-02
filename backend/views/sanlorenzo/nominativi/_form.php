<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Nominativo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nominativo-form">

    <?php $form = ActiveForm::begin(); ?>

		<div class="form-group">
        <?= Html::submitButton('<i class="fa-solid fa-floppy-disk"></i> ' . Yii::t('app', 'Salva'), ['class' => 'btn btn-success']) ?>
    </div>
    
    <?= $form->field($model, 'nominativo')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'concorrente')->hiddenInput(['value' => $concorrente_id])->label(false); ?>
    
    <?= $form->field($model, 'strumento')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'data_di_nascita')->textInput(['type' => 'date']) ?>
    
    <?php ActiveForm::end(); ?>
</div>



<?php